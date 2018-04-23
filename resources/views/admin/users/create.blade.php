@extends('admin.layouts.app')

@section('title','Thêm mới nhân viên')

@section('plugin_css')
<link rel="stylesheet" href="{{ asset('assets/vendor/dropify/dist/css/dropify.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Library</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            {{ csrf_field() }}
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="first_name">Họ</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="last_name">Tên</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="birthday">Ngày sinh</label>
                                    <input class="form-control" data-inputmask="'alias': 'date','alias': 'dd-mm-yyyy'" name="birthday" id="birthday" value="{{ old('birthday') }}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="sex">Giới tính</label>
                                    <select name="sex" id="sex" class="form-control">
                                        <option value="MALE" {{ (old('sex') =='MALE')?'selected':''  }}>Nam</option>
                                        <option value="FEMALE" {{ (old('sex') =='FEMALE')?'selected':''  }}>Nữ</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" data-inputmask="'alias': 'email'" name="email" id="email" value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="detail">Số nhà</label>
                                    <input type="text" class="form-control" name="detail" id="detail">
                                </div>
                                <div class="col-sm-3">
                                    <label for="province">Tỉnh/TP</label>
                                    <select name="province" id="province" class="form-control" v-model="province" @change="getDistricts()">
                                        <option v-for="province in provinces" :value="province.title">@{{ province.title }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="district">Quận/Huyện</label>
                                    <select name="district" id="district" class="form-control" :disabled="!province" v-model="district">
                                        <option v-for="district in districts" value="@{{ district.title  }}">@{{ district.title }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="ward">Phường/Xã</label>
                                    <select name="ward" id="ward" class="form-control" :disabled="!district">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" id="password" :disabled="default_pass">
                            <div class="form-check form-check-flat">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" v-model="default_pass">
                                    Lấy mật khẩu mặt định "password"
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="photo">Hình</label>
                            <input type="file" class="dropify" name="photo" id="photo" />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/vendor/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/inputmask/dist/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor/inputmask/dist/inputmask/bindings/inputmask.binding.js') }}"></script>
@endsection
@section('custom_js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.dropify').dropify();
        });
        let app = new Vue({
            el: '#app',
            data:{
                default_pass: false,
                password: '',
                province: false,
                district: false,
                districts: [],
                provinces: []
            },
            methods:{
                getDistricts(){
                    axios.get('/admin-dl/ajax/districts/'+this.province).then(rs => {
                        this.districts = rs.data;
                        console.log(rs);
                    });
                }
            }
        });
    </script>
@endsection