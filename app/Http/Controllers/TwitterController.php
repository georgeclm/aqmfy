<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;



class TwitterController extends Controller
{

    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback()
    {
        try {
            $user = Socialite::driver('twitter')->user();
            $finduser = User::firstWhere('twitter_id', $user->id);
            $emailuser = User::firstWhere('email', $user->email);

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->route('services.index')->with('success', 'Twitter Account Logged In');
            }

            if ($emailuser) {
                $emailuser->update(['twitter_id' => $user->id, 'name' => $user->name]);
                Auth::login($emailuser);
                return redirect()->route('services.index')->with('success', 'Acoount has been changed with Twitter');
            }

            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'twitter_id' => $user->id,
                'password' => encrypt(Str::random(10))
            ]);

            $newUser->assignRole('Buyer');
            Auth::login($newUser);
            return redirect()->route('services.index')->with('success', 'Twitter Account Created');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
