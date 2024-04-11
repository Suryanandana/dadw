<?php

namespace App\Livewire\PaymentUser;

use Livewire\Component;
use Livewire\Attributes\On;

class NextPayment extends Component
{

    public $next = false;
    public $complete = false;

    #[On('next')]
    public function next($boolean)
    {
        $this->next = $boolean;
    }

    #[On('complete')]
    public function complete($complete)
    {
        $this->complete = $complete;
    }

    public function render()
    {
        return view('livewire.payment-user.next-payment');
    }
}
