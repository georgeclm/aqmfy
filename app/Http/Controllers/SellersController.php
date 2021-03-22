<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellersController extends Controller
{
    function create()
    {
        return view('seller.add');
    }
    function store(Request $request)
    {
        request()->validate([
            'sellername' => 'bail|required',
            'address' => 'sometimes',
            'url' => 'sometimes|url',
            'description' => 'nullable'
        ]);
        // dd($request->all());
        $seller = new Seller;
        $seller->sellername = $request->sellername;
        $seller->address = $request->address;
        $seller->url = $request->url;
        $seller->description = $request->description;
        $seller->user_id = auth()->id();
        if (request('image')) {
            request()->validate([
                'image' => 'mimes:jpeg,png,jpg,gif,svg',
            ]);
            Storage::disk('public')->put(request('image')->hashName(), request('image'));
            request('image')->store('upload', 'public');
            $seller->image = request('image')->hashName();
        } else {
            $seller->image = "jAZHCrXvUSsoh3BtdypreKvz8tz0M4DEnDOfvvDt.png";
        }

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
            'sellername' => 'bail|required',
            'address' => 'sometimes',
            'url' => 'sometimes|url',
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
            'description' => 'sometimes'
        ]);
        if (request('image')) {
            Storage::disk('public')->put(request('image')->hashName(), request('image'));

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
