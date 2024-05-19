<?php

namespace App\Livewire\Auth;
use Livewire\Component;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class Register extends Component
{
    public string $name;
    public string $number;
    public string $email;
    public string $password;
    public string $password_confirmation;
    public string $phone;
    public string $address;
    public string $country;
    public $user;
    public $current_step = 0;
    
    public function render()
    {
        return view('livewire.auth.register');
    }

    public function back()
    {
        $this->current_step--;
    }
    
    public function next()
    {
        $this->user = $this->validate([
            'email' =>'required|email',
            'name' => 'required|string',
        ]);

        if(User::firstWhere('email', $this->email)) {
            $this->addError('email', 'Email has already been registered');
        } else {
            $this->current_step++;
        }
    }
    
    public function confirm()
    {
        $this->user = array_merge(
            $this->user,
            $this->validate([
                'password' => 'required|required_with:password_confirmation|min:8|max:50',
                'password_confirmation' => 'required|same:password'
            ])
        );
        $this->current_step++;
    }
    public function submit()
    {
        $this->resetErrorBag();
        $newuser = User::create(
            $this->user
        );

        $customer = $this->validate([
            'phone' =>'required|number',
            'address' => 'required|string',
            'country' => 'required|string',
        ]);

        Customer::create([
            $customer,
            'id_user' => $newuser->id,
        ]);

        Auth::loginUsingId($newuser->id);
        return $this->redirectIntended('/');
    }

}