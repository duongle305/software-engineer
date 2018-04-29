@extends('admin.layouts.app')

@section('title','Thêm mới nhà cung cấp')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/dist/css/dropify.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Nhà cung cấp</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Thêm</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('suppliers.store') }}" method="POST">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div>
                            <div class="form-group">
                                <label for="title">Tên nhà cung cấp</label>
                                <input type="text" class="form-control" minlength="5" name="title" id="title" value="" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="text" class="form-control" name="phone" id="phone" required>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Địa chỉ</label>
                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label for="detail">Số nhà, tên đường</label>
                                        <input type="text" class="form-control form-control-sm" name="detail" id="detail">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="ward">Phường/Xã</label>
                                        <select name="ward" id="ward" class="form-control form-control-sm" :disabled="!isSelectedDistrict">
                                            <option v-for="ward in wards" :value="ward.type+' '+ward.title">@{{ ward.type }} @{{ ward.title }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="district">Quận/Huyện</label>
                                        <select name="district" id="district" class="form-control form-control-sm" :disabled="!isSelectedProvince" @change="getWards" @blur="getWards" v-model="isSelectedDistrict">
                                            <option v-for="district in districts" :value="district.type+' '+district.title" :data-id="district.id">@{{ district.type }} @{{ district.title }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="province">Tỉnh/TP</label>
                                        <select name="province" id="province" class="form-control form-control-sm" @change="getDistricts" @blur="getDistricts" v-model="isSelectedProvince">
                                            <option v-for="province in provinces" :value="province.type+' '+province.title" :data-id="province.id">@{{ province.type }} @{{ province.title }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success">Thêm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/vendor/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/inputmask/dist/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor/inputmask/dist/inputmask/bindings/inputmask.binding.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
@endsection
@section('custom_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
        });
        let app = new Vue({
            el: '#app',
            data: {
                isSelectedProvince: false,
                isSelectedDistrict: false,
                provinces:[],
                districts:[],
                wards:[]
            },
            methods:{
                getProvinces(){
                    axios.get('/admin-dl/ajax/provinces').then(rs => {
                        this.provinces = rs.data;
                    }).catch(e =>{});
                },
                getDistricts(e){
                    let selected = e.target.options[e.target.options.selectedIndex];
                    if(selected !== undefined){
                        let province_id = selected.dataset.id;
                        axios.get('/admin-dl/ajax/districts/'+province_id).then(rs => {
                            this.districts = rs.data;
                        }).catch(e =>{});
                    }
                },
                getWards(e){
                    let selected = e.target.options[e.target.options.selectedIndex];
                    if(selected !== undefined){
                        let district_id = selected.dataset.id;
                        axios.get('/admin-dl/ajax/wards/'+district_id).then(rs => {
                            this.wards = rs.data;
                        }).catch(e =>{});
                    }
                },
            },
            mounted(){
                this.getProvinces();
            }
        });
    </script>
@endsection