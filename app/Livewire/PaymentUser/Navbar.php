<?php

namespace App\Livewire\PaymentUser;

use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{

    #[On('refreshNavbar')]
    public function refreshNavbar()
    {
    }
    public function render()
    {
        return view('livewire.payment-user.navbar');
    }
}
