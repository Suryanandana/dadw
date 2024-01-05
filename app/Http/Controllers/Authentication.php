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
        // validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:255',
        ]);
        try {
            // start transaction
            DB::beginTransaction();
            // insert table user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'level' => 'customer',
                'password' => bcrypt($request->password),
            ]);
            Customer::create([
                'phone' => $request->phone,
                'id_users' => $user->id,
            ]);
            // commit transaction
            DB::commit();
            // Kirim email verifikasi
            event(new Registered($user));
            Auth::login($user);
        } catch (\Throwable $th) {
            DB::rollBack();
            // get error message
            $error = $th->getMessage();
            // redirect and send massage error
            return redirect('/register')->with('error', $error);
        }
        // if success, redirect to login page with success message
        return redirect('/login')->with('success', 'Register success, please check your email to verify your account.');
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
                return redirect('/login')->withErrors([
                    'email' => 'Email is not validate.',
                ]);
            }
        }
        // Jika autentikasi gagal, kembalikan ke halaman login dengan pesan error
        return redirect('/login')->withErrors([
            'email' => 'Email or password is wrong.',
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
