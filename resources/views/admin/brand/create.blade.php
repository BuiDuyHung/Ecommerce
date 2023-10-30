@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thương hiệu sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ route('admin.storeBrand') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tên thương hiệu</label>
                            <input type="text" name="brand_product_title" class="form-control" id="brandProductTitle">
                        </div>
                        <div class="form-group">
                            <label>Mô tả thương hiệu</label>
                            <textarea style="resize: none;" rows="5" type="text" name="brand_product_desc" class="form-control" id="brandProductDesc"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Hiển thị</label>
                            <select name="brand_product_status" class="form-control m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                            </select>
                        </div>

                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm Thương Hiệu</button>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
