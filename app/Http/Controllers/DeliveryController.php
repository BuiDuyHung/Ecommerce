<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Commune;

use Illuminate\Http\Request;
use App\Http\Requests\FeeshipRequest;
use App\Models\Feeship;

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

    public function insertDelivery(Request $request){
        $data = $request->all();

        $feeship = new Feeship();
        $feeship->matp = $data['city_id'];
        $feeship->maqh = $data['district_id'];
        $feeship->xaid = $data['commune_id'];
        $feeship->feeship = $data['feeship'];
        $feeship->save();
    }

    public function loadFeeship(){
        $feeships = Feeship::orderby('id', 'DESC')->get();

        $output = '';
        $output .= "
            <div class='table-responsive'>
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Tên tỉnh thành phố</th>
                            <th>Tên quận huyện</th>
                            <th>Tên phường xã</th>
                            <th>Phí vận chuyển</th>
                        </tr>
                    </thead>
                    <tbody>";
                    foreach($feeships as $key => $item){
                        $output .= "<tr>
                            <td>".$item->city['name']."</td>
                            <td>".$item->district['name']."</td>
                            <td>".$item->commune['name']."</td>
                            <td contentedittable data-feeship_id='".$item->id."'>".number_format($item->feeship)."</td>
                        </tr>";

                        // dd($item->city['name']);
                    }

                    $output .= "
                    </tbody>
                </table>
            </div>
        ";

        echo $output;
    }
}
