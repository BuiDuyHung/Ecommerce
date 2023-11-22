<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO --}}
    <meta name="description" content="{{ $meta_desc }}">
    <meta name="keyword" content="{{ $meta_keywords }}">
    <meta name="robots" content="INDEX,FOLLOW">
    <meta name="author" content="">

    <link rel="canonical" href=" {{ $url_canonial }} ">
    <link rel="icon" type="image/x-icon" href="">
    {{-- End SEO --}}

    {{-- chia sẻ facebook --}}
    {{-- <meta property="og:image" content="">
    <meta property="og:site_name" content="http://127.0.0.1:8000/">
    <meta property="og:description" content="{{ $meta_desc }}">
    <meta property="og:title" content="{{ $meta_title }}">
    <meta property="og:url" content="{{ $url_canonial }}">
    <meta property="og:type" content="website"> --}}

    <title> {{ $meta_title }} </title>

    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{ asset('frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{ asset('frontend/css/responsive.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">

    {{-- sweetalert 1 --}}
    <link href="{{ asset('frontend/css/sweetalert.css') }}" rel="stylesheet">

</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header-middle fix-header1"><!--header-middle-->
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-3">
						<div class="logo pull-left">
							<a href="{{ route('home.index') }}"><img src="{{ asset('frontend/images/home/logo.png')}}" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-9">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								{{-- <li><a href="{{ route('home.loginCheckout') }}"><i class="fa fa-user"></i> Tài khoản </a></li> --}}
                                <li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>

                                <?php
                                    $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if ($customer_id != NULL && $shipping_id != NULL){
                                ?>
                                    <li><a href="{{ route('home.payment') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                    }else {
                                ?>
                                    <li><a href="{{ route('home.loginCheckout') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                    }
                                ?>


								<li><a href="{{ route('home.showCartAjax') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng </a></li>

                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if ($customer_id != NULL){
                                ?>
                                    <li><a href="{{ route('home.logoutCheckout') }}"><i class="fa fa-lock"></i> Đăng xuất </a></li>
                                <?php
                                    }else {
                                ?>
                                    <li><a href="{{ route('home.loginCheckout') }}"><i class="fa fa-lock"></i> Đăng nhập </a></li>
                                <?php
                                    }
                                ?>

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ route('home.index') }}" class="active">Trang chủ</a></li>
								<li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Apple</a></li>
                                    </ul>
                                </li>
								<li class="dropdown"><a href="#">Tin tức</a></li>
								<li><a href="{{ route('home.showCart') }}">Giỏ hàng</a></li>
								<li><a href="contact-us.html">Liên hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
                        <form action="{{ route('home.search') }}" method="POST">
                            @csrf
                            <div class="search_box pull-right">
                                <input type="text" name="keywords" value="{{ old('keywords') }}" placeholder=""/>
                                <button type="submit" class="btn btn-fix">Tìm kiếm</button>
                            </div>
                        </form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
