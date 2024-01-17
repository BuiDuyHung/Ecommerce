@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ route('admin.updateProduct', $product->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" name="product_title" class="form-control" id="productTitle" value="{{ $product->title }}">
                            @error('product_title')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" name="product_slug" class="form-control slug" id="productSlug"  value="{{ $product->slug }}">
                            @error('product_slug')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Số lượng sản phẩm</label>
                            <input type="number" name="product_quantity" class="form-control title" id="productQuantity" value="{{ $product->quantity }}">
                            @error('product_quantity')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="productImage" >
                            <img src="{{ asset('uploads/'.$product->image) }}" width="100px">
                            @error('product_image')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mô tả danh mục</label>
                            <textarea style="resize: none;" rows="3" type="text" name="product_desc" class="form-control" id="productDesc">{{ $product->desc }}</textarea>
                            @error('product_desc')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea style="resize: none;" rows="6" type="text" name="product_content" class="form-control ckeditor" id="productContent">{{ $product->content }}</textarea>
                            @error('product_content')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Giá sản phẩm</label>
                            <input type="text" name="product_price" class="form-control" id="productPrice" value="{{ $product->price }}">
                            @error('product_price')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Thương hiệu :</label>
                            <select class="form-select" name="brand_id" aria-label="Default select example">
                                <option value="0" selected>--chọn thương hiệu---</option>
                                @foreach ($brands as $item)
                                    <option value=" {{ $item->id }} " {{ $product->brand_id == $item->id ? 'selected':false}}> {{ $item->title }} </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Danh mục :</label>
                            <select class="form-select" name="category_id" aria-label="Default select example">
                                <option value="0" selected>--chọn danh mục---</option>
                                @foreach ($categories as $item)
                                    <option value=" {{ $item->id }} " {{ $product->category_id == $item->id ? 'selected':false}}> {{ $item->title }} </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Hiển thị</label>
                            <select name="product_status" class="form-control m-bot15">
                                <option value="0" {{ $product->status == '0' ? 'selected':false }}>Ẩn</option>
                                <option value="1" {{ $product->status == '1' ? 'selected':false }}>Hiện</option>
                            </select>
                            @error('product_status')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>

                        <button type="submit" name="add_category_product" class="btn btn-info">Cập Nhật Danh Mục</button>
                        <a href="{{ route('admin.indexProduct') }}" class="btn btn-warning">Quay Lại</a>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
