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
                @foreach ($detail_product as $item)
                <div class="product-details"><!--product-details-->

                    <div class="col-sm-6">
                        <div class="view-product">
                            <img src="{{ asset('uploads/'.$item->image) }}" alt="" />
                            <h3>ZOOM</h3>
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                    <a href=""><img src="{{ asset('frontend/images/product-details/similar1.jpg') }}" alt=""></a>
                                    <a href=""><img src="{{ asset('frontend/images/product-details/similar2.jpg') }}" alt=""></a>
                                    <a href=""><img src="{{ asset('frontend/images/product-details/similar3.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="item">
                                    <a href=""><img src="{{ asset('frontend/images/product-details/similar1.jpg') }}" alt=""></a>
                                    <a href=""><img src="{{ asset('frontend/images/product-details/similar2.jpg') }}" alt=""></a>
                                    <a href=""><img src="{{ asset('frontend/images/product-details/similar3.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="item">
                                    <a href=""><img src="{{ asset('frontend/images/product-details/similar1.jpg') }}" alt=""></a>
                                    <a href=""><img src="{{ asset('frontend/images/product-details/similar2.jpg') }}" alt=""></a>
                                    <a href=""><img src="{{ asset('frontend/images/product-details/similar3.jpg') }}" alt=""></a>
                                    </div>

                                </div>

                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="product-information"><!--/product-information-->
                            <img src="{{ asset('frontend/images/product-details/new.jpg') }}" class="newarrival" alt="" />
                            <h1> {{ $item->title }} </h1>
                            <p>ID: {{ $item->id }} </p>
                            <img src="{{ asset('frontend/images/product-details/rating.png') }}" alt="" />
                            <h1>{{ number_format($item->price) }} VNĐ</h1>
                            {{-- Gửi thông tin số lượng sản phẩm đến giỏ hàng --}}
                            <form action="" method="POST">
                                @csrf
                                <span>
                                    <label>Quantity:</label>
                                    <input name="quantity" type="number" min="1" value="1" />
                                    <input name="product_id" type="hidden" value="{{ $item->id }}" />
                                    <button type="submit" class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Thêm giỏ hàng
                                    </button>
                                </span>
                            </form>

                            <p><b>Tình trạng:</b> còn hàng</p>
                            <p><b>Điều kiện:</b> Mới 100%</p>
                            <p><b>Thương hiệu:</b> {{ $item->brand->title }}</p>

                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
                            <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
                            <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="details" >
                            <div class="col-sm-12">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <p>
                                            {{ $item->desc }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="companyprofile" >
                            <div class="col-sm-12">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <p>
                                            {{ $item->content }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="reviews" >
                            <div class="col-sm-12">
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                <p><b>Write Your Review</b></p>

                                <form action="#">
                                    <span>
                                        <input type="text" placeholder="Your Name"/>
                                        <input type="email" placeholder="Email Address"/>
                                    </span>
                                    <textarea name="" ></textarea>
                                    <b>Rating: </b> <img src="{{ asset('frontend/images/product-details/rating.png') }}" alt="" />
                                    <button type="button" class="btn btn-default pull-right">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div><!--/category-tab-->
                @endforeach

                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">Sản phẩm liên quan</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @php
                                $related_product_array = $related_product->toArray();
                                $chunks = array_chunk($related_product_array, 3);
                            @endphp

                            @foreach ($chunks as $key => $chunk)
                                <div class="item{{ $key === 0 ? ' active' : '' }}">
                                    <div class="row">
                                        @foreach ($chunk as $item)
                                            <div class="col-sm-4">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo text-center">
                                                            <a href="{{ route('home.detailProduct', ['id' => $item['id']]) }}">
                                                                <img src="{{ asset('uploads/'.$item['image']) }}" alt="" />
                                                            </a>
                                                            <h2>{{ number_format($item['price']) }} VNĐ</h2>
                                                            <p>{{ $item['title'] }}</p>
                                                            <button type="button" class="btn btn-default add-to-cart">
                                                                <i class="fa fa-shopping-cart"></i> Thêm giỏ hàng
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div><!--/recommended_items-->
            </div>
        </div>
    </div>
</section>
@endsection

