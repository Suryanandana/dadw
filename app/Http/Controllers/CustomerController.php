<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        // Get detail booking data
        $data = Booking::select('booking.*', 'customer.*', 'users.*', 'order.*', 'services.*', 'rooms.*')
                        ->join('customer', 'booking.id_customer', '=', 'customer.id')
                        ->join('users', 'customer.id_users', '=', 'users.id')
                        ->join('order', 'booking.id', '=', 'order.id_booking')
                        ->join('services', 'order.id_services', '=', 'services.id')
                        ->join('rooms', 'order.id_room', '=', 'rooms.id')
                        ->where('customer.id_users', $user->id)
                        ->orderBy('booking.id', 'desc')
                        ->get();

        return view('customer.dashboard', compact('data', 'user'));
    }

    public function payment()
    {
        return view('customer.payment');
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

        return redirect()->route('customer.transaction')->with('success', 'Reschedule berhasil');
    }

    public function cancel(Request $request)
    {
        Booking::where('id', $request->id)->update([
            'date' => $request->date,
            'status_booking' => 'cancelled',
        ]);

        Transaction::where('id', $request->id)->update([
            'status' => 'denied',
        ]);

        return redirect()->route('customer.transaction')->with('success', 'Cancel berhasil');
    }

    public function transaction()
    {
        $user = auth()->user();
        // select order and booking table
        $data = DB::table('order_services')
            ->select('order_services.*', 'booking.*', 'services.service_name', 'services.price', 'rooms.room_name')
            ->join('booking', 'order_services.id_booking', '=', 'booking.id')
            ->join('services', 'order_services.id', '=', 'services.id')
            ->join('rooms', 'booking.id_room', '=', 'rooms.id')
            ->where('booking.id_customer', $user->id)
            ->orderBy('booking.id', 'desc')
            ->get();
        $feedback = Feedback::select('feedback.*')
            ->join('booking', 'feedback.id_booking', '=', 'booking.id')
            ->where('booking.id_customer', $user->id)
            ->get();
        for($i = 0; $i < count($data); $i++){
            // set color for status booking
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
                $data[$i]->color = 'bg-teal-100 text-teal-800';
            }
            for($j = 0; $j < count($feedback); $j++){
                if($data[$i]->id == $feedback[$j]->id_booking){
                    $data[$i]->feedback = $feedback[$j];
                }
            }
        }
        return view('customer.transaction', compact('data'));
    }

    public function feedback(Request $request){
        Feedback::create([
            'rate' => $request->rate,
            'text' => $request->text,
            'date' => date("Y-m-d H:i:s"),
            'id_booking' => $request->id_booking,
        ]);

        return redirect()->route('customer.transaction')->with('success', 'Feedback berhasil');
    }
}
