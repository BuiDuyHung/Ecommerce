@extends('layouts.admin')

@section('content')
<div style="margin-bottom: 10px;">
    <a href="{{ route('admin.indexOrder') }}" class="btn btn-danger" >Quay Lại</a>

</div>

<div class="table-agile-info">

    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin khách hàng
        </div>

        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> {{ $customer->name }} </td>
                        <td> {{ $customer->phone }} </td>
                        <td> {{ $customer->email }} </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<br>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin vận chuyển
        </div>

        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Ghi chú</th>
                        <th>Hình thức thanh toán</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <td> {{ $shipping->name }} </td>
                    <td> {{ $shipping->address }} </td>
                    <td> {{ $shipping->phone }} </td>
                    <td> {{ $shipping->email }} </td>
                    <td> {{ $shipping->notes }} </td>
                    <td>
                        @if ($shipping->method == 0)
                            Chuyển khoản
                        @else
                            Tiền mặt
                        @endif
                    </td>
                </tbody>
            </table>
        </div>
    </div>
</div>

<br><br>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Chi tiết đơn đặt hàng
        </div>
        @if(session('msg'))
            <div class="alert alert-success text-center" id="notification">
                {{session('msg')}}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                            <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên sản phẩm</th>
                        <th>Mã giảm giá</th>
                        <th>Phí ship</th>
                        <th>Số lượng</th>
                        <th>Số lượng còn lại trong kho</th>
                        <th>Giá</th>
                        <th>Tổng tiền</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        session_start();
                        $total = 0;
                    @endphp
                    @foreach ($order_detail as $item)
                        @php
                            $subtotal = $item->product_sale_quantity*$item->product_price;
                            $total+=$subtotal;

                            $quantityAfterSale =  $item->product->quantity - $item->product_sale_quantity;
                            Session::put('quantityAfterSale', $quantityAfterSale);
                        @endphp
                        <tr>
                            <td>
                                <label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                            </td>
                            <td> {{ $item->product_title }} </td>
                            <td>
                                @if ($item->product_coupon != 'no' )
                                    {{ $item->product_coupon }}
                                @else
                                    Không có mã giảm giá
                                @endif
                            </td>
                            <td> {{ number_format($item->product_feeship,'0',',','.') }} VNĐ</td>
                            <td> {{ $item->product_sale_quantity }} </td>
                            <td> {{ $quantityAfterSale }} </td>
                            <td> {{ number_format($item->product_price,'0',',','.') }} VNĐ</td>

                            <td> {{ number_format($item->product_sale_quantity*$item->product_price,'0',',','.') }} VNĐ</td>
                        </tr>
                    @endforeach
                        <tr>
                            <a style="margin-bottom: 20px; margin-top: 18px; " target="_blank" href="{{ route('admin.printOrder',$item->order_code) }}" class="btn btn-success" >In đơn hàng</a>
                        </tr>
                        <tr>
                            <select class="fix-selectProductDetail">
                                @if ($order_status == '1')
                                    <option>Đang xử lý</option>
                                @else
                                    <option>Đã giao hàng</option>
                                @endif
                            </select>
                        </tr>
                        <tr>
                            <td colspan="3">
                                @php
                                    $total_coupon = 0;
                                @endphp
                                @if ($coupon_condition == 1)
                                    @php
                                        $total_after_coupon = ($total*$coupon_value)/100;
                                        $total_coupon = $total - $total_after_coupon;
                                        echo 'Số tiền giảm : '.number_format($total_after_coupon,'0',',','.').' VNĐ';
                                    @endphp
                                @else
                                    @php
                                        $total_coupon = $total - $coupon_value;
                                        echo 'Số tiền giảm : '.number_format($coupon_value,'0',',','.').' VNĐ';
                                    @endphp
                                @endif

                                <br>
                                Phí vận chuyển : {{ number_format($item->product_feeship,'0',',','.') }} VNĐ
                                <br>
                                Tổng Thanh toán : {{ number_format($total_coupon - $item->product_feeship,'0',',','.') }} VNĐ
                            </td>
                        </tr>
                </tbody>


            </table>


        </div>
    </div>
</div>

@endsection

