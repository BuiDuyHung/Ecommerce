@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ route('admin.storeCategory') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tên danh mục sản phẩm</label>
                            <input type="text" name="category_product_title" class="form-control" id="categoryProductTitle">
                            @error('category_product_title')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Từ khóa danh mục</label>
                            <textarea style="resize: none;" rows="2" type="text" name="category_product_keywords" class="form-control" id="categoryDescription"></textarea>
                            @error('category_product_keywords')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mô tả danh mục</label>
                            <textarea style="resize: none;" rows="5" type="text" name="category_product_desc" class="form-control" id="categoryDescription"></textarea>
                            @error('category_product_desc')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Hiển thị</label>
                            <select name="category_product_status" class="form-control m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                            </select>
                            @error('category_product_status')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>

                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm Danh Mục</button>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
