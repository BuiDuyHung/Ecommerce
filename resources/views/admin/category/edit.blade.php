@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa danh mục sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ route('admin.updateCategory', $category->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" name="category_product_title" class="form-control title" id="categoryProduct" value="{{ $category->title }}">
                            @error('category_product_title')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" name="category_product_slug" class="form-control slug" id="categoryProductSlug" value="{{ $category->slug }}>
                            @error('category_product_slug')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Từ khóa danh mục</label>
                            <textarea style="resize: none;" rows="2" type="text" name="category_product_keywords" class="form-control" id="categoryDescription">{{ $category->keywords }}</textarea>
                            @error('category_product_keywords')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mô tả danh mục</label>
                            <textarea style="resize: none;" rows="5" type="text" name="category_product_desc" class="form-control" id="categoryDescription">{{ $category->desc }}</textarea>
                            @error('category_product_desc')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>

                        <button type="submit" name="add_category_product" class="btn btn-info">Cập Nhật Danh Mục</button>
                        <a href="{{ route('admin.indexCategory') }}" class="btn btn-warning">Quay Lại</a>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
