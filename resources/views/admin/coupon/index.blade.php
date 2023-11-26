@extends('layouts.admin')

@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Quản lý mã giảm giá
        </div>
        @if(session('msg'))
            <div class="alert alert-success text-center" id="notification">
                {{session('msg')}}
            </div>
        @endif
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                    <th style="width:20px;">
                        <label class="i-checks m-b-none">
                        <input type="checkbox"><i></i>
                        </label>
                    </th>
                    <th>Tên mã giảm giá</th>
                    <th>Mã giảm giá</th>
                    <th>Số lượng</th>
                    <th>Tính năng</th>
                    <th>Giá trị giảm giá</th>
                    <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $item)
                        <tr>
                            <td>
                                <label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                            </td>
                            <td> {{ $item->name }} </td>
                            <td> {{ $item->code }} </td>
                            <td> {{ $item->quantity }} </td>
                            <td>
                                <span class="text-ellipsis">
                                    @if ($item->condition == 1)
                                        <span class="">Giảm theo %</span>
                                    @else
                                        <span class="">Giảm theo tiền</span>
                                    @endif
                                </span>
                            </td>
                            <td>
                                @if ($item->condition == 1)
                                    <span class="">Giảm {{ $item->value }} %</span>
                                @else
                                    <span class="">Giảm {{ number_format($item->value) }} VNĐ</span>
                                @endif

                            </td>
                            <td>
                                <a href="{{ route('admin.editCoupon', $item->id) }}" class="active styling-edit" ui-toggle-class="">
                                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa mã giảm giá này?')" href="{{ route('admin.destroyCoupon', $item->id) }}" class="active styling-edit" ui-toggle-class="">
                                    <i class="fa fa-times text-danger text"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                    <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                    <li><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li><a href="">4</a></li>
                    <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
      </footer>
    </div>
</div>
@endsection

