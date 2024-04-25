<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Socialite as SocialiteModel;

class SocialiteController extends Controller
{
       public function redirect($provider)
       {
            return Socialite::driver($provider)->redirect();
       }

       public function callback($provider)
       {
            $socialUser = Socialite::driver($provider)->stateless()->user();
            $authUser = $this->store($socialUser, $provider);

            // Jika pengguna menggunakan OAuth, dan email dari penyedia OAuth sudah diverifikasi,
            // maka tidak perlu menandai email sebagai diverifikasi di aplikasi Anda.
            if (!$authUser->hasVerifiedEmail() && $socialUser->getEmail() && $socialUser->getEmailVerified()) {
                $authUser->markEmailAsVerified();
            }

            Auth::login($authUser);
            return redirect()->intended('/');
       }

       public function store($socialUser, $provider)
       {
            $socialAccount = SocialiteModel::where('provider_id', $socialUser->getId())->where('provider_name', $provider)->first();

            #If Validate Section
            if (!$socialAccount) {
                $user = User::where('email', $socialUser->getEmail())->first();
                # DB Transaction Section
                try {
                    DB::beginTransaction();
                        if(!$user) {
                            $user = User::updateOrCreate([
                                'name' => $socialUser->getName() ? $socialUser->getName() : $socialUser->getNickname(),
                                'email' => $socialUser->getEmail(),
                            ]);
                        }

                        $user->socialite()->create([
                            'provider_id' => $socialUser->getId(),
                            'provider_name' => $provider,
                            'provider_token' => $socialUser->token,
                            'provider_refresh_token' => $socialUser->refreshToken
                        ]);

                        return $user;
                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollBack();

                    $error = $th->getMessage();

                    return redirect('/login')->with('error', $error);
                }
                # End DB Transaction Section
            } 
            #End Of If Validate Section

            return $socialAccount->user;
       }
}
