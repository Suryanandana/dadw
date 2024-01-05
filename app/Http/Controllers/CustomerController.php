<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Services;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    public function booking(Request $request)
    {
        // validate request
        $request->validate([
            'date' => 'required',
            'time' => 'required',
            'pax' => 'required',
            'id_room' => 'required',
            'img_receipt' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // get image file name
        $image = $request->file('img_receipt')->getClientOriginalName() . '-' . time() . '.' . $request->file('img_receipt')->extension();
        // upload image to folder storage/app/public/img/receipt
        $request->file('img_receipt')->storeAs('public/img/receipt', $image);
        $user = auth()->user();
        $id_customer = Customer::select('id_users')->where('id_users', $user->id)->first();
        $formattedDate = date("Y-m-d", strtotime($request->date));
        try {
            DB::beginTransaction();
            $transaction = Transaction::create([
                'img_receipt' => $image,
                'status' => 'unvalidate',
            ]);
            // get id transaction
            $id_transaction = $transaction->id;
            $booking = Booking::create([
                'id_customer' => $id_customer->id_users,
                'date' => $formattedDate . ' ' . $request->time,
                'status_booking' => 'inprogress',
                'pax' => 1,
                'id_transaction' => $id_transaction,
            ]);
            // get id booking
            $id_booking = $booking->id;
            Order::create([
                'id_booking' => $id_booking,
                'id_room' => $request->id_room,
                'id_services' => $request->id_services,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            // get error message
            $error = $th->getMessage();
            // redirect and send massage error
            return redirect('/booking')->with('error', $error);
        }

        return redirect()->route('customer.booking')->with('success', 'Booking berhasil');
    }

    public function viewReschedule()
    {
        return view('customer.reschedule');
    }

    public function reschedule(Request $request)
    {
        $formattedDate = date("Y-m-d", strtotime($request->date));
        //mencari id customer yang dimiliki oleh user yang sedang login
        $user = auth()->user();
        Booking::where('id', $request->id)->update([
            'date' => $formattedDate . ' ' . $request->time,
            'status_booking' => 'reschedule'
        ]);

        return redirect()->route('customer.reschedule')->with('success', 'Reschedule berhasil');
    }

    public function cancel(Request $request)
    {
        Booking::where('id', $request->id)->update([
            'date' => $request->date,
            'status_booking' => 'cancelled',
        ]);

        return redirect()->route('customer.transaction')->with('success', 'Cancel berhasil');
    }

    public function transaction()
    {
        $user = auth()->user();
        // select order and booking table
        $data = Order::select('order.*', 'booking.*', 'services.service_name', 'services.price', 'rooms.room_name')
            ->join('booking', 'order.id_booking', '=', 'booking.id')
            ->join('services', 'order.id_services', '=', 'services.id')
            ->join('rooms', 'order.id_room', '=', 'rooms.id')
            ->where('booking.id_customer', $user->id)
            ->orderBy('order.id', 'desc')
            ->get();
        // set color for status booking
        for($i = 0; $i < count($data); $i++){
            $data[$i]->price = (int)$data[$i]->price;
            if($data[$i]->status_booking == 'inprogress'){
                $data[$i]->color = 'bg-yellow-100 text-yellow-800';
            } else if ($data[$i]->status_booking == 'reschedule'){
                $data[$i]->color = 'bg-blue-100 text-blue-800';
            } else if ($data[$i]->status_booking == 'cancelled'){
                $data[$i]->color = 'bg-red-100 text-red-800';
            } else if ($data[$i]->status_booking == 'accepted'){
                $data[$i]->color = 'bg-green-100 text-green-800';
            } else {
                $data[$i]->color = 'bg-gray-100 text-gray-800';
            }
        }
        return view('customer.transaction', compact('data'));
    }
}
