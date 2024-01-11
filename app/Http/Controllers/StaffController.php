<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $data = Order::select('order.*', 'booking.*', 'services.price', 'users.name', 'transaction.img_receipt',)
            ->join('booking', 'order.id_booking', '=', 'booking.id')
            ->join('users', 'booking.id_customer', '=', 'users.id')
            ->join('services', 'order.id_services', '=', 'services.id')
            ->join('transaction', 'booking.id_transaction', '=', 'transaction.id')
            ->orderBy('order.id', 'desc')
            ->get();
        return view('staff.index')->with('data', $data);
    }
}
