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
        $morning = ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30'];
        $afternoon = ['12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30'];
        $evening = ['16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30'];
        return view('livewire.payment-user.date')->with(compact('morning', 'afternoon', 'evening'));
    }
}
