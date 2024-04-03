<?php

namespace App\Livewire;

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
        return view('livewire.next-payment');
    }
}
