<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

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
            'delivery_time' => 'required',
            'revision_time' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);
        }
        $request->file('image')->store('product', 'public');
        $product = new Service([
            "name" => $request->get('name'),
            "price" => $request->get('price'),
            "category" => $request->get('category'),
            "description" => $request->get('description'),
            "delivery_time" => $request->get('delivery_time'),
            "revision_time" => $request->get('revision_time'),
            "image" => $request->file('image')->hashName(),
            "user_id" => auth()->id()
        ]);
        $product->save(); // Finally, save the record.
        return redirect('/');
    }
}
