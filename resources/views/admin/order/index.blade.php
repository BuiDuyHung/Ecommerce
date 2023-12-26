@extends('layouts.admin')

@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách đơn đặt hàng
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
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tình trạng đơn hàng</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($orders as $key => $item)
                        <tr>
                            <td> {{ $key }} </td>
                            <td> {{ $item->code}} </td>
                            <td> {{ $item->created_at}} </td>
                            <td>
                                @if ($item->status == 1)
                                    Đơn hàng mới
                                @else
                                    Đơn hàng đã xử lý
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.viewOrder', $item->code) }}" class="active styling-edit" ui-toggle-class="">
                                    <i class="fa fa-eye text-success text-active"></i>
                                </a>
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?')" href="{{ route('admin.destroyOrder', $item->code) }}" class="active styling-edit" ui-toggle-class="">
                                    <i class="fa fa-times text-danger text"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
