<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Staff;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\OrderPackage;
use App\Models\OrderService;
use Illuminate\Http\Request;
use App\Models\Image_service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use function PHPUnit\Framework\isNull;
use function PHPUnit\Framework\isEmpty;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

class StaffController extends Controller
{

    public function chat()
    {
        return view('staff.chat');
    }

    public function dashboard()
    {
        $status = ['inprogress' => 0, 'accepted' => 0, 'reschedule' => 0, 'cancelled' => 0, 'complete' => 0];
        $data = Booking::select('booking_status')->get();
        foreach($data as $d){
            if($d->booking_status == 'inprogress') {
                $status['inprogress'] += 1;
            } else if($d->booking_status == 'accepted') {
                $status['accepted'] += 1;
            } else if($d->booking_status == 'reschedule') {
                $status['reschedule'] += 1;
            } else if($d->booking_status == 'cancelled') {
                $status['cancelled'] += 1;
            } else if($d->booking_status == 'complete') {
                $status['complete'] += 1;
            }
        }
        // dd($status);
        return view('staff.dashboard')->with('status', $status);
    }

    public function getTransaction()
    {
        // $serviceData = OrderService::select('order_services.id', 'booking.pax', 'booking.booking_status', 'booking.date', 'services.price', 'users.name')
        //     ->join('booking', 'order_services.id_booking', '=', 'booking.id')
        //     ->join('users', 'booking.id_customer', '=', 'users.id')
        //     ->join('services', 'order_services.id_services', '=', 'services.id')
        //     ->orderBy('order_services.id', 'desc')
        //     ->get();

        // $packageData = OrderPackage::select('order_package.id', 'booking.pax', 'booking.booking_status', 'booking.date', 'package.price', 'users.name')
        //     ->join('booking', 'order_package.id_booking', '=', 'booking.id')
        //     ->join('users', 'booking.id_customer', '=', 'users.id')
        //     ->join('package', 'order_package.id_package', '=', 'package.id')
        //     ->orderBy('order_package.id', 'desc')
        //     ->get();

        // $data = $serviceData->merge($packageData);

        // Debugging: lihat data yang dikirim ke view
        $data = DB::table('booking')
        ->join('customer', 'booking.id_customer', '=', 'customer.id')
        ->join('users', 'customer.id_users', '=', 'users.id')
        ->get();

        return view('staff.transaction')->with('data', $data);
    }

    
    public function updateTransaction(Request $request, $id)
    {
        // $transaction = Transaction::where('id', $id);
        $booking = Booking::where('id', $id);
        $user = auth()->user();
        $id_staff = Staff::select('id')->where('id_user', $user->id)->first();
        try {
            DB::beginTransaction();
            
            
            $booking->update([
                'booking_status' => $request->status == 'validate' ? 'accepted' : 'cancelled',
                'id_staff' => $id_staff->id,
            ]);

            DB::commit();
            
            return redirect('/staff/transaction')->with('success', 'Data change successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            $error = $th->getMessage();
            return redirect('/staff/transaction')->withErrors(['error'=> $error]);
        }
    }

    public function doneTransaction($id)
    {
        $booking = Booking::where('id', $id);
        $user = auth()->user();
        $id_staff = Staff::select('id')->where('id_users', $user->id)->first();
        try {
            DB::beginTransaction();
            
            $booking->update([
                'booking_status' => 'complete',
                'id_staff' => $id_staff->id,
            ]);

            DB::commit();
            return redirect('/staff/transaction')->with('success', 'Data change successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            $error = $th->getMessage();
            return redirect('/staff/transaction')->withErrors(['error'=> $error]);
        }
    }

    public function getService(Request $request)
    {
        $search = $request->search;
        if(strlen($search)) {
            $data = DB::table('services')
            ->join('image_services', 'services.id', '=', 'image_services.service_id')
            ->select('services.*', 'image_services.imgdir')
            ->where('service_name', 'like', "%$search%")
            ->orWhere('details', 'like', "%$search%")
            ->paginate(4);
            
        } else{
            $data = DB::table('services')
            ->join('image_services', 'services.id', '=', 'image_services.service_id')
            ->select('services.*', 'image_services.imgdir')
            ->orderBy('id', 'desc')
            ->paginate(4);
        }
        return view('staff.service')->with('data', $data);
    }

    public function addService(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price' => 'required|integer',
            'details' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);

        try {
            $img = str_replace(' ', '', strtolower($request->service_name)) . date('_Ymd_His') .'.webp';
            // database transaction to insert data into two tables at once
            DB::beginTransaction();
            // insert data into users table
            $data = Service::create([
                'service_name' => $request->service_name,
                'price' => $request->price,
                'details' => $request->details,
            ]);
            // insert data into staff table
            Image_service::create([
                'imgdir' => $img,
                'service_id' => $data->id,
            ]);
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($request->image)->scale(width:800);
            $encode = $image->encode(new WebpEncoder(quality:100));
            $encode->save(storage_path('app/public/img/service/'.$img));

            // commit transaction
            DB::commit();

            
        } catch (\Throwable $th) {
            // rollback transaction if error
            DB::rollBack();
            $error = $th->getMessage();
            return redirect('/staff/service')->withErrors(['error'=> $error]);
        }
        return redirect('/staff/service')->with('success', 'New service added sucessfully!');

    }

    public function deleteService($id)
    {
        $image = Image_service::where('service_id', $id);
        $service = Service::where('id', $id);
        $filename = $image->value('imgdir');
        
        try {
            DB::beginTransaction();
            $image->delete();
            $service->delete();
            DB::commit();
            Storage::delete('public/img/service/'. $filename);
        } catch (\Throwable $th) {
            DB::rollBack();
            $error = $th->getMessage();
            return redirect('/staff/service')->withErrors(['error'=> $error]);
        }

        return redirect('/staff/service')->with('success', 'data deleted successfully');
    }

    public function updateService(Request $request, $id) 
    {
        $service = Service::where('id', $id);
        
        $request->validate([
            'service_name' => 'string|max:255',
            'price' => 'integer',
            'details' => 'string',
            'image' => 'image|mimes:jpeg,png,jpg,webp',
        ]);
        
        if($request->has('image')) {
            try {
                DB::beginTransaction();
                
                $filename = str_replace(' ', '', strtolower($request->service_name)) . date('_Ymd_His'). '.webp' ;
                $img = Image_service::where('service_id', $id);
                $old = $img->value('imgdir');
                
                $img->update([
                    'imgdir' => $filename,
                ]);
                
                $service->update([
                    'service_name' => $request->service_name,
                    'price' => $request->price,
                    'details' => $request->details,
                ]);
                
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($request->image);
                $image->scale(width:800);
                $encode = $image->encode(new WebpEncoder(quality:100));
                $encode->save(storage_path('app/public/img/service/'. $filename));
                Storage::delete('/public/img/service/'. $old);
                
                DB::commit();
                
                return redirect('/staff/service')->with('success', 'Data change successfully');
            } catch (\Throwable $th) {
                DB::rollBack();
                Storage::delete('public/img/service/'. $filename);
                $error = $th->getMessage();
                return redirect('/staff/service')->withErrors(['error'=> $error]);
            }

        } else {
            try {
                DB::beginTransaction();

                $service->update([
                    'service_name' => $request->service_name,
                    'price' => $request->price,
                    'details' => $request->details,
                ]);

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                $error = $th->getMessage();
                return redirect('/staff/service')->withErrors(['error'=> $error]);
            }
            return redirect('/staff/service')->with('success', 'successfully updated data.');
        }

    }

    public function getRoom(Request $request)
    {
        $data = DB::table('rooms')->paginate(10);

        if($request->search){
            $data = Room::query();
            $data->when($request->search, function ($query) use ($request){
                return $query->where('room_name', 'like', '%'.$request->search.'%');
            }); 
            $data = $data->paginate(10);
        }

        return view('staff.room', ['data' => $data]);
    }

    public function addRoom(Request $request)
    {
        $request->validate([
            'room_name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'category' => 'required|string|max:255',
            'description'=> 'required|string',
        ]);

        try {
            Room::create([
                'room_name' => $request->room_name,
                'capacity' => $request->capacity,
                'category' => $request->category,
                'description' => $request->description
            ]);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            return redirect('/staff/room')->withErrors(['error'=> $error]);
        }
        return redirect('/staff/room')->with('success', 'New room added successfully!');
    }

    public function updateRoom(Request $request, $id)
    {
        $room = Room::where('id', $id);
        $request->validate([
            'room_name' => 'string|max:255',
            'capacity' => 'integer',
            'category' => 'string|max:255',
            'description'=> 'string',
        ]);

        try {
            $room->update([
                'room_name' => $request->room_name,
                'capacity' => $request->capacity,
                'category' => $request->category,
                'description' => $request->description
            ]);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            return redirect('/staff/room')->withErrors(['error'=> $error]);
        }
        return redirect('/staff/room')->with('success', 'Data change successfully');
    }

    public function deleteRoom($id)
    {
        $room = Room::where('id', $id);
        try {
            $room->delete();
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            return redirect('/staff/room')->withErrors(['error'=> $error]);
        }
        return redirect('/staff/room')->with('success', 'Data deleted successfully');
    }

    public function getPackage(Request $request)
    {
        $data = DB::table('package')->paginate(10);

        if($request->search){
            $data = DB::table('package');
            $data->where('package_name', 'like', '%'.$request->search.'%');
            $data = $data->paginate(10);
        }

        return view('staff.package', ['data' => $data]);
    }

    public function addPackage(Request $request)
    {
        $request->validate([
            'package_name' => 'required|string|max:255',
            'package_duration' => 'required|integer|max:3', 
            'price' => 'required|integer',
            'detail' => 'required|string',
        ]);

        try {
            DB::table('package')->insert([
                'package_name' => $request->package_name,
                'package_duration' => $request->package_duration,
                'price' => $request->price,
                'detail' => $request->detail,
            ]);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            return redirect('/staff/package')->withErrors(['error'=> $error]);
        }
        return redirect('/staff/package')->with('success', 'New package added successfully!');
    }

    public function updatePackage(Request $request, $id)
    {
        $package = DB::table('package')->where('id', $id);
        $request->validate([
            'package_name' => 'string|max:255',
            'package_duration' => 'integer|digits_between:1,3', 
            'price' => 'integer',
            'details' => 'string',
        ]);

        try {
            $package->update([
                'package_name' => $request->package_name,
                'package_duration' => $request->package_duration,
                'price' => $request->price,
                'detail' => $request->detail,
            ]);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            return redirect('/staff/package')->withErrors(['error'=> $error]);
        }
        return redirect('/staff/package')->with('success', 'Data change successfully');
    }

    public function deletePackage($id)
    {
        $package = DB::table('package')->where('id', $id);
        try {
            $package->delete();
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            return redirect('/staff/package')->withErrors(['error'=> $error]);
        }
        return redirect('/staff/package')->with('success', 'Data deleted successfully');
    }
}
