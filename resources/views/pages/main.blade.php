@extends('layouts.home')

@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm mới nhất</h2>
    @foreach ($products as $item)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center">
                            <a href="{{ route('home.detailProduct') }}">
                                <img src="{{ asset('uploads/'.$item->image)}}" alt="" />
                            </a>
                            <h2> {{ number_format($item->price) }} VNĐ</h2>
                            <p> {{ $item->title }} </p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                        </div>
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

