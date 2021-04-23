<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use PDO;

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
    public function wish(Service $service)
    {
        $favorite = (auth()->user()) ? auth()->user()->favorite->contains($service->id) : false;
        if ($favorite == true) {
            auth()->user()->favorite()->toggle($service);
            return redirect()->back()->with('warning', 'Photo have been removed');
        }
        auth()->user()->favorite()->toggle($service);
        return redirect()->back()->with('success', 'Photo Added To Wishlist');
    }
}
