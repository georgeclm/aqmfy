<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;

class WishlistsController extends Controller
{
    public function show()
    {
        return view('wishlist.detail');
    }

    public function add(Service $service)
    {
        return auth()->user()->favorite()->toggle($service);
    }
}
