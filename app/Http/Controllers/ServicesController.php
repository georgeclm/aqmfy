<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServicesController extends Controller
{
    function getDownload(Service $service)
    {
        $file = public_path() . "/storage/product/{$service->image}";
        // to show the file
        // return response()->file($file);
        return response()->download($file, $service->name . ".jpg");
    }
    public function autocomplete()
    {

        $services = Service::all();
        return response()->json($services);
    }
    function index()
    {
        // dd((boolval("dara")));
        // dd(auth()->user()->seller);
        $services = Service::with('ratings')->get();
        return view('service.index', compact('services'));
    }
    function show(Service $service)
    {
        // dd($service->seller->user->id);
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
        // dd(request('image'));

        request()->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'description' => 'required',
            'delivery_time' => 'required|numeric',
            'revision_time' => 'required|numeric',
            'image' => 'mimes:jpeg,png,jpg,gif,svg'
        ]);
        $extension = $request->image->extension();
        request('image')->store('product', 'public');
        // dd($request->image->hashName());

        $service = new Service;
        $service->name = $request->name;
        $service->price = $request->price;
        $service->description = $request->description;
        $service->delivery_time = $request->delivery_time;
        $service->revision_time = $request->revision_time;
        $service->image = request('image')->hashName();
        $service->seller_id = auth()->user()->seller->id;
        $service->category_id = $request->category;

        $service->save(); // Finally, save the record.
        return redirect('/');
    }
    function search(Request $request)
    {
        // for the search engine inside database search all the name like to following value
        // dd(Session::get('services'));
        $query = $request->input('query');
        $services = Service::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->with('ratings')
            ->get();
        return view('service.search', compact('services', 'query'));
    }
    public function edit(Service $service)
    {
        $categories = Category::all();
        return view('service.edit', compact('service', 'categories'));
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
            'category_id' => ''
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
