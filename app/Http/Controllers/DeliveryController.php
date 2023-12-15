<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Commune;

use Illuminate\Http\Request;
use App\Http\Requests\FeeshipRequest;
use App\Models\Feeship;
use PhpOption\Option;

class DeliveryController extends Controller
{
    public function delivery(Request $request){
        $cities = City::orderby('matp', 'ASC')->get();

        return view('admin.Delivery.create', compact('cities'));
    }

    // Hàm chọn tỉnh thành phố, quận huyện và xã phường
    public function selectDelivery(Request $request){
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

    // Hàm thêm dữ liệu phí vận chuyển của tỉnh thành phố, quận huyện và xã phường
    public function insertDelivery(Request $request){
        $data = $request->all();

        $feeship = new Feeship();
        $feeship->matp = $data['city_id'];
        $feeship->maqh = $data['district_id'];
        $feeship->xaid = $data['commune_id'];
        $feeship->feeship = $data['feeship'];
        $feeship->save();
    }

    // Hàm hiển thị dữ liệu phí vận chuyển của tỉnh thành phố, quận huyện và xã phường
    public function loadFeeship(){
        $feeships = Feeship::orderBy('id', 'DESC')->get();

        $output = '';
        $output .= "
            <div class='table-responsive'>
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Tên tỉnh thành phố</th>
                            <th>Tên quận huyện</th>
                            <th>Tên phường xã</th>
                            <th>Phí vận chuyển (VNĐ)</th>
                        </tr>
                    </thead>
                    <tbody>";

        foreach ($feeships as $key => $item) {
            $cityName = $item->city ? htmlspecialchars($item->city->name) : 'N/A';
            $districtName = $item->district ? htmlspecialchars($item->district->name) : 'N/A';
            $communeName = $item->commune ? htmlspecialchars($item->commune->name) : 'N/A';

            $output .= "<tr>
                <td>$cityName</td>
                <td>$districtName</td>
                <td>$communeName</td>
                <td contenteditable='true' data-feeship_id='" . $item->id . "' class='feeship_edit'>" . number_format($item->feeship,0,',','.') . "</td>
            </tr>";
        }

        $output .= "
                    </tbody>
                </table>
            </div>
        ";

        echo $output;
    }

    // Hàm cập nhật lại phí vận chuyển của tỉnh thành phố, quận huyện và xã phường
    public function updateFeeship(Request $request){
        $data = $request->all();
        $fee = rtrim($data['feeship_value'],'.');

        $feeship = Feeship::find($data['feeship_id']);
        $feeship->feeship = $fee;
        $feeship->save();
    }
}
