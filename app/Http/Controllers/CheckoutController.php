<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


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
        $data['password'] = md5($request->customer_password);
        $data['phone'] = $request->customer_phone;

        $customer_id = DB::table('tbl_customers')->insertGetId($data);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);

        return redirect()->route('home.saveCart');

    }

    public function payment(){

    }

    // Đăng xuất người dùng
    public function logout_checkout(){
        Session::flush();

        return redirect()->route('home.loginCheckout');
    }

    // Đăng nhập người dùng
    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);

        $customer = DB::table('tbl_customers')->where('email', $email)->where('password', $password)->first();
        if($customer){
            Session::put('customer_id', $customer->id);
            return redirect()->route('home.checkout');
        }else{
            return redirect()->route('home.loginCustomer');
        }

    }
}
