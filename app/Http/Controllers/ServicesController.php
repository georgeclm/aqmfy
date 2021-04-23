<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:service-list|service-create|service-edit|service-delete', ['only' => ['index', 'show']]);
    //     $this->middleware('permission:service-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:service-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:service-delete', ['only' => ['destroy']]);
    // }
    function getDownload(Service $service)
    {
        $file = public_path() . "/uploads/service/{$service->image}";
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
        $categories = Category::with('services')->get();
        $services = Service::all();
        return view('service.index', compact('categories', 'services'));
    }

    function show(Service $service)
    {
        // dd($service->seller->user->id);
        $favorite = (auth()->user()) ? auth()->user()->favorite->contains($service->id) : false;
        // dd($service->ratings->count());
        $stars = array();

        if ($service->ratings()->count() != 0) {
            $average = $service->ratings()->average('rating');
            $rating = 5;
            for ($i = 0; $i < 10; $i += 2) {
                $stars[$i] = $service->ratings->where('rating', $rating)->count();
                $stars[$i + 1] = $stars[$i] / $service->ratings->count() * 100;
                $rating--;
            }
        } else {
            $average = 0;
        }

        return view('service.detail', compact('service', 'favorite', 'average', 'stars'));
    }

    public function create()
    {
        if (auth()->user()->seller) {
            $categories = Category::all();
            return view('service.add', compact('categories'));
        }
        return redirect()->route('sellers.create')->with('error', 'You are not a seller please registered Yourself First');
    }

    public function store(Request $request)
    {
        // dd(request('image'));
        if (auth()->user()->seller) {
            request()->validate([
                'name' => ['bail', 'required'],
                'category_id' => 'required',
                'price' => 'required',
                'description' => 'required',
                'image' => 'mimes:jpeg,png,jpg,gif,svg'
            ]);

            // dimensions:ratio=3/2
            $extension = $request->image->extension();
            // change the public to s3
            request('image')->storeAs('service', request('image')->hashName(), 'public');
            // dd($request->image->hashName());

            $service = new Service;
            $service->name = $request->name;
            $service->price = $request->price;
            $service->description = $request->description;
            $service->image = request('image')->hashName();
            $service->seller_id = auth()->user()->seller->id;
            $service->category_id = $request->category_id;
            $service->save();

            return redirect()->route('services.index');
        }
        return redirect()->route('sellers.create')->with('error', 'You are not a seller please registered Yourself First');
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
        if (auth()->id() != $service->seller->user_id) {
            return redirect()->route('services.index')->with('error', 'You are not the author of the photos');
        }
        $categories = Category::all();
        return view('service.edit', compact('service', 'categories'));
    }

    public function update(Service $service)
    {
        // dd($service);

        if (auth()->id() != $service->seller->user_id) {
            return redirect()->route('services.index')->with('error', 'You are not the author of the photos');
        }

        $data = request()->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg'
        ]);

        if (request('image')) {
            // change the public to s3
            request('image')->storeAs('service', request('image')->hashName(), 'public');
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
        if (auth()->id() != $service->seller->user_id) {
            return redirect()->route('services.index')->with('error', 'You are not the author of the photos');
        }
        Service::destroy($service->id);
        return redirect()->route('sellers.show', auth()->user())->with('success', 'Gig Have Been Removed');
    }
}
