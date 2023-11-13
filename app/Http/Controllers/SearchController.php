<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        // lấy tất cả các thể loại sản phẩm
        $categories = Category::where('status', '1')->get();
        // lấy tất cả các thương hiệu sản phẩm
        $brands = Brand::where('status', '1')->get();

        $keywords = $request->keywords;
        // lấy sản phẩm thông qua từ khóa tìm kiếm
        $product_by_search = DB::table('tbl_product')->where('title','like','%'.$keywords.'%')->get();

        return view('pages.search.show', compact('categories', 'brands', 'product_by_search'));
    }

}
