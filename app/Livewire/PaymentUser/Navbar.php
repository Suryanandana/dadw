<?php

namespace App\Livewire\PaymentUser;

use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    #[On('echo:user-verified,UserVerified')]
    public function handleUserVerified($id)
    {
        // check if $id is the same as the authenticated user
        if ($id == auth()->id()) {
        }
    }

    #[On('refreshNavbar')]
    public function refreshNavbar()
    {
    }

    #[On('setUserId')]
    public function setUserId($id)
    {
    }

    public function render()
    {
        return view('livewire.payment-user.navbar');
    }
}
