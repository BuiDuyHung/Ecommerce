@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm mã giảm giá
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ route('admin.storeCoupon') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tên mã giảm giá</label>
                            <input type="text" name="coupon_name" class="form-control" id="couponName">
                            @error('coupon_name')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mã giảm giá</label>
                            <input type="text" name="coupon_code" class="form-control" id="couponeCode">
                            @error('coupon_code')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Số lượng mã</label>
                            <input type="text" name="coupon_qty" class="form-control slug" id="couponQty">
                            @error('coupon_qty')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tính năng mã giảm giá</label>
                            <select name="coupon_condition" class="form-control m-bot15">
                                <option value="0">---Chọn---</option>
                                <option value="1">Giảm theo %</option>
                                <option value="2">Giảm theo tiền</option>
                            </select>
                            @error('coupon_condition')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nhập số % hoặc tiền giảm</label>
                            <input type="text" name="coupon_value" class="form-control slug" id="couponeCode">
                            @error('coupon_value')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>

                        <button type="submit" name="add_coupon" class="btn btn-info">Thêm Mã Giảm giá</button>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
