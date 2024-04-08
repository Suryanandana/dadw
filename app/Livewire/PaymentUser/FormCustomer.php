<?php

namespace App\Livewire\PaymentUser;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FormCustomer extends Component
{
    public $country = '';
    public $successMessage = '';
    public $name;
    public $email;
    public $phone;
    public $address;
    public $pax;
    public $validationEmailRule = 'email|required|unique:users,email';

    public function mount($customer)
    {
        if(isset($customer)){
            $this->name = $customer['name'];
            $this->phone = $customer['phone'];
            $this->email = $customer['email'];
            $this->country = $customer['country'];
            $this->address = $customer['address'];
            $this->validationEmailRule = $customer['validationEmailRule'];
        }
    }

    public function dispatchCountry($country)
    {
        $this->country = $country;
        $this->dispatch('country-updated', $country);
    }

    public function updatedCountry()
    {
        $this->validate([
            'country' => 'required',
        ], [
        ], [
            'country' => 'Country',
        ]);
        $this->dispatch('country-updated', $this->country);
    }
    public function updatedAddress()
    {
        $this->validate([
            'address' => 'required',
        ], [
        ], [
            'address' => 'Address',
        ]);
        $this->dispatch('address-updated', $this->address);
    }    
    public function updatedPhone()
    {
        $this->validate([
            'phone' => 'required|numeric|min:10',
        ], [
        ], [
            'phone' => 'Phone',
        ]);
        $this->dispatch('phone-updated', $this->phone);
    }
    public function updatedName()
    {
        $this->dispatch('name-updated', $this->name);
        $this->validate([
            'name' => 'required',
        ], [
        ], [
            'name' => 'Name',
        ]);
    }
    public function updatedEmail()
    {
        $this->dispatch('email-updated', $this->email);
        $this->validate([
            'email' => $this->validationEmailRule,
        ], [
        ], [
            'email' => 'Email',
        ]);
    }

    public function setPax($pax)
    {
        $this->dispatch('pax-updated', $pax);
    }

    #[On('pax-updated')]
    public function pax($pax)
    {
        $this->pax = $pax;
    }

    #[On('submit-form')]
    public function validateForm()
    {
        $this->validate([
            'name' => 'required',
            'email' => $this->validationEmailRule,
            'phone' => 'required|numeric|min:10',
            'country' => 'required',
            'address' => 'required',
            'pax' => 'required|numeric|min:1|max:3',

        ],[
            'pax.required' => 'Must choose pax',
        ],[
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'phone',
            'country' => 'Country',
            'address' => 'Address',
            'pax' => 'Pax',
        ]);
        $customer = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'country' => $this->country,
            'address' => $this->address,
            'pax' => $this->pax,
        ];
        $this->dispatch('save-form', $customer);
    }

    public function render()
    {
        return view('livewire.payment-user.form-customer');
    }
}