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
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">{{ $category_by_id->title }}</h2>

                    {{-- <div class="fb-share-button" data-href="http://127.0.0.1:8000/" data-layout="" data-size=""><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonial }}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div> --}}
                    <div class="fb-like" data-href="http://127.0.0.1:8000/" data-width="" data-layout="" data-action="" data-size="" data-share="true"></div>

                    @foreach ($product_by_category as $item)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <form action="{{ route('home.showCart') }}" method="POST">
                                        @csrf
                                        <div class="productinfo text-center">
                                            <a href="{{ route('home.detailProduct', $item->id) }}">
                                                <img src="{{ asset('uploads/'.$item->image)}}" alt="" />
                                            </a>
                                            <h2> {{ number_format($item->price) }} VNĐ</h2>
                                            <p> {{ $item->title }} </p>
                                            <input name="quantity" type="hidden" min="1" value="1" />
                                            {{-- <input name="productId_hidden" type="hidden" value="{{ $item->id }}" /> --}}
                                            <input type="hidden" value="{{ $item->id }}" class="product_id_{{ $item->id }}">
                                            <input type="hidden" value="{{ $item->title }}" class="product_title_{{ $item->id }}">
                                            <input type="hidden" value="{{ $item->image }}" class="product_image_{{ $item->id }}">
                                            <input type="hidden" value="{{ $item->price }}" class="product_price_{{ $item->id }}">
                                            <input type="hidden" value="1" class="product_qty_{{ $item->id }}">

                                            <button type="button" data-id_product="{{ $item->id }}" class="btn btn-default add-to-cart">
                                                <i class="fa fa-shopping-cart"></i>Thêm giỏ hàng
                                            </button>
                                        </div>
                                    </form>
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
            </div>
        </div>
    </div>
</section>

@endsection

