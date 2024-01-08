@extends('layouts.home')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label >Ảnh đại diện</label>
                        <img src="" alt="anh_dai_dien" class="img-thumbnail">
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="form-group">
                        <label >Tên khách hàng</label>
                        <input type="name_customer" class="form-control" id="nameCustomer" value="{{ $customer->name }}">
                    </div>
                    <div class="form-group">
                        <label >Email</label>
                        <input type="email_customer" class="form-control" id="emailCustomer" value="{{ $customer->email }}">
                    </div>
                    <div class="form-group">
                        <label >Số điện thoại</label>
                        <input type="phone_customer" class="form-control" id="phoneCustomer" value="{{ $customer->phone }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
