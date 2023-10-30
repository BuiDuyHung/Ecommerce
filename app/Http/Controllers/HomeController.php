<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $categories = Category::where('status', '1')->get();
        $brands = Brand::where('status', '1')->get();

        return view('pages.main', compact('categories', 'brands'));
    }
}
