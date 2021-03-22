<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\User;
use Illuminate\View\Component;

class header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $wishlist;
    public $order;
    public $hasSeller;
    // public $categories;
    public $chat;
    public function __construct()
    {
        // $this->categories = User::categories();
        // dd($this->categories);
        if (auth()->user()) {
            if (auth()->user()->seller) {
                $this->hasSeller = true;
            }
        }
        $currentURL = url()->current();
        if ($currentURL == "http://127.0.0.1:8000/wishlists/" . auth()->id() . "/wishlist") {
            $this->wishlist = true;
        } else if ($currentURL == "http://127.0.0.1:8000/orders/" . auth()->id()) {
            $this->order = true;
        } else if ($currentURL == "http://127.0.0.1:8000/chat") {
            $this->chat = true;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $wishlist = false;
        $order = false;
        $hasSeller = false;
        $chat = false;
        $categories = User::categories();
        return view('components.header', compact('categories', 'wishlist', 'order', 'hasSeller', 'chat'));
    }
}
