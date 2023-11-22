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
                            @php

                            @endphp

                            <table class="table table-condensed">
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

                                    {{-- @php
                                        echo '<pre>';
                                        print_r(Session::get('cart'));
                                        echo '</pre>';

                                    @endphp --}}

                                    @foreach (Session::get('cart') as $item)
                                        <tr>
                                            <td class="cart_product">
                                                <a href=""><img src="" width="100px;" alt=""></a>
                                            </td>
                                            <td class="cart_description">
                                                <h4><a href="">  </a></h4>
                                                <p>ID: </p>
                                            </td>
                                            <td class="cart_price">
                                                <p>  VNĐ </p>
                                            </td>
                                            <td class="cart_quantity">
                                                <div class="cart_quantity_button">
                                                    <form action="">
                                                        @csrf
                                                        <div class="quantity-controls">
                                                            <input type="submit" value="-" name="update_qty" class="btn btn-default btn-sm quantity-button">
                                                            <input class="cart_quantity_input" type="text" name="quantity_cart" value="" autocomplete="off" size="2">
                                                            <input type="submit" value="+" name="update_qty" class="btn btn-default btn-sm quantity-button">

                                                            <input type="hidden" value="" name="rowId_cart" class="btn btn-default btn-sm">
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="cart_total">
                                                <p class="cart_total_price">

                                                </p>
                                            </td>
                                            <td class="cart_delete">
                                                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
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
                                        <li>Tổng :<span> VNĐ</span></li>
                                        <li>Thuế :<span> VNĐ</span></li>
                                        <li>Phí vận chuyển :<span>Free</span></li>
                                        <li>Thành tiền :<span> VNĐ</span></li>
                                    </ul>

                                        <a class="btn btn-default check_out" style="float: right;" href="{{ route('home.checkout') }}">Thanh Toán</a>

                                        <a class="btn btn-default check_out" style="float: right;" href="">Tính mã giảm giá</a>

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

