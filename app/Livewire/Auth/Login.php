<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public function submit()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required|max:255',
        ]);
        
        if(!User::firstWhere('email', $this->email)) {
            $this->addError('email', 'Email is not registered');
        } else {
            if (Auth::attempt($credentials)) {
                // Jika autentikasi berhasil
                $user = Auth::user();
                session()->regenerate();
                // Buat session untuk user
                session()->put('user', $user);
                return redirect()->to('/'); // Redirect ke halaman dashboard atau halaman setelah login berhasil
            }
            $this->addError('password', 'Password is incorrect');
        }

    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
