@extends('admin.layouts.app')

@section('title',$supplier->title.' - Cập nhật')

@section('plugin_css')
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Nhà cung cấp</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Cập nhật: {{ $supplier->title }}</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('suppliers.update',$supplier->id) }}" method="POST">
                            <div class="form-group">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="oldChange" @if(old('change_address')) value="1" @else value="0" @endif >
                            </div>
                            <div class="form-group">
                                <label for="title">Tên nhà cung cấp</label>
                                <input type="text" class="form-control" minlength="5" name="title" id="title" value="{{ $supplier->title }}">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="text" class="form-control" name="phone" id="phone" value="{{ $supplier->phone }}">
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{ $supplier->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" v-model="isChangeAddress" @change="reset" name="change_address">
                                        Cập nhật địa chỉ
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" value="{{ $supplier->address }}" disabled v-if="!isChangeAddress">

                                <div class="row mt-3" v-if="isChangeAddress">
                                    <div class="col-md-3 form-group">
                                        <label for="detail">Số nhà, tên đường</label>
                                        <input type="text" class="form-control form-control-sm" name="detail" id="detail" v-model="detail">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="ward">Phường/Xã</label>
                                        <select name="ward" id="ward" class="form-control form-control-sm" :disabled="!isSelectedDistrict">
                                            <option v-for="ward in wards" :value="ward.type+' '+ward.title">@{{ ward.type }} @{{ ward.title }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="district">Quận/Huyện</label>
                                        <select name="district" id="district" class="form-control form-control-sm" :disabled="!isSelectedProvince" @change="getWards" @blur="getWards" v-model="isSelectedDistrict">
                                            <option v-for="district in districts" :value="district.type+' '+district.title" :data-id="district.id">@{{ district.type }} @{{ district.title }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="province">Tỉnh/TP</label>
                                        <select name="province" id="province" class="form-control form-control-sm" @change="getDistricts" @blur="getDistricts" v-model="isSelectedProvince">
                                            <option v-for="province in provinces" :value="province.type+' '+province.title" :data-id="province.id">@{{ province.type }} @{{ province.title }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
@endsection
@section('custom_js')
    <script src="{{ asset('js/edit-suppliers.js') }}"></script>
@endsection