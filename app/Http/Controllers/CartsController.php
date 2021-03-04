<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    public function show(User $user)
    {
        $carts = Cart::where('user_id', $user->id)->get();
        return view('cart.detail', compact('carts'));
    }
    public function store(Request $request)
    {
        $cart = new Cart;
        $cart->user_id = auth()->id();
        $cart->service_id = $request->service_id;
        $cart->save();
        return redirect()->back()->with('success', 'Service added to wishlist');
    }
    public function destroy(Cart $cart)
    {
        Cart::destroy($cart->id);
        return redirect()->back()->with('success', 'Service have been removed from wishlist');
    }
}
