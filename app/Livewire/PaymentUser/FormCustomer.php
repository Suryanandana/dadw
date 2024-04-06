<?php

namespace App\Livewire\PaymentUser;

use Livewire\Component;
use Livewire\Attributes\Validate;

class FormCustomer extends Component
{
    public $country = '';
    public $successMessage = '';
    public $name;
    public $email;
    public $number;
    public $address;
    public function updatedCountry()
    {
        $this->dispatch('country-updated', $this->country);
    }
    public function updatedAddress()
    {
        $this->dispatch('address-updated', $this->address);
    }
    public function setPax($pax)
    {
        $this->dispatch('pax-updated', $pax);
    }
    public function updatedNumber()
    {
        $this->dispatch('number-updated', $this->number);
    }
    public function dispatchCountry($country)
    {
        $this->country = $country;
        $this->dispatch('country-updated', $country);
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
            'email' => 'email',
        ], [
        ], [
            'email' => 'Email',
        ]);
    }

    public function render()
    {
        return view('livewire.payment-user.form-customer');
    }
}