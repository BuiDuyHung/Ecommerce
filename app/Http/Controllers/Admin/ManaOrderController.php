<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ManaOrderController extends Controller
{
    public function index(){
        $orders = Order::all();

        return view('admin.order.index', compact('orders'));
    }

    // Hiển thị chi tiết thông tin đơn hàng
    public function view($id){
        $customer = Customer::find($id);
        $shipping = Shipping::find($id);

        $order_detail = OrderDetail::where('order_id', $id)->get();

        return view('admin.order.view', compact('order_detail', 'shipping', 'customer'));
    }
}
