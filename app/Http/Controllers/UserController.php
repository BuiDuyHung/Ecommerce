<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(){
        // lấy tất cả các thể loại sản phẩm
        $categories = Category::where('status', '1')->get();
        // lấy tất cả các thương hiệu sản phẩm
        $brands = Brand::where('status', '1')->get();

        return view('user.show', compact('categories', 'brands'));
    }
}
