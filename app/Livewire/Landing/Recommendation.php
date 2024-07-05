<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Recommendation extends Component
{
    public function render()
    {
        $dataPack = DB::table('package')
        ->join('package_image', 'package.id', '=', 'package_image.id')
        ->select('package.*', 'package_image.imgdir')
        ->orderBy('id', 'asc')
        ->get();
        return view('livewire.landing.recommendation')->with('dataPack', $dataPack);
    }
}
