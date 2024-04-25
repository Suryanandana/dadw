<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

            Auth::login($authUser);
            return redirect()->intended('/');
       }

       public function store($socialUser, $provider)
       {
            $socialAccount = SocialiteModel::where('provider_id', $socialUser->getId())->where('provider_name', $provider)->first();

            if (!$socialAccount) {
                $user = User::where('email', $socialUser->getEmail())->first();

                try {
                    DB::beginTransaction();

                    if (!$user) {
                        $user = User::create([
                            'name' => $socialUser->getName() ? $socialUser->getName() : $socialUser->getNickname(),
                            'email' => $socialUser->getEmail(),
                            'email_verified_at' => Carbon::now('Asia/Singapore')
                        ]);
                    }

                    $user->socialite()->create([
                        'provider_id' => $socialUser->getId(),
                        'provider_name' => $provider,
                        'provider_token' => $socialUser->token,
                        'provider_refresh_token' => $socialUser->refreshToken
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
                return $socialAccount->user; // Mengembalikan instance User
            }
        }

}
