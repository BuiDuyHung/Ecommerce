<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ManaOrderController extends Controller
{
    public function index(){
        $orders = Order::orderby('created_at', 'DESC')->get();

        return view('admin.order.index', compact('orders'));
    }


    // Hiển thị chi tiết thông tin đơn hàng
    public function view_order($code){
        $order_detail = OrderDetail::where('order_code', $code)->get();
        $orders = Order::where('code', $code)->get();

        foreach($orders as $item){
            $customer_id = $item->customer_id;
            $shipping_id = $item->shipping_id;
        }

        $customer = Customer::where('id', $customer_id)->first();
        $shipping = Shipping::where('id', $shipping_id)->first();
        $order_detail_2 = OrderDetail::with('product')->where('order_code', $code)->get();

        foreach($order_detail_2 as $item){
            $product_coupon = $item->product_coupon;
        }

        if($product_coupon != 'no'){
            $coupon = Coupon::where('code', $product_coupon)->first();
            $coupon_condition = $coupon->condition;
            $coupon_value = $coupon->value;
        }else{
            $coupon_condition = 2;
            $coupon_value = 0;
        }

        return view('admin.order.view', compact('order_detail', 'shipping', 'customer', 'coupon_condition', 'coupon_value'));
    }

    public function print_order(){

    }
}
