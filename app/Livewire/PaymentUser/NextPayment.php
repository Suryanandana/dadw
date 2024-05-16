<?php

namespace App\Livewire\PaymentUser;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class NextPayment extends Component
{

    public $next = false;
    public $complete = false;
    public $payment = false;

    #[On('echo:user-verified,UserVerified')]
    public function handleUserVerified($id)
    {
        if ($id == auth()->id()) {
            $this->next = true;
        }
    }

    #[On('echo:user-paid,UserPaid')]
    public function handleUserPaid($id)
    {
        $id_customer = DB::table('customer')->where('id_users', auth()->id())->value('id');
        if ($id['id'] == $id_customer) {
            $this->payment = true;
        }
    }

    public function nextSetTrue($id)
    {
        $this->next = true;
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
