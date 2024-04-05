<?php

namespace App\Livewire\PaymentUser;

use Livewire\Component;
use Livewire\Attributes\On;

class NextPayment extends Component
{

    public $next = false;

    #[On('next')]
    public function next($boolean)
    {
        $this->next = $boolean;
    }

    public function render()
    {
        return view('livewire.payment-user.next-payment');
    }
}
