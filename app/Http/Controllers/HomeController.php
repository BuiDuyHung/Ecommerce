<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Seo
        $meta_desc = "Chuyên cung cấp đồ điện tử công nghệ chính hãng, mang đến chải nhiệm tốt nhất đến tay người dùng";
        $meta_keywords = "E shopper, laptop, PC, Điện thoại";
        $meta_title = "E-Shopper";
        $url_canonial = $request->url();

        // lấy tất cả các thể loại sản phẩm
        $categories = Category::where('status', '1')->get();
        // lấy tất cả các thương hiệu sản phẩm
        $brands = Brand::where('status', '1')->get();

        // lấy 10 sản phẩm phẩm mới nhất
        $products = Product::where('status', '1')->orderby('id', 'desc')->limit(9)->get();

        return view('pages.main', compact('categories', 'brands', 'products', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonial'));
    }

    // Hiển thị danh sách các sản phẩm theo danh mục
    public function showCategory(Request $request, $id){
        $categories = Category::where('status', '1')->get();
        $brands = Brand::where('status', '1')->get();

        // lấy sản phẩm theo thể loại sản phẩm(category_id)
        $product_by_category = Product::where('category_id', $id)->get();

        // lấy thể loại sản phẩm theo id
        $category_by_id = Category::where('id', $id)->first();
        $category_by_id_2 = Category::where('id', $id)->get();

        // Seo
        foreach ($category_by_id_2 as $item){
            $meta_desc = $item->desc;
            $meta_keywords = $item->keywords;
            $meta_title = $item->title;
            $url_canonial = $request->url();
        }

        return view('pages.category.show', compact('categories', 'brands', 'product_by_category', 'category_by_id', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonial'));
    }

    // Hiển thị danh sách các sản phẩm theo thương hiệu
    public function showBrand(Request $request, $id){
        $categories = Category::where('status', '1')->get();
        $brands = Brand::where('status', '1')->get();

        // lấy sản phẩm theo thương hiệu
        $product_by_brand = Product::where('brand_id', $id)->get();
        // lấy thương hiệu theo id
        $brand_by_id = Brand::where('id', $id)->first();
        $brand_by_id_2 = Brand::where('id', $id)->get();

        // Seo
        foreach ($brand_by_id_2 as $item){
            $meta_desc = $item->desc;
            $meta_keywords = $item->keywords;
            $meta_title = $item->title;
            $url_canonial = $request->url();
        }

        return view('pages.brand.show', compact('categories', 'brands', 'product_by_brand', 'brand_by_id', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonial'));
    }

    // Hiển thị cho tiết sản phẩm
    public function detailProduct(Request $request, $id){
        $categories = Category::where('status', '1')->get();
        $brands = Brand::where('status', '1')->get();

        // lấy ra chi tiết sản phẩm theo id
        $detail_product = Product::where('id', $id)->get();

        // Seo
        foreach ($detail_product as $item){
            $meta_desc = $item->desc;
            $meta_keywords = $item->keywords;
            $meta_title = $item->title;
            $url_canonial = $request->url();
        }

        foreach ($detail_product as $key){
            $category_id = $key->category_id;
        }
        //lấy ra các sản phẩm liên quan theo thương hiệu(category_id)
        $related_product = Product::where('category_id', $category_id)->whereNotIn('id', [$id])->get();

        return view('pages.product.detail', compact('categories', 'brands', 'detail_product','related_product', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonial'));
    }

    // Hàm gửi mail
    public function send_email(){
        $to_name = "Bùi Hùng";
        $to_email = "hungb.z98@gmail.com";

        $data =  array("name"=>"Mail từ tài khoản khách hàng", "body"=>"Mail gửi về vấn đề hàng hóa");

        Mail::send("pages.email.send", $data, function($message) use ($to_name, $to_email){
            $message->to($to_email)->subject("Test send email");
            $message->from($to_email, $to_name);
        });
    }



}
