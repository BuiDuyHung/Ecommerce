@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm vận chuyển
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form">
                        @csrf
                        <div class="form-group">
                            <label for="">Chọn tỉnh thành phố</label>
                            <select name="city" id="city" class="form-control m-bot15 choose city">
                                <option value="0">---chọn tỉnh thành phố---</option>
                                @foreach ($cities as $key => $item)
                                    <option value="{{ $item->matp }}"> {{ $item->name }} </option>
                                @endforeach
                            </select>
                            @error('city')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Chọn quận huyện</label>
                            <select name="district" id="district" class="form-control m-bot15 choose district">
                                <option value="0">---chọn quận huyện</option>

                            </select>
                            @error('district')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Chọn xã phường</label>
                            <select name="commune" id="commune" class="form-control m-bot15 commune">
                                <option value="0">---chọn xã phường</option>

                            </select>
                            @error('commune')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Phí vận chuyển</label>
                            <input type="text" name="feeship" class="form-control title feeship" id="brandProductTitle">
                            @error('feeship')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>

                        <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm Vận Chuyển</button>
                    </form>
                </div>

                {{-- Load delivery --}}
                <div id="load_delivery">

                </div>


            </div>
        </section>
    </div>
</div>
@endsection

