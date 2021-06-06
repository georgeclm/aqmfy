<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartCounter extends Component
{
    protected $listeners = ['cart_updated' => 'render'];

    public function render()
    {
        $cart_count = auth()->user()->carts->count();
        return view('livewire.cart-counter', compact('cart_count'));
    }
}
