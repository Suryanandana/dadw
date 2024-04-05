<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Feedback extends Component
{
    public function render()
    {
        $data = DB::table('services')
        ->join('image_services', 'services.id', '=', 'image_services.service_id')
        ->select('services.*', 'image_services.imgdir')
        ->orderBy('id', 'desc')
        ->get();
        $feedback = DB::table('order_services')
        ->join('feedback', 'feedback.id_booking', '=', 'order_services.id_booking')
        ->join('services', 'services.id', '=', 'order_services.id_services')
        ->join('booking', 'booking.id', '=', 'order_services.id_booking')
        ->join('users', 'booking.id_customer', '=', 'users.id')
        ->select('services.*', 'feedback.*', 'users.name')
        ->get();
        return view('livewire.landing.feedback')->with('data', $data)->with('feedback', $feedback);
    }
}
