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

        $dataPack = DB::table('package')
        ->join('package_image', 'package.id', '=', 'package_image.package_id')
        ->select('package.*', 'package_image.imgdir')
        ->orderBy('id', 'detail')
        ->get();

        $services = DB::table('services')->get();

        $feedback = DB::table('order_services')
        ->join('feedback', 'feedback.id_booking', '=', 'order_services.id_booking')
        ->join('services', 'services.id', '=', 'order_services.id_services')
        ->join('booking', 'booking.id', '=', 'order_services.id_booking')
        ->join('users', 'booking.id_customer', '=', 'users.id')
        ->select('services.*', 'feedback.*', 'users.name')
        ->get();

        return view('landing.index')
        ->with('data', $data)
        ->with('feedback', $feedback)
        ->with('dataPack', $dataPack);
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

    public function package($id)
    {
        $package = $this->getPackage($id)->first();
        return view('livewire.landing.packdetails')->with('package', $package);
    }

    protected function getPackage($id)
    {
        return DB::table('package')
            ->join('package_image', 'package.id', '=', 'package_image.id_package')
            ->select('package.*', 'package_image.imgdir')
            ->where('package.id', $id)
            ->get();
    }

    public function rooms($id)
    {
        $data = $this->getRooms($id)->first();
        return view('livewire.landing.roomdetails')->with('data', $data);
    }

    protected function getRooms($id)
    {
        return DB::table('rooms')
            ->join('image_rooms', 'rooms.id', '=', 'image_rooms.id')
            ->select('rooms.*', 'image_rooms.imgdir')
            ->where('rooms.id', $id)
            ->get();
    }
}
