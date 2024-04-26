<?php

namespace App\Livewire\PaymentUser;

use Livewire\Component;
use Livewire\Attributes\On;

class VerifyEmail extends Component
{

    public $complete = false;
    public $verified = false;
    public $user_id;
    public function mount()
    {
        if (auth()->check()) {
            $this->verified = auth()->user()->hasVerifiedEmail();
            $this->user_id = auth()->id();
        } else {
            $this->user_id = null;
        }
    }

    #[On('setUserId')]
    public function setUserId($id)
    {
        $this->user_id = $id;
    }

    #[On('echo:user-verified,UserVerified')]
    public function handleUserVerified($id)
    {
        if ($id['id'] == auth()->id()) {
            $this->verified = true;
            $this->dispatch('next', true);
        }
    }

    #[On('complete')]
    public function complete($complete)
    {
        $this->complete = $complete;
    }

    public function render()
    {
        return view('livewire.payment-user.verify-email');
    }
}
