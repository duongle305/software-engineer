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
                                    <input type="text" class="form-control" name="first_name" id="first_name">
                                </div>
                                <div class="col-sm-6">
                                    <label for="last_name">Tên</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="birthday">Ngày sinh</label>
                                    <input class="form-control" data-inputmask="'alias': 'date','alias': 'dd-mm-yyyy'" name="birthday" id="birthday">
                                </div>
                                <div class="col-sm-6">
                                    <label for="sex">Giới tính</label>
                                    <select name="sex" id="sex" class="form-control">
                                        <option value="MALE">Nam</option>
                                        <option value="FEMALE">Nữ</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone" id="phone">
                                </div>
                                <div class="col-sm-6">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" data-inputmask="'alias': 'email'" name="email" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" id="password" v-show="!default_pass" :value="password">
                            <div class="form-check form-check-flat">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" @click="check()" v-model="default_pass">
                                    Lấy mật khẩu mặt định "password"
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="photo">Hình</label>
                            <input type="file" class="dropify" />
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
        (function($) {
            'use strict';
            $('.dropify').dropify();
        })(jQuery);
        let app = new Vue({
            el: '#app',
            data:{
                default_pass: false,
                password: ''
            },
            methods:{
                check(){
                    this.password = (!this.default_pass)?'password':'';
                }
            }
        });
    </script>
@endsection