<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class BillController extends Controller
{
    public function checkout(Request $request){
        // Seo
        $meta_desc = "Chuyên cung cấp đồ điện tử công nghệ chính hãng, mang đến chải nhiệm tốt nhất đến tay người dùng";
        $meta_keywords = "E shopper, laptop, PC, Điện thoại";
        $meta_title = "E-Shopper";
        $url_canonial = $request->url();

        return view('pages.checkout.show', compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonial'));
    }

    public function addCheckout(Request $request){
        $data = array();
        $data['name'] = $request->shipping_name;
        $data['address'] = $request->shipping_address;
        $data['email'] = $request->shipping_email;
        $data['phone'] = $request->shipping_phone;
        $data['notes'] = $request->shipping_notes;

        $customer_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id', $customer_id);

        return redirect()->route('home.payment');
    }

    public function payment(){
        return view('pages.checkout.payment');
    }

}
