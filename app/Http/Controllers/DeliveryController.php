<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Commune;

use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function delivery(Request $request){
        $cities = City::orderby('matp', 'ASC')->get();

        return view('admin.Delivery.create', compact('cities'));
    }

    public function selectDelivery(Request $request){
        $data = $request->all();
        $output = '';
        if($data['action']){
            if($data['action'] == 'city'){
                $select_district = District::where('matp', $data['id'])->orderby('maqh', 'ASC')->get();
                foreach($select_district as $key => $district){
                    $output.='<option value="'.$district->maqh.'">'.$district->name.'</option>';
                }
            }else{
                $select_commune = Commune::where('maqh', $data['id'])->orderby('xaid', 'ASC')->get();
                foreach($select_commune as $key => $commune){
                    $output.='<option value="'.$commune->maqh.'">'.$commune->name.'</option>';
                }
            }
        }

        echo $output;
    }
}
