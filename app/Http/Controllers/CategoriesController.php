<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function search(Category $category)
    {

        $services = Service::where('category_id', $category->id)->with('ratings')->get();
        return view('service.categorysearch', compact('services', 'category'));
    }
}
