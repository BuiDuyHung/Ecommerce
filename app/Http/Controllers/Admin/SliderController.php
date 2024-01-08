<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function slider(){
        $sliders = slider::orderBy('id', 'DESC')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create(){
        return view('admin.slider.create');
    }

    public function store(SliderRequest $request){
        $slider = new slider();
        $slider->name = $request->slider_name;
        $slider->image = $request->slider_image;
        $slider->desc = $request->slider_desc;
        $slider->status = $request->slider_status;
        $slider->save();

        return redirect()->route('admin.slider')->with('msg', 'Thêm slider phẩm thành công !');
    }


    /**
     * Unactive category product.
     */
    public function hidden(string $id){
        slider::where('id', $id)->update(['status' => '0']);

        return redirect()->route('admin.slider')->with('msg', 'Ẩn thương hiệu sản phẩm thành công !');
    }

    /**
     * Active category product.
     */
    public function active(string $id){
        slider::where('id', $id)->update(['status' => '1']);

        return redirect()->route('admin.slider')->with('msg', 'Kích hoạt thương hiệu sản phẩm thành công !');
    }
}
