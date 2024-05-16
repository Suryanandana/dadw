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

        $services = DB::table('services')->get();

        $feedback = DB::table('order_services')
        ->join('feedback', 'feedback.id_booking', '=', 'order_services.id_booking')
        ->join('services', 'services.id', '=', 'order_services.id_services')
        ->join('booking', 'booking.id', '=', 'order_services.id_booking')
        ->join('users', 'booking.id_customer', '=', 'users.id')
        ->select('services.*', 'feedback.*', 'users.name')
        ->get();
        return view('landing.index')->with('data', $data)->with('feedback', $feedback);
    }

    public function details($id)
    {
        $details = $this->getServiceDetails($id)->first();
        return view('livewire.landing.servdetails')->with('details', $details);
    }

    protected function getServiceDetails($id)
    {
        return DB::table('services')
            ->join('image_services', 'services.id', '=', 'image_services.service_id')
            ->select('services.*', 'image_services.imgdir')
            ->where('services.id', $id)
            ->get();
    }
}
