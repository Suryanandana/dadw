<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Order;
use App\Models\Service;
use App\Models\Image_service;
use App\Models\Staff;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class StaffController extends Controller
{

    public function chat()
    {
        return view('staff.chat');
    }

    public function dashboard()
    {
        $status = ['inprogress' => 0, 'accepted' => 0, 'reschedule' => 0, 'cancelled' => 0, 'complete' => 0];
        $data = Booking::select('booking.booking_status')->get();
        foreach($data as $d){
            if($d->status_booking == 'inprogress') {
                $status['inprogress'] += 1;
            } else if($d->status_booking == 'accepted') {
                $status['accepted'] += 1;
            } else if($d->status_booking == 'reschedule') {
                $status['reschedule'] += 1;
            } else if($d->status_booking == 'cancelled') {
                $status['cancelled'] += 1;
            } else if($d->status_booking == 'complete') {
                $status['complete'] += 1;
            }
        }
        return view('staff.dashboard')->with('status', $status);
    }

    public function getTransaction()
    {
        $data = Order::select('booking.pax', 'booking.status_booking', 'booking.date', 'services.price', 'users.name', 'transaction.*',)
            ->join('booking', 'order.id_booking', '=', 'booking.id')
            ->join('users', 'booking.id_customer', '=', 'users.id')
            ->join('services', 'order.id_services', '=', 'services.id')
            ->join('transaction', 'booking.id_transaction', '=', 'transaction.id')
            ->orderBy('order.id', 'desc')
            ->paginate(10);
        // dd($data);
        return view('staff.transaction')->with('data', $data);
    }
    
    public function updateTransaction(Request $request, $id)
    {
        $transaction = Transaction::where('id', $id);
        $booking = Booking::where('id_transaction', $id);
        $user = auth()->user();
        $id_staff = Staff::select('id')->where('id_users', $user->id)->first();
        try {
            DB::beginTransaction();
            
            $transaction->update([
                'status' => $request->status,
            ]);
            $booking->update([
                'status_booking' => $request->status == 'validate' ? 'accepted' : 'cancelled',
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
        $booking = Booking::where('id_transaction', $id);
        $user = auth()->user();
        $id_staff = Staff::select('id')->where('id_users', $user->id)->first();
        try {
            DB::beginTransaction();
            
            $booking->update([
                'status_booking' => 'complete',
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
}
