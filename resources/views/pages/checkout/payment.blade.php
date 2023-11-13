@extends('layouts.home')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ route('home.index') }}">Trang chủ</a></li>
              <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div><!--/breadcrums-->


        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>
        <div class="table-responsive cart_info">
            @php
                $content = Cart::content();

            @endphp
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Mô tả sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content as $item)
                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="{{ asset('uploads/'.$item->options['image']) }}" width="100px;" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href=""> {{ $item->name }} </a></h4>
                                <p>ID: {{ $item->id }}</p>
                            </td>
                            <td class="cart_price">
                                <p> {{ number_format($item->price) }} VNĐ </p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <form action="{{ route('home.updateQty') }}" method="POST">
                                        @csrf
                                        <div class="quantity-controls">
                                            {{-- <input type="submit" value="-" name="update_qty" class="btn btn-default btn-sm quantity-button"> --}}
                                            <input class="cart_quantity_input" type="text" name="quantity_cart" value="{{ $item->qty }}" autocomplete="off" size="2">
                                            {{-- <input type="submit" value="+" name="update_qty" class="btn btn-default btn-sm quantity-button"> --}}

                                            <input type="hidden" value="{{ $item->rowId }}" name="rowId_cart" class="btn btn-default btn-sm">
                                        </div>
                                    </form>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    @php
                                        $subtotal = $item->price * $item->qty;
                                        echo number_format($subtotal).' VNĐ';
                                    @endphp
                                </p>
                            </td>
                            <td class="cart_delete">
                                {{-- <a class="cart_quantity_delete" href="{{ route('home.deleteCart', $item->rowId) }}"><i class="fa fa-times"></i></a> --}}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="review-payment">
            <h2>Chọn hình thức thanh toán</h2>
        </div>

        <form action="{{ route('home.orderPlace') }}" method="POST">
            @csrf
            <div class="payment-options bill-fix">
                <span>
                    <label><input name="payment_option" value="1" type="checkbox"> Trả bằng thẻ ATM</label>
                </span>
                <span>
                    <label><input name="payment_option" value="2" type="checkbox"> Nhận tiền mặt</label>
                </span>
                {{-- <span>
                    <label><input type="checkbox"> Paypal</label>
                </span> --}}
                <input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-fix">
            </div>

        </form>

    </div>
</section> <!--/#cart_items-->
@endsection
