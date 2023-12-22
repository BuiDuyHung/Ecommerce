<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function order_place(Request $request){

        // // Insert payment
        // $paymentData = array();
        // $paymentData['method'] = $request->payment_option;
        // $paymentData['status'] = 'Đang chờ xử lý';
        // $payment_id = DB::table('tbl_payment')->insertGetId($paymentData);

        // // Insert order
        // $orderData = array();
        // $orderData['customer_id'] = Session::get('customer_id');
        // $orderData['shipping_id'] = Session::get('shipping_id');
        // $orderData['payment_id'] = $payment_id;
        // $orderData['total'] = number_format(Cart::total());
        // $orderData['status'] = 'Đang chờ xử lý';
        // $order_id = DB::table('tbl_order')->insertGetId($orderData);

        // // Insert order_detail
        // $content = Cart::content();

        // foreach($content as $item){
        //     $orderDetailData = array();
        //     $orderDetailData['order_id'] = $order_id;
        //     $orderDetailData['product_id'] = $item->id;
        //     $orderDetailData['product_name'] = $item->name;
        //     $orderDetailData['product_price'] = $item->price;
        //     $orderDetailData['product_sale_quantity'] = $item->qty;
        //     DB::table('tbl_order_detail')->insert($orderDetailData);
        // }

        // Insert payment
        // $paymentData = [
        //     'method' => $request->payment_option,
        //     'status' => 'Đang chờ xử lý',
        // ];
        // $payment = Payment::create($paymentData);
        // $payment_id = $payment->id;

        // Insert order
        // $orderData = [
        //     'customer_id' => Session::get('customer_id'),
        //     'shipping_id' => Session::get('shipping_id'),
        //     'payment_id' => $payment_id,
        //     'total' => number_format(Cart::total()),
        //     'status' => 'Đang chờ xử lý',
        // ];
        // $order = Order::create($orderData);
        // $order_id = $order->id;

        // Insert order_detail
        // $content = Cart::content();

        // foreach ($content as $item) {
        //     $orderDetailData = [
        //         'order_id' => $order_id,
        //         'product_id' => $item->id,
        //         'product_name' => $item->name,
        //         'product_price' => $item->price,
        //         'product_sale_quantity' => $item->qty,
        //     ];
        //     OrderDetail::create($orderDetailData);
        // }

        // if($paymentData['method'] == 1){
        //     echo 'Thanh toan the ATM';
        // }else if($paymentData['method'] == 2){
        //     // lấy tất cả các thể loại sản phẩm
        //     $categories = Category::where('status', '1')->get();
        //     // lấy tất cả các thương hiệu sản phẩm
        //     $brands = Brand::where('status', '1')->get();

        //     Cart::destroy();

        //     return view('pages.checkout.handcash', compact('categories', 'brands'));

        // }else{
        //     echo 'Thẻ ghi nợ';
        // }


        // return redirect()->route('home.payment');

    }

    public function confirm_order(Request $request){
        $data = $request->all();

        $shipping = new Shipping();
        $shipping->name = $data['shipping_name'];
        $shipping->address = $data['shipping_address'];
        $shipping->phone = $data['shipping_phone'];
        $shipping->email = $data['shipping_email'];
        $shipping->notes = $data['shipping_notes'];
        $shipping->method = $data['payment_select'];
        $shipping->save();

        $shipping_id = $shipping->id;
        $order_code = substr(md5(microtime()), rand(0,26), 5);

        $order = new Order();
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->code = $order_code;
        $order->status = 1;
        $order->save();

    }
}
