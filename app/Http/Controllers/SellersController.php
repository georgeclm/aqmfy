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
        $seller->description = $request->description;
        $seller->user_id = auth()->id();
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);
        }
        $request->file('image')->store('product', 'public');
        $seller->image = $request->image->hashName();
        $seller->save();


        return redirect('/');
    }
    function show(Seller $seller)
    {
        $services = Service::where('seller_id', $seller->id)->get();
        $follows = (auth()->user()) ? auth()->user()->following->contains($seller->id) : false;
        return view('seller.detail', compact('seller', 'services', 'follows'));
    }
    public function edit(Seller $seller)
    {
        return view('seller.edit', compact('seller'));
    }
    public function update(Seller $seller)
    {
        $data = request()->validate([
            'sellername' => 'required',
            'address' => 'required',
            'url' => '',
            'image' => 'image',
            'description' => ''
        ]);
        if (request('image')) {
            request('image')->store('product', 'public');
            $imageArray = ['image' => request('image')->hashName()];
        }
        $seller->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        return redirect()->route('sellers.show', $seller)->with('success', 'Seller Profile Have Been Updated');
    }
}
