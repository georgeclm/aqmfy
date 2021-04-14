<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;


class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::firstWhere('facebook_id', $user->id);
            $emailuser = User::firstWhere('email', $user->email);

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->route('services.index')->with('success', 'Facebook Account Logged In');
            }

            if ($emailuser) {
                $emailuser->update(['facebook_id' => $user->id, 'name' => $user->name]);
                Auth::login($emailuser);
                return redirect()->route('services.index')->with('success', 'Account has been changed with Facebook');
            }

            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'facebook_id' => $user->id,
                'password' => encrypt(Str::random(10))
            ]);

            $newUser->assignRole('Buyer');
            Auth::login($newUser);
            return redirect()->route('services.index')->with('success', 'Facebook Account Created');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
