<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistsController extends Controller
{
    public function show(User $user)
    {
        $wishlists = Wishlist::where('user_id', $user->id)->get();
        return view('wishlist.detail', compact('wishlists'));
    }
    public function store(Request $request)
    {
        $wishlist = new Wishlist;
        $wishlist->user_id = auth()->id();
        $wishlist->service_id = $request->service_id;
        $wishlist->save();
        return redirect()->back()->with('success', 'Service added to wishlist');
    }
    public function destroy(Wishlist $wishlist)
    {
        Wishlist::destroy($wishlist->id);
        return redirect()->back()->with('success', 'Service have been removed from wishlist');
    }
}
