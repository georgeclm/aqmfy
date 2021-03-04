<?php

namespace App\View\Components;

use App\Models\Wishlist;
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
    public $wishlistCount;
    public function __construct()
    {
        if (auth()->user()) {
            if (auth()->user()->seller) {
                $this->hasSeller = true;
            }
            if (auth()->user()->wishlist) {
                $this->wishlistCount = Wishlist::where('user_id', auth()->id())->count();;
            }
        }
        $currentURL = url()->current();
        if ($currentURL == "http://127.0.0.1:8000/wishslists/" . auth()->id() . "/wishlist") {
            $this->wishlist = true;
        } else if ($currentURL == "http://127.0.0.1:8000/orders/" . auth()->id()) {
            $this->order = true;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.header');
    }
}
