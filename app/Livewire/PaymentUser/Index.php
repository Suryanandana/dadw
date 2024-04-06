<?php

namespace App\Livewire\PaymentUser;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $circle = 15.5;
    public $show = false;

    public function klik()
    {
        $this->show = true;
    }

    public function setCircle($circle){
        $this->circle = $circle;
    }    

    public function render()
    {
        return view('livewire.payment-user.index');
    }
}
