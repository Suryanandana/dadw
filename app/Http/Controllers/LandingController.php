<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function landing() 
    {
        $data = DB::table('services')
        ->join('image_services', 'services.id', '=', 'image_services.service_id')
        ->select('services.*', 'image_services.imgdir')
        ->orderBy('id', 'desc')
        ->get();
        $feedback = DB::table('order')
        ->join('feedback', 'feedback.id_booking', '=', 'order.id_booking')
        ->join('services', 'services.id', '=', 'order.id_services')
        ->join('booking', 'booking.id', '=', 'order.id_booking')
        ->join('users', 'booking.id_customer', '=', 'users.id')
        ->select('services.*', 'feedback.*', 'users.name')
        ->get();
        return view('landing.index')->with('data', $data)->with('feedback', $feedback);
    }
}
