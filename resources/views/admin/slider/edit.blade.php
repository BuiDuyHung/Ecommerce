@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa thương slider
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ route('admin.updateSlider', $slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tên slider</label>
                            <input type="text" name="slider_name" class="form-control title" id="sliderName" value="{{old('slider_name') ?? $slider->name }}">
                            @error('slider_name')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" name="slider_image" class="form-control slug" id="sliderImage" value="{{old('slider_image') ?? $slider->image }}">
                            @error('slider_image')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mô tả thương hiệu</label>
                            <textarea style="resize: none;" rows="5" type="text" name="slider_desc" class="form-control" id="sliderDesc">{{old('slider_desc') ?? $slider->desc }}</textarea>
                            @error('slider_desc')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Hiển thị</label>
                            <select name="slider_status" class="form-control m-bot15">
                                <option value="0" >--- chọn ---</option>
                                <option value="1" {{ $slider->status == '1' ? 'selected':false }}>Ẩn</option>
                                <option value="2" {{ $slider->status == '2' ? 'selected':false }}>Hiện</option>
                            </select>
                            @error('slider_status')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>

                        <button type="submit" name="add_slider" class="btn btn-info">Cập nhật slider</button>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
