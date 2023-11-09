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
        // lấy tất cả các thể loại sản phẩm
        $categories = Category::where('status', '1')->get();

        // lấy tất cả các thương hiệu sản phẩm
        $brands = Brand::where('status', '1')->get();

        // lấy 10 sản phẩm phẩm mới nhất
        $products = Product::where('status', '1')->orderby('id', 'desc')->limit(9)->get();

        return view('pages.main', compact('categories', 'brands', 'products'));
    }

    // Hiển thị danh sách các sản phẩm theo danh mục
    public function showCategory(string $id){
        $categories = Category::where('status', '1')->get();
        $brands = Brand::where('status', '1')->get();

        // lấy sản phẩm theo thể loại sản phẩm(category_id)
        $product_by_category = Product::where('category_id', $id)->get();
        // lấy thể loại sản phẩm theo id
        $category_by_id = Category::where('id', $id)->first();

        return view('pages.category.show', compact('categories', 'brands', 'product_by_category', 'category_by_id'));
    }

    // Hiển thị danh sách các sản phẩm theo thương hiệu
    public function showBrand(string $id){
        $categories = Category::where('status', '1')->get();
        $brands = Brand::where('status', '1')->get();

        // lấy sản phẩm theo thương hiệu
        $product_by_brand = Product::where('brand_id', $id)->get();
        // lấy thương hiệu theo id
        $brand_by_id = Brand::where('id', $id)->first();

        return view('pages.brand.show', compact('categories', 'brands', 'product_by_brand', 'brand_by_id'));
    }

    // Hiển thị cho tiết sản phẩm
    public function detailProduct(string $id){
        $categories = Category::where('status', '1')->get();
        $brands = Brand::where('status', '1')->get();

        // lấy ra chi tiết sản phẩm theo id
        $detail_product = Product::where('id', $id)->get();

        foreach ($detail_product as $key){
            $category_id = $key->category_id;
        }
        //lấy ra các sản phẩm liên quan theo thương hiệu(category_id)
        $related_product = Product::where('category_id', $category_id)->whereNotIn('id', [$id])->get();

        return view('pages.product.detail', compact('categories', 'brands', 'detail_product','related_product'));
    }

}
