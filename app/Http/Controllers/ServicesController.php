<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Seller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServicesController extends Controller
{
    function index()
    {
        $services = Service::with('ratings')->get();
        $first = $services[0]->id;
        return view('service.index', compact('services', 'first'));
    }
    function show(Service $service)
    {
        $favorite = (auth()->user()) ? auth()->user()->favorite->contains($service->id) : false;
        // dd($service->ratings->count());
        $stars = array();
        if ($service->ratings->count() != 0) {
            $average = $service->ratings->average('rating');
            $stars[0] = $service->ratings->where('rating', 5)->count();
            $stars[1] =  $stars[0] / $service->ratings->count() * 100;
            $stars[2] = $service->ratings->where('rating', 4)->count();
            $stars[3] =  $stars[2] / $service->ratings->count() * 100;
            $stars[4] = $service->ratings->where('rating', 3)->count();
            $stars[5] =  $stars[4] / $service->ratings->count() * 100;
            $stars[6] = $service->ratings->where('rating', 2)->count();
            $stars[7] =  $stars[6] / $service->ratings->count() * 100;
            $stars[8] = $service->ratings->where('rating', 1)->count();
            $stars[9] =  $stars[8] / $service->ratings->count() * 100;
        } else {
            $average = 0;
        }

        return view('service.detail', compact('service', 'favorite', 'average', 'stars'));
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
        // dd(Session::get('services'));
        $query = $request->input('query');
        if ($query == null) {
            $services = Session::get('services');
        } else {
            $services = Service::where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('description', 'LIKE', '%' . $query . '%')
                ->get();
        }
        return view('service.search', compact('services'));
    }
    public function edit(Service $service)
    {
        return view('service.edit', compact('service'));
    }
    public function update(Service $service)
    {
        $data = request()->validate([
            'name' => 'required',
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
