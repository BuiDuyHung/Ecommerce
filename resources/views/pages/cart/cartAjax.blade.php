@extends('layouts.home')

@section('sidebar')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Danh mục sản phẩm</h2>

                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        @foreach ($categories as $item)
                            {{-- <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{ route('home.showCategory', $item->id) }}"> {{ $item->title }} </a></h4>
                                </div>
                            </div> --}}
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="{{ route('home.showCategory', $item->id) }}"> <span class="pull-right"></span> {{ $item->title }} </a></li>
                                </ul>
                            </div>
                        @endforeach
                    </div><!--/category-products-->

                    <div class="brands_products"><!--brands_products-->
                        <h2>Thương hiệu sản phẩm</h2>

                        @foreach ($brands as $item)
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="{{ route('home.showBrand', $item->id) }}"> <span class="pull-right"></span> {{ $item->title }} </a></li>
                                </ul>
                            </div>
                        @endforeach

                    </div><!--/brands_products-->

                    <div class="shipping text-center"><!--shipping-->
                        <img src="{{ asset('frontend/images/home/shipping.jpg')}}" alt="" />
                    </div><!--/shipping-->
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <section id="cart_items">
                    <div class="container">
                        <div class="breadcrumbs">
                            <ol class="breadcrumb">
                              <li><a href="{{ route('home.index') }}">Trang chủ</a></li>
                              <li class="active">Giỏ hàng</li>
                            </ol>
                        </div>
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
                                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này ?')" class="cart_quantity_delete" href="{{ route('home.deleteCartAjax', $item['session_id']) }}"><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <td>
                                                    <input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn check_out">
                                                    {{-- <a onclick="return confirm('Bạn có chắc chắn muốn xóa mã giảm giá này ?')" class="btn btn-default check_out" href="{{ route('home.deleteCoupon') }}">Xóa mã giảm giá</a> --}}
                                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm trong giỏ hàng ?')" class="btn btn-default check_out" href="{{ route('home.deleteAllAjax') }}">Xóa tất cả</a>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    @if (Session::get('customer_id') != NULL)
                                                        <a class="btn btn-default check_out" style="float: right" href="{{ route('home.checkout') }}">Đặt hàng</a>
                                                    @else
                                                        <a class="btn btn-default check_out" href="{{ route('home.login') }}">Bạn cần đăng nhập để đặt hàng</a>
                                                    @endif
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

                                {{-- @if (Session::get('cart'))
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
                                @endif --}}

                            </table>
                        </div>
                    </div>
                </section> <!--/#cart_items-->

            </div>
        </div>
    </div>
</section>
@endsection

