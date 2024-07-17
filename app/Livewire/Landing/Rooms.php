<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Rooms extends Component
{
    public function render()
    {
        $data = DB::table('rooms')
        ->join('image_rooms', 'rooms.id', '=', 'image_rooms.id_room')
        ->select('rooms.*', 'image_rooms.imgdir')
        ->limit(3)
        ->get();
        return view('livewire.landing.rooms')->with('data', $data);
    }
}
