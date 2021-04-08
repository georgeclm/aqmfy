<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class GoogleController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::firstWhere('google_id', $user->id);
            $emailuser = User::firstWhere('email', $user->email);

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->route('services.index');
            } else {
                if ($emailuser) {
                    $emailuser->update(['google_id' => $user->id, 'name' => $user->name]);
                    Auth::login($emailuser);
                } else {

                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id' => $user->id,
                        'password' => encrypt(Str::random(10))
                    ]);

                    Auth::login($newUser);
                }
                return redirect()->route('services.index');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
