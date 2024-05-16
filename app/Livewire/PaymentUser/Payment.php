<?php

namespace App\Livewire\PaymentUser;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class Payment extends Component
{
    public $invoice_url = "";
    public $paid = false;
    public $expiry_date = "";

    #[On('invoice_url')]
    public function getInvoiceUrl($invoice_url)
    {
        $this->invoice_url = $invoice_url;
    }

    #[On('expiry_date')]
    public function getExpiryDate($expiry_date)
    {// Convert to ISO 8601 format
        $this->expiry_date = $expiry_date;
    }

    #[On('echo:user-paid,UserPaid')]
    public function handleUserPaid($id)
    {
        $id_customer = DB::table('customer')->where('id_users', auth()->id())->value('id');
        if ($id['id'] == $id_customer) {
            $this->paid = true;
        }
    }

    public function render()
    {
        return view('livewire.payment-user.payment');
    }
}
