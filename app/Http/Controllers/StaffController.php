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

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class StaffController extends Controller
{
    public function getTransaction()
    {
        $data = Order::select('booking.pax', 'booking.status_booking', 'services.price', 'users.name', 'transaction.*',)
            ->join('booking', 'order.id_booking', '=', 'booking.id')
            ->join('users', 'booking.id_customer', '=', 'users.id')
            ->join('services', 'order.id_services', '=', 'services.id')
            ->join('transaction', 'booking.id_transaction', '=', 'transaction.id')
            ->orderBy('order.id', 'desc')
            ->paginate(10);
        return view('staff.index')->with('data', $data);
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
            return redirect('/staff/transaction')->with('error', $error);
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
            return redirect('/staff/transaction')->with('error', $error);
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
            'details' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $image = str_replace(' ', '', $request->service_name) . '.' . $request->file('image')->extension();
        $request->file('image')->storeAs('public/img/service', $image);

        try {
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
                'imgdir' => $image,
                'service_id' => $data->id,
            ]);
            // commit transaction
            DB::commit();
        } catch (\Throwable $th) {
            // rollback transaction if error
            DB::rollBack();
            $error = $th->getMessage();
            return redirect('/staff/service')->with('error', $error);
        }
        return redirect('/staff/service')->with('success', 'New service added sucessfully!');

    }

    public function deleteService($id)
    {
        $service = Service::where('id', $id);
        $image = Image_service::where('service_id', $id);


        try {
            DB::beginTransaction();
            $image->delete();
            $service->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $error = $th->getMessage();
            return redirect('/staff/service')->with('error', $error);
        }

        return redirect('/staff/service')->with('success', 'data deleted successfully');
    }

    public function updateService(Request $request, $id) 
    {
        $service = Service::where('id', $id);
        $image = Image_service::where('service_id', $id);

            $request->validate([
                'service_name' => 'string|max:255',
                'price' => 'integer',
                'details' => 'string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if($request->has('image')) {
                $img = str_replace(' ', '', $request->service_name) . time(). '.' . $request->file('image')->extension();
                $request->file('image')->storeAs('public/img/service', $img);
                
                try {
                    DB::beginTransaction();
    
                    $image->update([
                        'imgdir' => $img,
                    ]);
                    
                    $service->update([
                        'service_name' => $request->service_name,
                        'price' => $request->price,
                        'details' => $request->details,
                    ]);
    
                    DB::commit();
                    
                    return redirect('/staff/service')->with('success', 'Data change successfully');
                } catch (\Throwable $th) {
                    DB::rollBack();
                    $error = $th->getMessage();
                    return redirect('/staff/service')->with('error', $error);
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
                    return redirect('/staff/service')->with('error', $error);
                }
                return redirect('/staff/service')->with('success', 'successfully updated data.');
            }

    }
}
