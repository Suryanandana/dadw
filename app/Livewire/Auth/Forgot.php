<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;

class Forgot extends Component
{
// PERUBAHAN BELOM SELESAI
    public $email;

    public function submit()
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('status', __($status));
        } else {
            $this->addError('email', __($status));
        }
    }
// END PERUBAHAN BELOM SELESAI
    public function render()
    {
        return view('livewire.auth.forgot');
    }
}
