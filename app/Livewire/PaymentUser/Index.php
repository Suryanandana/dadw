<?php

namespace App\Livewire\PaymentUser;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        try {
            // start transaction
            DB::beginTransaction();
            $user = DB::table('users')->select('id')->where('email', $customer['email'])->first();
            if ($user) {
                // Update user if email exists (user login with email)
                $this->updateIfEmailExists($customer, $user->id);
            } else {
                // Insert new user if email doesn't exist
                $this->insertIfEmailNotExists($customer);
            }
            // commit transaction
            DB::commit();
            $this->dispatch('complete', true);
        } catch (\Exception $e) {
            // return error message with session
            session()->flash('error', $e->getMessage());
            dd($e->getMessage());
        }
    }

    public function updateIfEmailExists($customer, $id_user)
    {
        DB::table('users')
            ->where('email', $customer['email'])
            ->update([
                'name' => $customer['name'],
            ]);
        DB::table('customer')
            ->where('id_users', $id_user)
            ->update([
                'country' => $customer['country'],
                'address' => $customer['address'],
                'phone' => $customer['phone']
            ]);
        // send email notification base on email if email_verified_at is null
        $user = User::find($id_user);
        if (!$user->email_verified_at) {
            // event(new Registered($user));
            $this->dispatch('next', false);
        } else {
            $this->dispatch('next', true);
        }
    }

    public function insertIfEmailNotExists($customer)
    {
        // generate random password
        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
        $user = User::create([
            'name' => $customer['name'],
            'email' => $customer['email'],
            'level' => 'customer',
            'password' => bcrypt($password),
        ]);
        DB::table('customer')->insert([
            'id_users' => $user->id,
            'country' => $customer['country'],
            'address' => $customer['address'],
            'phone' => $customer['phone']
        ]);
        // send email notification base on email
        event(new Registered($user));
        Auth::login($user);
        // refresh navbar
        $this->dispatch('refreshNavbar');
        // dispatch set user_id
        $this->dispatch('setUserId', $user->id);
        // dispatch next
        $this->dispatch('next', false);
    }

    public function klik()
    {
        $this->show = true;
    }

    public function setCircle($circle)
    {
        $this->circle = $circle;
    }

    public function render()
    {
        return view('livewire.payment-user.index');
    }
}
