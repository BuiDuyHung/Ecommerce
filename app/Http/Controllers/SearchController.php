<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

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

        // $product_by_search = DB::table('tbl_product')->where('title','like','%'.$keywords.'%')->get();
        $product_by_search = Product::where('title','like','%'.$keywords.'%')->get();

        // Seo
        $meta_desc = "Chuyên cung cấp đồ điện tử công nghệ chính hãng, mang đến chải nhiệm tốt nhất đến tay người dùng";
        $meta_keywords = "E shopper, laptop, PC, Điện thoại";
        $meta_title = "E-Shopper";
        $url_canonial = $request->url();


        return view('pages.search.show', compact('categories', 'brands', 'product_by_search', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonial'));
    }

}
