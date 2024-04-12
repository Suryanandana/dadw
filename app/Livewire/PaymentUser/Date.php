<?php

namespace App\Livewire\PaymentUser;

use Livewire\Component;
use Livewire\Attributes\On;

class Date extends Component
{
    public $date;
    public $time;

    #[On('date')]
    public function date($date)
    {
        $this->date = $date;
        if($this->date == ''){
            $this->dispatch('next', boolean: false);
        } else {
            $this->dispatch('next', boolean: true);
        }
    }

    public function render()
    {
        return view('livewire.payment-user.date');
    }
}
