<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function order_place(Request $request){
        // Insert payment
        $paymentData = array();
        $paymentData['method'] = $request->payment_option;
        $paymentData['status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($paymentData);

        // Insert order
        $orderData = array();
        $orderData['customer_id'] = Session::get('customer_id');
        $orderData['shipping_id'] = Session::get('shipping_id');
        $orderData['payment_id'] = $payment_id;
        $orderData['total'] = number_format(Cart::total());
        $orderData['status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($orderData);

        // Insert order_detail
        $content = Cart::content();

        foreach($content as $item){
            $orderDetailData = array();
            $orderDetailData['order_id'] = $order_id;
            $orderDetailData['product_id'] = $item->id;
            $orderDetailData['product_name'] = $item->name;
            $orderDetailData['product_price'] = $item->price;
            $orderDetailData['product_sale_quantity'] = $item->qty;
            DB::table('tbl_order_detail')->insert($orderDetailData);
        }

        if($paymentData['method'] == 1){
            echo 'Thanh toan the ATM';
        }else if($paymentData['method'] == 2){
            // lấy tất cả các thể loại sản phẩm
            $categories = Category::where('status', '1')->get();
            // lấy tất cả các thương hiệu sản phẩm
            $brands = Brand::where('status', '1')->get();

            Cart::destroy();

            return view('pages.checkout.handcash', compact('categories', 'brands'));

        }else{
            echo 'Thẻ ghi nợ';
        }

        return redirect()->route('home.payment');

    }
}
