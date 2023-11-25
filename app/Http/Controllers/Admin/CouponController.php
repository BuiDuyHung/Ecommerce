<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(){
        $coupons = Coupon::all();

        return view('admin.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(CouponRequest $request)
    {
        $coupon = new Coupon();
        $coupon->name = $request->coupon_name;
        $coupon->code = $request->coupon_code;
        $coupon->quantity = $request->coupon_qty;
        $coupon->condition = $request->coupon_condition;
        $coupon->value = $request->coupon_value;
        $coupon->save();

        return redirect()->route('admin.indexCoupon')->with('msg', 'Thêm mã giảm giá thành công !');
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(CouponRequest $request, $id)
    {
        $coupon = Coupon::find($id);
        $coupon->name = $request->coupon_name;
        $coupon->code = $request->coupon_code;
        $coupon->quantity = $request->coupon_qty;
        $coupon->condition = $request->coupon_condition;
        $coupon->value = $request->coupon_value;
        $coupon->save();

        return redirect()->route('admin.indexCoupon')->with('msg', 'Cập nhật mã giảm giá thành công !');
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();

        return redirect()->route('admin.indexCoupon')->with('msg', 'Xóa mã giảm giá thành công !');
    }
}
