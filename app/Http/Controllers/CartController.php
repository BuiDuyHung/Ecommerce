<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;


class CartController extends Controller
{

    public function show(Request $request){
        // lấy tất cả các thể loại sản phẩm
        $categories = Category::where('status', '1')->get();
        // lấy tất cả các thương hiệu sản phẩm
        $brands = Brand::where('status', '1')->get();

        // Seo
        $meta_desc = "Chuyên cung cấp đồ điện tử công nghệ chính hãng, mang đến chải nhiệm tốt nhất đến tay người dùng";
        $meta_keywords = "E shopper, laptop, PC, Điện thoại";
        $meta_title = "E-Shopper";
        $url_canonial = $request->url();

        return view('pages.cart.show', compact('categories', 'brands', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonial'));
    }

    public function save(Request $request){
        $productId = $request->productId_hidden;
        $quantity = $request->quantity;

        // lấy sản phẩm theo productId
        $product = Product::where('id', $productId)->first();

        // shopping cart
        $data['id'] = $product->id;
        $data['qty'] = $quantity;
        $data['name'] = $product->title;
        $data['price'] = $product->price;
        $data['weight'] = '28';
        $data['options']['image'] = $product->image;
        Cart::add($data);

        return redirect()->route('home.showCart');
    }

    public function delete(string $id){
        // xóa sản phẩm có rowId
        Cart::update($id,0);

        return redirect()->route('home.showCart');
    }

    public function updateQty(Request $request){
        $rowId = $request->rowId_cart;
        $item = Cart::get($rowId);

        // cập nhật lại số lượng sản phẩm trong giỏ hàng
        if ($request->input('update_qty') === '+') {
            $qty = $item->qty + 1;

        } elseif ($request->input('update_qty') === '-') {
            $qty = $item->qty - 1;
        }

        Cart::update($rowId, $qty);

        return redirect()->route('home.showCart');
    }

    public function addCartAjax(Request $request){
        $data = $request->all();
        print_r($data);
    }
}
