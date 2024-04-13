<?php

namespace App\Livewire\PaymentUser;

use Livewire\Component;
use Livewire\Attributes\On;

class NextPayment extends Component
{

    public $next = false;
    public $complete = false;
    public $user_id;
    public function mount()
    {
        if (auth()->check()) {
            $this->user_id = auth()->id();
        }
    }

    #[On('echo:user.{user_id},UserVerified')]
    public function handleUserVerified($id)
    {
        $this->next = true;
    }

    public function nextSetTrue($id)
    {
        $this->next = true;
    }

    #[On('setUserId')]
    public function setUserId($id)
    {
        $this->user_id = $id;
    }

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
