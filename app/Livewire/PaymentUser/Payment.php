<?php

namespace App\Livewire\PaymentUser;

use Livewire\Component;
use Livewire\Attributes\On;

class Payment extends Component
{
    public $invoice_url = "";

    #[On('invoice_url')]
    public function getInvoiceUrl($invoice_url)
    {
        $this->invoice_url = $invoice_url;
    }

    public function render()
    {
        return view('livewire.payment-user.payment');
    }
}
