<?php

namespace App\View\Components;

use App\Models\Service;
use Illuminate\View\Component;

class wishlist extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $user;
    public $wishlists;
    public $services;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->wishlists = $this->user->favorite()->pluck('service_id');
        $this->services = Service::whereIn('id', $this->wishlists)->latest()->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.wishlist');
    }
}
