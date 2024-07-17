<?php

namespace App\Livewire\Detail;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Service extends Component
{
    public $params;
    public function mount($id)
    {
        $this->params = DB::table('services')
        ->join('image_services', 'services.id', '=', 'image_services.service_id')
        ->where('services.id', $id)
        ->get()
        ->first();
    }
    
    public function render()
    {
        $collection = DB::table('order_services')
        ->join('booking', 'booking.id', '=', 'order_services.id_booking')
        ->join('feedback', 'feedback.id_booking', '=', 'booking.id')
        ->join('customer', 'customer.id', '=', 'booking.id_customer')
        ->join('users', 'users.id', '=', 'customer.id_users')
        ->join('rooms', 'rooms.id', '=', 'booking.id_room')
        ->where('order_services.id_services', $this->params->id)
        ->select('users.name', 'feedback.updated_at', 'rooms.room_name', 'feedback.rate', 'feedback.message', 'order_services.id_booking', 'feedback.title')
        ->get();

        $name = DB::table('order_services')
        ->join('services', 'services.id', '=', 'order_services.id_services')
        ->select(DB::raw('GROUP_CONCAT(services.service_name ORDER BY services.service_name SEPARATOR ", ") as selected_services'))
        ->whereIn('order_services.id_booking', $collection->pluck('id_booking'))
        ->groupBy('order_services.id_booking')
        ->get();

        $service = DB::table('services')
        ->join('image_services', 'services.id', '=', 'image_services.service_id')
        ->select('services.*', 'image_services.imgdir')
        ->whereNotIn('services.id', [$this->params->id])
        ->orderBy('id', 'desc')
        ->get();
        
        return view('livewire.detail.service', compact('name', 'service', 'collection'));
    }
}
