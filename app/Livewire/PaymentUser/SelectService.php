<?php

namespace App\Livewire\PaymentUser;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SelectService extends Component
{
    public $service;

    public function mount($service)
    {
        $this->service = $service;
    }

    public function addService($idService)
    {
        $this->dispatch('add-service', idService: $idService);
    }

    public function placeholder()
    {
        return view('skeleton.payment-user.select-service');
    }
    
    public function render()
    {
        return view('livewire.payment-user.select-service');
    }
}
