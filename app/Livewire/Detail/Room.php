<?php

namespace App\Livewire\Detail;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Room extends Component
{
    public $params;
    public function mount($id)
    {
        $this->params = DB::table('rooms')
        ->join('image_rooms', 'rooms.id', '=', 'image_rooms.id_room')
        ->where('rooms.id', $id)
        ->get()
        ->first();
    }
    
    public function render()
    {
        return view('livewire.detail.room');
    }
}
