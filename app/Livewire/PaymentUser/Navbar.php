<?php

namespace App\Livewire\PaymentUser;

use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $user_id;
    public function mount()
    {
        if (auth()->check()) {
            $this->verified = auth()->user()->hasVerifiedEmail();
            $this->user_id = auth()->id();
        }
    }

    #[On('echo:user.{user_id},UserVerified')]
    public function handleUserVerified($id)
    {
    }

    #[On('refreshNavbar')]
    public function refreshNavbar()
    {
    }

    #[On('setUserId')]
    public function setUserId($id)
    {
        $this->user_id = $id;
    }

    public function render()
    {
        return view('livewire.payment-user.navbar');
    }
}
