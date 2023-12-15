<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class Authentication extends Controller
{
    public function register(Request $request)
    {
        // start transaction
        DB::beginTransaction();
        // insert table user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'level' => 'customer',
            'password' => bcrypt($request->password),
        ]);
        // insert table customer
        Customer::create([
            'phone' => $request->phone,
            'id_users' => User::where('email', $request->email)->first()->id,
        ]);
        // commit transaction
        DB::commit();

        // Kirim email verifikasi
        event(new Registered($user));

        Auth::login($user);

        // return no response
        return response()->noContent();
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // Cek apakah user sudah terautentikasi dan cek apakah user sudah terverifikasi
        if (Auth::attempt($credentials)) {
            if (User::where('email', $request->email)->first()->email_verified_at != null) {
                // Jika autentikasi berhasil
                $user = Auth::user();
                $request->session()->regenerate();

                // Buat session untuk user
                $request->session()->put('user', $user);

                return redirect()->intended('/'); // Redirect ke halaman dashboard atau halaman setelah login berhasil
            } else {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/');
            }
        }

        // Jika autentikasi gagal, kembalikan ke halaman login dengan pesan error
        return redirect('/')->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
