<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
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

            Auth::login($authUser);
            session()->regenerate();
            // Buat session untuk user
            session()->put('user', $authUser);

            return '<script>
                setTimeout(function() {
                    window.opener.location.href = "/";
                    window.close();
                }, 100);
            </script>';
        }

       public function store($socialUser, $provider)
       {
            $socialAccount = SocialiteModel::where('provider_id', $socialUser->getId())->where('provider_name', $provider)->first();
            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$socialAccount || !$user) {
                try {
                    DB::beginTransaction();

                    $user = User::updateOrCreate([
                        'name' => $socialUser->getName() ? $socialUser->getName() : $socialUser->getNickname(),
                        'email' => $socialUser->getEmail(),
                        'level' => 3,
                    ]);
                    $user->markEmailAsVerified();

                    $user->socialite()->updateOrCreate([
                        'provider_id' => $socialUser->getId(),
                        'provider_name' => $provider,
                        'provider_token' => $socialUser->token,
                        'provider_refresh_token' => $socialUser->refreshToken
                    ]);

                    Customer::updateOrCreate([
                        'id_users' => $user->id,
                    ]);

                    DB::commit();

                    return $user; // Mengembalikan instance User
                } catch (\Throwable $th) {
                    DB::rollBack();
                    $error = $th->getMessage();
                    // Membuat log atau memberikan feedback ke pengguna
                    return redirect('/login')->with('error', $error); // RedirectResponse
                }
            } else {
                return $user; // Mengembalikan instance User
            }
        }

}
