@extends('layouts.home')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ route('home.index') }}">Trang chủ</a></li>
              <li class="active">Thông tin thanh toán</li>
            </ol>
        </div><!--/breadcrums-->

        <?php
            $customer_id = Session::get('customer_id');
            if ($customer_id = NULL){
        ?>
            <h2>Làm ơn đăng ký hoặc đăng nhập để thanh toán giỏ hàng va xem lại lịch sử mua hàng</h2>
        <?php
        }
        ?>

        {{-- <div class="register-req">

        </div><!--/register-req--> --}}

        <div class="shopper-informations">
            <div class="row fix-bill">
                <div class="col-sm-12 clearfix">
                    <h2>Xem lại giỏ hàng</h2>
                    <br>
                    <div class="table-responsive cart_info">
                        @if(session('msg'))
                            <div class="alert alert-success text-center" id="notification">
                                {{session('msg')}}
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger text-center" id="notification">
                                {{session('error')}}
                            </div>
                        @endif

                        <table class="table table-condensed">
                            <form action="{{ route('home.updateCartAjax') }}" method="POST">
                                @csrf
                                <thead>
                                    <tr class="cart_menu">
                                        <td class="image">Hình ảnh</td>
                                        <td class="description">Tên sản phẩm</td>
                                        <td class="price">Giá</td>
                                        <td class="quantity">Số lượng</td>
                                        <td class="total">Tổng tiền</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        // echo '<pre>';
                                        // print_r(Session::get('cart'));
                                        // echo '</pre>';
                                        $total = 0;
                                        $carts = Session::get('cart');
                                        // dd($carts);
                                    @endphp

                                    @if (Session::get('cart'))

                                        @foreach ($carts as $item)
                                            @php
                                                $subtotal =  $item['product_price']*$item['product_qty'];
                                                $total += $subtotal;
                                            @endphp

                                            <tr>
                                                <td class="cart_product">
                                                    <img src="{{ asset('uploads/'.$item['product_image']) }}" width="100px;" alt="">
                                                </td>
                                                <td class="cart_description">
                                                    <h4>{{ $item['product_title'] }}</h4>
                                                    <p>ID: {{ $item['product_id'] }}</p>
                                                </td>
                                                <td class="cart_price">
                                                    <p>{{ number_format($item['product_price']) }}  VNĐ </p>
                                                </td>
                                                <td class="cart_quantity">
                                                    <div class="cart_quantity_button">
                                                        {{-- <form action="">
                                                            @csrf --}}
                                                            <div class="quantity-controls">
                                                                <input class="cart_quantity_input" type="number" min="1" name="cart_qty[{{ $item['session_id'] }}]" value="{{ $item['product_qty'] }}" autocomplete="off" size="2">

                                                                {{-- <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm quantity-button"> --}}

                                                                <input type="hidden" value="" name="rowId_cart" class="btn btn-default btn-sm">
                                                            </div>
                                                        {{-- </form> --}}
                                                    </div>
                                                </td>
                                                <td class="cart_total">
                                                    <p class="cart_total_price">
                                                        {{ number_format($subtotal) }}
                                                    </p>
                                                </td>
                                                <td class="cart_delete">
                                                    {{-- <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này ?')" class="cart_quantity_delete" href="{{ route('home.deleteCartAjax', $item['session_id']) }}"><i class="fa fa-times"></i></a> --}}
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td>
                                                {{-- <input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn check_out">

                                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm trong giỏ hàng ?')" class="btn btn-default check_out" href="{{ route('home.deleteAllAjax') }}">Xóa tất cả</a> --}}
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>
                                                <h3>Hiện giỏ hàng không có sản phẩm</h3>
                                            </td>
                                        </tr>
                                    @endif

                                </tbody>

                            </form>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="review-payment">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="bill-to">
                            <h2>Điền thông tin gửi hàng</h2>
                            <div class="form-one">
                                <form action="{{ route('home.addCheckout') }}" method="POST">
                                    @csrf
                                    <input type="text" name="shipping_email" placeholder="Email *">
                                    <input type="text" name="shipping_name" placeholder="Họ và tên *">
                                    <input type="text" name="shipping_address" placeholder="Địa chỉ *">
                                    <input type="text" name="shipping_phone" placeholder="Phone *">
                                    <textarea name="shipping_notes" placeholder="Ghi chú thông tin đơn hàng của bạn" rows="5"></textarea>
                                    <input type="submit" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary">
                                    <br>
                                </form>

                                <br>

                                <form role="form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Chọn tỉnh thành phố</label>
                                        <select name="city" id="city" class="form-control m-bot15 choose city">
                                            <option value="0">---chọn tỉnh thành phố---</option>
                                            @foreach ($cities as $key => $item)
                                                <option value="{{ $item->matp }}"> {{ $item->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('city')
                                            <div class="invalid-feedback fix-noti">
                                                {{$message}} !
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Chọn quận huyện</label>
                                        <select name="district" id="district" class="form-control m-bot15 choose district">
                                            <option value="0">---chọn quận huyện---</option>

                                        </select>
                                        @error('district')
                                            <div class="invalid-feedback fix-noti">
                                                {{$message}} !
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Chọn xã phường</label>
                                        <select name="commune" id="commune" class="form-control m-bot15 commune">
                                            <option value="0">---chọn xã phường---</option>

                                        </select>
                                        @error('commune')
                                            <div class="invalid-feedback fix-noti">
                                                {{$message}} !
                                            </div>
                                        @enderror
                                    </div>

                                    <input type="button" value="Tính phí vận chuyển" name="send_order" class="btn btn-primary calculate_delivery">
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <h2>Thông tin hóa đơn</h2>

                        @if (Session::get('cart'))
                            <td>
                                <br>
                                <form action="{{ route('home.checkCoupon') }}" method="POST">
                                    @csrf
                                    <div class="fix-input-coupon">
                                        <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá">
                                        <input type="submit" class="btn btn-fix" name="check-coupon" value="Tính mã giảm giá">
                                    </div>
                                </form>
                            </td>
                        @endif
                        <br>

                        @if (Session::get('cart'))
                            <section id="do_action">
                                <div class="total_area">
                                    <ul>
                                        <li>Tổng tạm thời :<span>{{ number_format($total,0,',','.') }} VNĐ</span></li>

                                        @if (Session::get('coupon'))
                                            @php
                                                $latestCoupon = Session::get('coupon');
                                                // echo '<pre>';
                                                //     print_r($latestCoupon);
                                                // echo '</pre>';
                                            @endphp

                                            <li>
                                                @foreach ($latestCoupon as $key => $coupon)
                                                    @if ($coupon['coupon_condition'] == 1)
                                                        <p>Mã giảm giá : <span>{{ $coupon['coupon_code'] }}</span> </p>

                                                        <p>
                                                            @php
                                                                $totalCoupon = ($total * $coupon['coupon_value']) / 100;
                                                            @endphp
                                                        </p>

                                                        <p>Giá trị mã giảm giá : <span>{{ $coupon['coupon_value'] }} % (= {{ number_format($totalCoupon,0,',','.') }} VNĐ)</span> </p>

                                                        <p>
                                                            @php
                                                                $total_after_coupon = $total - $totalCoupon;
                                                            @endphp
                                                            {{-- Tiền sau khi áp mã : <span>{{ number_format($total - $totalCoupon,0,',','.') }} VNĐ</span> --}}
                                                        </p>
                                                    @endif

                                                    @if ($coupon['coupon_condition'] == 2)
                                                        <p>Mã giảm giá : <span>{{ $coupon['coupon_code'] }}</span>  <br></p>
                                                        <p>Giá trị mã giảm giá : <span>{{ $coupon['coupon_value'] }} VNĐ</span> </p>
                                                        <p>
                                                            @php
                                                                $totalCoupon = $total - $coupon['coupon_value'];
                                                            @endphp
                                                        </p>
                                                        {{-- <p>Tiền sau khi áp mã: <span>{{ number_format($totalCoupon,0,',','.') }} VNĐ</span> </p> --}}
                                                    @endif
                                                @endforeach
                                            </li>

                                            @if (Session::get('feeship'))
                                                <li>
                                                    <a onclick="return confirm('Bạn có chắc chắn muốn phí vận chuyển này ?')" class="cart_quantity_delete" href="{{ route('home.delFeeship') }}"><i class="fa fa-times"></i></a>

                                                    Phí vận chuyển : <span>{{ number_format(Session::get('feeship'),0,',','.') }} VNĐ</span>
                                                    @php
                                                        $total_after_feeship = $total - Session::get('feeship');
                                                    @endphp
                                                </li>
                                            @endif

                                            @php
                                                if (Session::get('feeship') && !Session::get('coupon')) {
                                                    $total_after = $total_after_feeship;
                                                }elseif(!Session::get('feeship') && Session::get('coupon')) {
                                                    $total_after = $total_after_coupon;
                                                }elseif (Session::get('feeship') && Session::get('coupon')) {
                                                    $total_after = $total_after_coupon;
                                                    $total_after = $total_after - Session::get('feeship');
                                                }elseif (!Session::get('feeship') && !Session::get('coupon')) {
                                                    $total_after = $total;
                                                }
                                            @endphp
                                            <li>Tổng thanh toán : <span>{{ number_format($total_after,0,',','.') }} VNĐ</span></li>

                                        @endif


                                        {{-- <li>Thuế :<span> VNĐ</span></li>
                                        <li>Phí vận chuyển :<span>Free</span></li>
                                        <li>Thành tiền :<span> VNĐ</span></li> --}}
                                    </ul>

                                    <a class="btn btn-default check_out" style="float: right;" href="{{ route('home.checkout') }}">Thanh Toán</a>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa mã giảm giá này ?')" style="float: right;" class="btn btn-default check_out" href="{{ route('home.deleteCoupon') }}">Xóa mã giảm giá</a>

                                </div>
                            </section><!--/#do_action-->
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</section> <!--/#cart_items-->
@endsection
