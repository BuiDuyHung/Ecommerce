<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function login_checkout(){
         // lấy tất cả các thể loại sản phẩm
         $categories = Category::where('status', '1')->get();
         // lấy tất cả các thương hiệu sản phẩm
         $brands = Brand::where('status', '1')->get();

        return view('pages.checkout.loginCheckout', compact('categories', 'brands'));
    }

    // Thêm tài khoản người dùng
    public function addCustomer(Request $request){
        $data = array();
        $data['name'] = $request->customer_name;
        $data['email'] = $request->customer_email;
        $data['password'] = $request->customer_password;
        $data['phone'] = $request->customer_phone;

        $customer_id = DB::table('tbl_customers')->insertGetId($data);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);

        return redirect()->route('home.checkout');

    }
}
