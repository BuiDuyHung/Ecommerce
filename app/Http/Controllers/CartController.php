<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

use Illuminate\Support\Facades\Session;
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
        $meta_desc = "Giỏ hàng của bạn";
        $meta_keywords = "gio hang";
        $meta_title = "E-Shopper";
        $url_canonial = $request->url();

        return view('pages.cart.show', compact('categories', 'brands', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonial'));
    }

    public function showCartAjax(Request $request){
        // lấy tất cả các thể loại sản phẩm
        $categories = Category::where('status', '1')->get();
        // lấy tất cả các thương hiệu sản phẩm
        $brands = Brand::where('status', '1')->get();

        // Seo
        $meta_desc = "Giỏ hàng ajax";
        $meta_keywords = "gio hang ajax";
        $meta_title = "E-Shopper";
        $url_canonial = $request->url();

        return view('pages.cart.cartAjax', compact('categories', 'brands', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonial'));
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
        $session_id = substr(md5(microtime()),rand(0,26),5);

        $cart = Session::get('cart');
        if($cart == true){
            $is_avaiable = 0;
            foreach($cart as $item){
                if($item['product_id'] == $data['product_id']){
                    $is_avaiable++;
                }
            }

            if($is_avaiable == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_id' => $data['product_id'],
                    'product_title' => $data['product_title'],
                    'product_image' => $data['product_image'],
                    'product_qty' => $data['product_qty'],
                    'product_price' => $data['product_price'],
                );

                Session::put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_id' => $data['product_id'],
                'product_title' => $data['product_title'],
                'product_image' => $data['product_image'],
                'product_qty' => $data['product_qty'],
                'product_price' => $data['product_price'],
            );
        }

        Session::put('cart', $cart);
        Session::save();
    }
}
