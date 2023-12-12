@extends('layouts.home')

@section('content')
<section id="form" style="margin-top: 0;"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập tài khoản</h2>
                    <br>
                    <form action="{{ route('home.loginCustomer2') }}" method="POST">
                        @csrf
                        <input type="text" name="email_account" placeholder="Email" />
                        <input type="password" name="password_account" placeholder="Mật khẩu" />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Ghi nhớ đăng nhập
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>

                        <div style="margin-top: 25px;">
                            <span>
                                Bạn chưa có tài khoản?
                                <a href="{{ route('home.register') }}"> Đăng ký</a>
                            </span>
                        </div>
                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection
