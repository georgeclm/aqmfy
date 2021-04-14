<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;



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
            $finduser = User::firstWhere('google_id', $user->getId());
            $emailuser = User::firstWhere('email', $user->getEmail());

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->route('services.index')->with('success', 'Google Account Logged In');
            }

            if ($emailuser) {
                $emailuser->update(['google_id' => $user->getId(), 'name' => $user->getName()]);
                Auth::login($emailuser);
                return redirect()->route('services.index')->with('success', 'Acoount has been changed with Google');
            }

            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'google_id' => $user->getId(),
                'password' => encrypt(Str::random(10))
            ]);

            $newUser->assignRole('Buyer');
            Auth::login($newUser);
            return redirect()->route('services.index')->with('success', 'Google Account Created');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
