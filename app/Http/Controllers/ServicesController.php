<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Seller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    function index()
    {
        $services = Service::all();
        $first = $services[0]->id;
        return view('service.index', compact('services', 'first'));
    }
    function show(Service $service)
    {
        $favorite = (auth()->user()) ? auth()->user()->favorite->contains($service->id) : false;
        return view('service.detail', compact('service', 'favorite'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('service.add', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'description' => 'required',
            'delivery_time' => 'required|numeric',
            'revision_time' => 'required|numeric',
        ]);
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);
        }
        $request->file('image')->store('product', 'public');
        // dd($request->image->hashName());

        $service = new Service([
            "name" => $request->name,
            "price" => $request->price,
            "description" => $request->description,
            "delivery_time" => $request->delivery_time,
            "revision_time" => $request->revision_time,
            "image" => $request->image->hashName(),
            "seller_id" => auth()->user()->seller->id,
            "category_id" => $request->category
        ]);
        $service->save(); // Finally, save the record.
        return redirect('/');
    }
    function search(Request $request)
    {
        // for the search engine inside database search all the name like to following value
        $query = $request->input('query');
        $services = Service::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->get();
        return view('service.search', compact('services'));
    }
    public function edit(Service $service)
    {
        return view('service.edit', compact('service'));
    }
    public function update(Service $service)
    {
        $data = request()->validate([
            'name' => '',
            'price' => '',
            'delivery_time' => '',
            'revision_time' => '',
            'category' => '',
            'description' => '',
            'image' => 'image',
        ]);
        if (request('image')) {
            request('image')->store('product', 'public');
            $imageArray = ['image' => request('image')->hashName()];
        }
        $service->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        return redirect()->route('services.show', $service)->with('success', 'Gig Have Been Updated');
    }
    public function destroy(Service $service)
    {
        Service::destroy($service->id);
        return redirect()->route('sellers.show', auth()->user())->with('success', 'Gig Have Been Removed');
    }
}
