<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;

class CategoriesController extends Controller
{
    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Category $category)
    {
        $services = Service::where('category_id', $category->id)->with('ratings')->get();
        return view('service.categorysearch', compact('services', 'category'));
    }
}
