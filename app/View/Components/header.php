<?php

namespace App\View\Components;

use Illuminate\View\Component;

class header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $home;
    public $order;
    public $hasSeller;
    public function __construct()
    {
        if (auth()->user()) {
            if (auth()->user()->seller) {
                $this->hasSeller = true;
            }
        }
        $currentURL = url()->current();
        if ($currentURL == "http://127.0.0.1:8000") {
            $this->home = true;
        } else if ($currentURL == "http://127.0.0.1:8000/myorders") {
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
