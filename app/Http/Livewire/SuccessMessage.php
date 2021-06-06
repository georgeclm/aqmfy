<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SuccessMessage extends Component
{
    protected $listeners = ['success' => 'render'];

    public function render()
    {
        return view('livewire.success-message');
    }
}
