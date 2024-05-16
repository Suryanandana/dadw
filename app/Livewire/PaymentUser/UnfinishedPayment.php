<?php

namespace App\Livewire\PaymentUser;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UnfinishedPayment extends Component
{
    public $show = false;
    public $booking;
    public $expired_date;
    public $details;
    public $paid = false;

    public function mount()
    {
        if(Auth::check()) {
            $id_customer = DB::table('customer')->where('id_users', Auth::id())->first();
            // Check if the user has payment_status pending and expired_date is greater than current date
            $booking = DB::table('booking')
                ->where('id_customer', $id_customer->id)
                ->where('payment_status', 'PENDING')
                ->where('expired_date', '>', now())
                ->first();
            if(empty($booking)) {
                return;
            }
            $details = DB::table('order_services')
                ->where('id_booking', $booking->id)
                ->join('services', 'order_services.id_services', '=', 'services.id')
                ->get();
            $this->details = $details;
            $this->expired_date = $booking ? $booking->expired_date : null;
            $this->booking = $booking;
            $this->show = $booking ? true : false;
        }
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
        return view('livewire.payment-user.unfinished-payment');
    }
}
