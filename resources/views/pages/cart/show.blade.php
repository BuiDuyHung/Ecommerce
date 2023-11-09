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
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{ route('home.showCategory', $item->id) }}"> {{ $item->title }} </a></h4>
                                </div>
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
                                                            <input type="submit" value="-" name="update_qty" class="btn btn-default btn-sm quantity-button">
                                                            <input class="cart_quantity_input" type="text" name="quantity_cart" value="{{ $item->qty }}" autocomplete="off" size="2">
                                                            <input type="submit" value="+" name="update_qty" class="btn btn-default btn-sm quantity-button">

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
                                                <a class="cart_quantity_delete" href="{{ route('home.deleteCart', $item->rowId) }}"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section> <!--/#cart_items-->

                <section id="do_action">
                    <div class="container">
                        <div class="heading">
                            <h2>Hóa đơn thanh toán :</h2>

                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="total_area">
                                    <ul>
                                        <li>Tổng :<span>{{ number_format(Cart::subtotal()) }} VNĐ</span></li>
                                        <li>Thuế :<span>{{ number_format(Cart::tax()) }} VNĐ</span></li>
                                        <li>Phí vận chuyển :<span>Free</span></li>
                                        <li>Thành tiền :<span>{{ number_format(Cart::total()) }} VNĐ</span></li>
                                    </ul>

                                    <a class="btn btn-default check_out" style="float: right;" href="{{ route('home.checkout') }}">Thanh Toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!--/#do_action-->
            </div>
        </div>
    </div>
</section>
@endsection

