<?php

namespace App\View\Components;

use Illuminate\View\Component;

class review extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $serviceid;
    public $orderid;
    public function __construct($serviceid, $orderid)
    {
        $this->orderid = $orderid;
        $this->serviceid = $serviceid;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.review');
    }
}
