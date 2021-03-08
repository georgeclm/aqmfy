<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function search(Category $category)
    {
        $services = Category::where('id', $category->id)->with('service')->get();
        dd($services);
    }
}
