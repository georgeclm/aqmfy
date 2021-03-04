<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Service;
use Illuminate\Http\Request;

class SellersController extends Controller
{
    function create()
    {
        return view('seller.add');
    }
    function store(Request $request)
    {
        $seller = new Seller;
        $seller->sellername = $request->sellername;
        $seller->address = $request->address;
        $seller->url = $request->url;
        $seller->user_id = auth()->id();
        $seller->save();
        return redirect('/');
    }
    function show(Seller $seller)
    {
        $services = Service::where('user_id', $seller->user_id)->get();
        return view('seller.detail', compact('seller', 'services'));
    }
}
