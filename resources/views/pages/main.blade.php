@extends('layouts.home')

@section('slider')
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{ asset('frontend/images/home/banner2.jpg')}}" class="girl img-responsive" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{ asset('frontend/images/home/banner3.jpg')}}" class="girl img-responsive" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{ asset('frontend/images/home/banner1.jpg')}}" class="girl img-responsive" alt="" />
                                    </div>
                                </div>
                            </div>


                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider-->
@endsection

@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Sản phẩm mới nhất</h2>
        @foreach ($products as $item)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                            <form action="" method="POST">
                                <div class="productinfo text-center">
                                    <a href="{{ route('home.detailProduct', $item->id) }}">
                                        <img src="{{ asset('uploads/'.$item->image)}}" alt="" />
                                    </a>
                                    <h2> {{ number_format($item->price) }} VNĐ</h2>
                                    <p> {{ $item->title }} </p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                </div>
                            </form>

                            {{-- <div class="product-overlay">
                                <div class="overlay-content">
                                    <h2>{{ number_format($item->price) }} VNĐ</h2>
                                    <p>{{ $item->title }}</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div> --}}
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div><!--features_items-->

@endsection


