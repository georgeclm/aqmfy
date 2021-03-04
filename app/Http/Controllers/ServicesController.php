<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    function index()
    {
        $services = Service::all();
        return view('service.index', compact('services'));
    }
    function show(Service $service)
    {
        return view('service.detail', compact('service'));
    }
    public function create()
    {
        return view('service.add');
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
            "category" => $request->category,
            "description" => $request->description,
            "delivery_time" => $request->delivery_time,
            "revision_time" => $request->revision_time,
            "image" => $request->image->hashName(),
            "user_id" => auth()->id()
        ]);
        $service->save(); // Finally, save the record.
        return redirect('/');
    }
    function search(Request $request)
    {
        // for the search engine inside database search all the name like to following value
        $query = $request->input('query');
        $services = Service::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('category', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->get();
        return view('service.search', compact('services'));
    }
}
