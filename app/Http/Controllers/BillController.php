<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Commune;
use App\Models\Feeship;

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

        $cities = City::orderby('matp', 'ASC')->get();

        return view('pages.checkout.show', compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonial','cities'));
    }

    public function addCheckout(Request $request){
        $data = [
            'name' => $request->shipping_name,
            'address' => $request->shipping_address,
            'email' => $request->shipping_email,
            'phone' => $request->shipping_phone,
            'notes' => $request->shipping_notes
        ];

        $customer_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id', $customer_id);

        return redirect()->route('home.payment');
    }

    public function payment(){
        return view('pages.checkout.payment');
    }

    // Hàm chọn tỉnh thanh phố, quận huyện, xã phường
    public function select_delivery_home(Request $request){
        $data = $request->all();
        $output = '';
        if($data['action']){
            if($data['action'] == 'city'){
                $select_district = District::where('matp', $data['id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>---chọn quận huyện---</option>';
                foreach($select_district as $key => $district){
                    $output.='<option value="'.$district->maqh.'">'.$district->name.'</option>';
                }
            }else{
                $select_commune = Commune::where('maqh', $data['id'])->orderby('xaid', 'ASC')->get();
                $output .= '<option>---chọn xã phường---</option>';
                foreach($select_commune as $key => $commune){
                    $output.='<option value="'.$commune->xaid.'">'.$commune->name.'</option>';
                }
            }
        }
        echo $output;
    }

    public function calculate_feeship(Request $request){
        $data = $request->all();
        if($data['city_id']){
            $feeship = Feeship::where('matp', $data['city_id'])->where('maqh', $data['district_id'])->where('xaid', $data['commune_id'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship > 0){
                    foreach($feeship as $key => $fee){
                        Session::put('feeship', $fee->feeship);
                        Session::save();
                    }
                }else{
                    Session::put('feeship', 20000);
                    Session::save();
                }
            }

        }
    }

    public function del_feeship(){
        Session::forget('feeship');

        return redirect()->route('home.checkout')->with('msg', 'Xóa phí vận chuyển thành công');
    }



}
