<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Seller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    function follow(Seller $seller)
    {
        return auth()->user()->following()->toggle($seller);
    }
    function edit(User $user)
    {
        return view('profile.edit', compact('user'));
    }
    function update(User $user)
    {
        // dd(request()->all());
        $data = request()->validate(['name' => 'required', 'email' => 'required']);
        $user->update($data);
        return redirect()->route('profiles.edit', auth()->user())->with('success', 'Profile have been updated');
    }
}
