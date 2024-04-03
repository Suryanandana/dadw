<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SelectService extends Component
{
    public $services;

    public function mount()
    {
        $this->services = DB::table('services')->get();
        $this->dispatch('next', next: false);
    }

    public function addService($idService)
    {
        $this->dispatch('add-service', idService: $idService);
    }
    
    public function render()
    {
        return view('livewire.select-service');
    }
}
