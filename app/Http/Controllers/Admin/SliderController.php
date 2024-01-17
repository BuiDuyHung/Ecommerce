<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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
        $slider->desc = $request->slider_desc;
        $slider->status = $request->slider_status;

        if($request->slider_image){
            $image = $request->slider_image;
            $ext = $image->getClientOriginalExtension();
            $name = time().'_'.$image->getClientOriginalName();
            Storage::disk('public')->put($name, File::get($image));
            $slider->image = $name;
        }
        $slider->save();

        return redirect()->route('admin.slider')->with('msg', 'Thêm slider phẩm thành công !');
    }

    public function edit($id){
        $slider =  slider::find($id);

        return view('admin.slider.edit', compact('slider'));
    }

    public function update(SliderRequest $request, $id){
        $slider = slider::find($id);
        $slider->name = $request->slider_name;
        $slider->desc = $request->slider_desc;
        $slider->status = $request->slider_status;

        if ($request->hasFile('slider_image')) {
            $image = $request->file('slider_image');
            $name = time() . '_' . $image->getClientOriginalName();
            Storage::disk('public')->put($name, File::get($image));
            $slider->image = $name;
        } else {
            $name = $slider->image;
        }
        $slider->save();

        return redirect()->route('admin.slider')->with('msg', 'Cập nhật thông tin slider thành công !');
    }


    public function destroy($id)
    {
        $slider = slider::find($id);
        if ($slider->image) {
            unlink('uploads/'.$slider->image);
        }
        $slider->delete();

        return redirect()->route('admin.slider')->with('msg', 'Xóa slider thành công !');
    }



    /**
     * Unactive category product.
     */
    public function hidden(string $id){
        slider::where('id', $id)->update(['status' => '0']);

        return redirect()->route('admin.slider')->with('msg', 'Ẩn slider thành công !');
    }

    /**
     * Active category product.
     */
    public function active(string $id){
        slider::where('id', $id)->update(['status' => '1']);

        return redirect()->route('admin.slider')->with('msg', 'Kích hoạt slider thành công !');
    }
}
