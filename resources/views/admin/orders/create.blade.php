@extends('admin.layouts.app')

@section('title','Thêm mới khách hàng')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/dist/css/dropify.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Đơn hàng</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Thêm</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="address">Địa chỉ</label>
                                        <input type="text" class="form-control" name="address" id="address" value=""
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <div class="row">
                                    <div class="col-xs-12 col-md-3">
                                        <label for="provinces">Tỉnh/TP</label>
                                        <select class="form-control form-control-sm" id="provinces" name="provinces">
                                            <option>1</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <label for="districts">Quận/Huyện</label>
                                        <select class="form-control form-control-sm" id="districts" name="districts">
                                            <option>1</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <label for="wards">Phường/Xã</label>
                                        <select class="form-control form-control-sm" id="wards" name="wards">
                                            <option>1</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <label for="street">Tên đường, số nhà</label>
                                        <input type="text" class="form-control" name="street" id="street"
                                               value="" required>
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
@endsection
@section('custom_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
        });
        let app = new Vue({
            el: '#app',
            data: {
                default_pass: false,
                password: ''
            },
        });
    </script>
@endsection