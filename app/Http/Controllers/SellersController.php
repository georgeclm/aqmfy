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
        request()->validate([
            'sellername' =>  'required',
            'address' => 'sometimes',
            'url' => ['sometimes', 'url'],
            'description' => 'nullable',
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
            'phone_num' => 'numeric'
        ]);

        // dd($request->all());
        $seller = new Seller;
        $seller->sellername = $request->sellername;
        $seller->address = $request->address;
        $seller->url = $request->url;
        $seller->description = $request->description;
        $seller->user_id = auth()->id();
        $seller->phone_num = $request->phone_num;
        if (request('image')) {
            request()->validate([
                'image' => 'mimes:jpeg,png,jpg,gif,svg',
            ]);
            // Storage::putFileAs('profile', request()->file('image'), request('image')->hashName());
            // change the public to s3
            request('image')->storeAs('profile', request('image')->hashName(), 'public');
            $seller->image = request('image')->hashName();
        } else {
            $seller->image = "jAZHCrXvUSsoh3BtdypreKvz8tz0M4DEnDOfvvDt.png";
        }

        $seller->save();
        $seller->user->removeRole('Buyer');
        $seller->user->assignRole('Seller');


        return redirect()->route('sellers.show', $seller)->with('success', 'You are now a seller, Sell Great Photo');
    }
    function show(Seller $seller)
    {

        $services = Service::where('seller_id', $seller->id)->paginate(12);
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
            'address' => 'sometimes',
            'url' => ['sometimes', 'url'],
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
            'description' => 'sometimes',
            'phone_num' => 'numeric'
        ]);

        if (request('image')) {
            // Storage::putFileAs('profile', request()->file('image'), request('image')->hashName(), 'public');
            // change the public to s3
            request('image')->storeAs('profile', request('image')->hashName(), 'public');
            $imageArray = ['image' => request('image')->hashName()];
        }

        $seller->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect()->route('sellers.show', $seller)->with('success', 'Seller Profile Have Been Updated');
    }
}
