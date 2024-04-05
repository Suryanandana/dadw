<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Services extends Component
{

    public function render()
    {
        $data = DB::table('services')
        ->join('image_services', 'services.id', '=', 'image_services.service_id')
        ->select('services.*', 'image_services.imgdir')
        ->orderBy('id', 'desc')
        ->get();
        return view('livewire.landing.services')->with('data', $data);
    }
}
