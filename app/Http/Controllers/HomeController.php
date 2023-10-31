<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $categories = Category::where('status', '1')->get();
        $brands = Brand::where('status', '1')->get();
        $products = Product::where('status', '1')->orderby('id', 'desc')->limit(5)->get();

        return view('pages.main', compact('categories', 'brands', 'products'));
    }

    // Hiển thị danh sách các sản phẩm theo danh mục
    public function showCategory(string $id){
        $categories = Category::where('status', '1')->get();
        $brands = Brand::where('status', '1')->get();

        $product_by_category = Product::where('category_id', $id)->get();
        $category_by_id = Category::where('id', $id)->first();

        return view('pages.category.show', compact('categories', 'brands', 'product_by_category', 'category_by_id'));
    }

    // Hiển thị danh sách các sản phẩm theo thương hiệu
    public function showBrand(string $id){
        $categories = Category::where('status', '1')->get();
        $brands = Brand::where('status', '1')->get();

        $product_by_brand = Product::where('brand_id', $id)->get();
        $brand_by_id = Brand::where('id', $id)->first();

        return view('pages.brand.show', compact('categories', 'brands', 'product_by_brand', 'brand_by_id'));
    }

    // Hiển thị cho tiết sản phẩm
    public function detailProduct(string $id){

    }

}
