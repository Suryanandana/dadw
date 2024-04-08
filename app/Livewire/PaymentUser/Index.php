<?php

namespace App\Livewire\PaymentUser;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $circle = 15.5;
    public $show = false;
    public $customer;

    public function mount()
    {
        if (Auth::check()) {
            $name = Auth::user()->name;
            $email = Auth::user()->email;
            $validationEmailRule = 'email|required|';
            $customer = DB::table('customer')->where('id_users', Auth::id())->select('country', 'address', 'phone')->first();
            if ($customer) {
                $country = $customer->country;
                $address = $customer->address;
                $phone = $customer->phone;
            }
            $this->customer = [
                'name' => $name,
                'email' => $email,
                'country' => $country,
                'address' => $address,
                'phone' => $phone,
                'validationEmailRule' => $validationEmailRule,
            ];
        }
    }

    #[On('save-form')]
    public function saveForm($customer)
    {
        dd($customer);
    }

    public function klik()
    {
        $this->show = true;
    }

    public function setCircle($circle){
        $this->circle = $circle;
    }    

    public function render()
    {
        return view('livewire.payment-user.index');
    }
}
