<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;


class CartController extends Controller
{

    public function show(){
        // lấy tất cả các thể loại sản phẩm
        $categories = Category::where('status', '1')->get();
        // lấy tất cả các thương hiệu sản phẩm
        $brands = Brand::where('status', '1')->get();

        return view('pages.cart.show', compact('categories', 'brands'));
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
}
