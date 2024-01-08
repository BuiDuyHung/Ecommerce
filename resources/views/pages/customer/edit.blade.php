@extends('layouts.home')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật tài khoản
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tên tài khoản</label>
                            <input type="text" name="name_customer" class="form-control title" id="nameCustomer" value="{{ $customer->name }}">
                            @error('name_customer')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Ảnh đại diện</label>
                            <input type="text" name="image_customer" class="form-control title" id="imageCustomer" value="{{ $customer->image }}">
                            @error('image_customer')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email_customer" class="form-control slug" id="emailCustomer" value="{{ $customer->email }}">
                            @error('email_customer')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="text" name="phone_customer" class="form-control slug" id="phoneCustomer" value="{{ $customer->phone }}">
                            @error('phone_customer')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>

                        <button type="submit" name="add_brand_product" class="btn btn-info">Cập Nhật Tài khoản</button>
                        <a href="{{ route('home.customerShow') }}" class="btn btn-warning">Quay Lại</a>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
