<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;

class ProductsBlade extends Component
{
    // public $carts;

    // public function mount()
    // {
    //     $this->carts = Cart::where('user_id', auth()->id())->get();
    // }


    public function render()
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        $subtotal = $carts->sum('price');
        $tax = $subtotal * 10 / 100;
        $total = $subtotal + $tax;

        return view('livewire.products-blade', compact('carts', 'subtotal', 'tax', 'total'));
    }

    public function removeFromCart(Cart $cart)
    {
        // $this->quantity[$cart_id];
        $cart->delete();
        $this->emit('cart_updated');
        session()->flash('success', 'Photo have been removed from cart');
    }
}
