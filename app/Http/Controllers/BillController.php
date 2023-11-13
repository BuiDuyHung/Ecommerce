<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class BillController extends Controller
{
    public function checkout(){
        return view('pages.checkout.show');
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
