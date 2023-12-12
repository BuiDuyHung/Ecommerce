@extends('layouts.home')

@section('content')
<section id="form" style="margin-top: 0;"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng ký tài khoản</h2>
                    <br>
                    <form action="{{ route('home.addCustomer') }}" method="POST">
                        @csrf
                        <input type="text" name="customer_name" placeholder="Họ và Tên"/>
                        <input type="email" name="customer_email" placeholder="Email"/>
                        <input type="password" name="customer_password" placeholder="Mật khẩu"/>
                        <input type="text" name="customer_phone" placeholder="Phone"/>
                        <br>
                        <button type="submit" class="btn btn-default">Đăng ký</button>

                        <div style="margin-top: 25px;">
                            <span>
                                Bạn đã có tài khoản?
                                <a href="{{ route('home.login') }}"> Đăng nhập</a>
                            </span>
                        </div>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection

