<?php

namespace App\Livewire\Customer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        $user = DB::table('users')
        ->join('customer', 'customer.id_users', '=', 'users.id')
        ->where('users.id', Auth::user()->getAuthIdentifier())
        ->get()
        ->first();
        return view('livewire.customer.profile')->with('user', $user);
    }
}
