<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\Product;


use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\App;

class ManaOrderController extends Controller
{
    public function index(){
        $orders = Order::orderby('created_at', 'DESC')->get();

        return view('admin.order.index', compact('orders'));
    }

    // Hiển thị chi tiết thông tin đơn hàng
    public function view_order($code){
        $order_detail = OrderDetail::where('order_code', $code)->with('product')->get();
        $orders = Order::where('code', $code)->get();

        foreach($orders as $item){
            $customer_id = $item->customer_id;
            $shipping_id = $item->shipping_id;
            $order_status = $item->status;
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

        return view('admin.order.view', compact('order_detail','order_status', 'shipping', 'customer', 'coupon_condition', 'coupon_value', 'orders'));
    }

    // Cập nhật số lượng bán của sản phẩm
    public function update_quantity_sale(Request $request){
        $data = $request->all();

        $order_detail = OrderDetail::where('product_id', $data['order_product_id'])->where('order_code', $data['order_code'])->first();
        $order_detail->product_sale_quantity = $data['order_qty'];
        $order_detail->save();
    }

    // Thay đổi tình trạng đơn hàng
    public function update_order_quantity(Request $request){
        $data = $request->all();

        $order = Order::find($data['order_id']);
        $order->status = $data['order_status'];
        $order->save();
        if($order->status == 2){
            foreach($data['order_product_id'] as $key => $product_id){
                $product = Product::find($product_id);
                $product_quantity = $product->quantity;
                $product_sold = $product->sold;

                foreach($data['quantity'] as $key2 => $qty){
                    if($key == $key2){
                        $product_remain = $product_quantity - $qty;
                        $product->quantity = $product_remain;
                        $product->sold = $product_sold + $qty;
                        $product->save();
                    }
                }
            }
        }

    }

    // In thông tin đơn hàng
    public function print_order($checkout_code){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));

        return $pdf->stream();
    }

    public function print_order_convert($checkout_code){
        $order_detail = OrderDetail::where('order_code', $checkout_code)->get();
        $orders = Order::where('code', $checkout_code)->get();

        foreach($orders as $item){
            $customer_id = $item->customer_id;
            $shipping_id = $item->shipping_id;
        }

        $customer = Customer::where('id', $customer_id)->first();
        $shipping = Shipping::where('id', $shipping_id)->first();
        $order_detail_2 = OrderDetail::with('product')->where('order_code', $checkout_code)->get();
        foreach($order_detail_2 as $item){
            $product_coupon = $item->product_coupon;
        }

        if($product_coupon != 'no'){
            $coupon = Coupon::where('code', $product_coupon)->first();
            $coupon_condition = $coupon->condition;
            $coupon_value = $coupon->value;
            if($coupon_condition == 1){
                $coupon_echo = $coupon_value.'%';
            }elseif($coupon_condition == 2){
                $coupon_echo = number_format($coupon_value,0,',','.');
            }
        }else{
            $coupon_condition = 2;
            $coupon_value = 0;
        }

        $output = '';

        $output .= '
            <style>
                body{
                    font-family: DejaVu Sans;
                }
                .title-styling{
                    width: 500px;
                    padding-bottom: 20px;
                }
                .text-styling{
                    font-size: 12px;
                }
                .info-styling{
                    font-size: 12px;
                }

                .table-styling {
                    border: 0.5px solid #000;
                    width: 690px;
                }
                .table-styling tr th {
                    border: 0.25px solid #000;
                }
                .table-styling tr td{
                    border: 0.25px solid #000;
                }
            </style>
            <div class="title-styling">
                <h5>Công ty TNHH một thành viên</h5>
                <span class="text-styling">
                    Email: admin@gmail.com
                    <br>
                    Số điện thoại: 0988888888
                    <br>
                    Địa chỉ: Ba đình - Hà Nội
                </span>
            </div>

            <div>
                <h3><center>Hóa đơn mua hàng</center></h3>
                <div class="info-styling">
                    <p>
                        Khách Hàng: '.$customer->name.' <br>
                        Số điện thoại: '.$customer->phone.' <br>
                        Email: '.$customer->email.' <br>
                    </p>
                </div>

                <div>
                    <table class="table-styling">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Mã giảm giá</th>
                                <th>Số lượng</th>
                                <th>Giá sản phẩm</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>';
                        $total = 0;
                        foreach($order_detail_2 as $key => $item){
                            $subtotal =$item->product_sale_quantity * $item->product_price;
                            $total+=$subtotal;

                            if($item->product_coupon != 'no'){
                                $product_coupon = $item->product_coupon;
                            }else{
                                $product_coupon = 'Không có mã';
                            }
        $output.='
                            <tr>
                                <td>'.$item->product_title.'</td>
                                <td>'.$item->product_coupon.'</td>
                                <td>'.$item->product_sale_quantity.'</td>
                                <td>'.number_format($item->product_price,0,',','.').'</td>
                                <td>'.number_format($subtotal,0,',','.').'</td>
                            </tr>';
                    }

                    if($coupon_condition == 1){
                        $total_after_coupon = ($total*$coupon_value)/100;
                        $total_coupon = $total - $total_after_coupon;
                    }else{
                        $total_coupon = $total - $coupon_value;
                    }
        $output.='
                            <tr>
                                <td colspan="2">
                                    <p>Mã giảm: '.$coupon_echo.'</p>
                                    <p>Phí vận chuyển: '.number_format($item->product_feeship,0,',','.').'</p>
                                    <p>Thanh toán: '.number_format($total_coupon - $item->product_feeship,0,',','.').'</p>
                                </td>
                            </tr>
        ';
        $output.='
                    </tbody
                </table>
            </div>
        </div>
        <br />
        <br />

        <h5>Ký tên</h5>
        <table>
            <thead>
                <tr>
                    <th width="200px">Người lập phiếu</th>
                    <th width="800px">Người nhận</th>
                </tr>
            </thead>
            <tbody>
        ';

        $output.='
            </tbody>
        </table>
        ';

        return $output;
    }
}
