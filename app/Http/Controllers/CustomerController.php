<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $data = Booking::select('booking.*', 'customer.*', 'users.*')
                        ->join('customer', 'booking.id_customer', '=', 'customer.id')
                        ->where('customer.id_users', $user->id)
                        ->get();

        return view('customer.dashboard', compact('data', 'user'));
    }

    public function viewReschedule()
    {
        return view('customer.reschedule');
    }

    public function reschedule(Request $request)
    {
        //mencari id customer yang dimiliki oleh user yang sedang login
        $user = auth()->user();
        $id_customer = Customer::select('id_users')->where('id_users', $user->id)->first();
        $id_booking = Booking::select('*')->where('id_customer', $id_customer->id_users)->first();
        Booking::where('id', $id_booking->id)->update([
            'date' => $request->date,
            'status_booking' => 'reschedule'
        ]);

        return redirect()->route('customer.dashboard')->with('success', 'Reschedule berhasil');
    }

    public function cancellation($id){
        $user = auth()->user();
        $id_customer = Customer::select('*')->where('id_users', $user->id)->first();
        $id_booking = Booking::select('*')->where('id_customer', $id_customer->id_users)->first();
        Booking::where('id', $id_booking->id)->delete();

        return redirect()->route('customer.dashboard')->with('success', 'Booking berhasil dibatalkan');
    }
}
