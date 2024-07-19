<?php

namespace App\Livewire\Landing;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Testimonial extends Component
{
    public function render()
    {
        $data = DB::table('booking')
        ->join('feedback', 'feedback.id_booking', '=', 'booking.id')
        ->join('customer', 'customer.id', '=', 'booking.id_customer')
        ->join('users', 'users.id', '=', 'customer.id_users')
        ->join('rooms', 'rooms.id', '=', 'booking.id_room')
        ->select('feedback.*', 'users.name', 'rooms.room_name', 'booking.id')
        ->limit(6)
        ->get();
  
        $name = DB::table('order_services')
        ->join('services', 'services.id', '=', 'order_services.id_services')
        ->select(DB::raw('GROUP_CONCAT(services.service_name ORDER BY services.service_name SEPARATOR ", ") as selected_services'))
        ->whereIn('order_services.id_booking', $data->pluck('id_booking'))
        ->groupBy('order_services.id_booking')
        ->get();
        
        return view('livewire.landing.testimonial', compact('data', 'name'));
    }
}
