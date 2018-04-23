@extends('admin.layouts.app')

@section('title','Thêm mới sản phẩm')

@section('plugin_css')
        <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/dist/css/dropify.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
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
                                <label for="first_name">Tên sản phẩm</label>
                                <input type="text" class="form-control" minlength="5" name="product_name" id="product_name"
                                       value="" required>
                            </div>
                            <div class="form-group">
                                <label for="birthday">Mô tả</label>
                                <textarea class="form-control" rows="5" minlength="10" name="product_description" id="product_description" value="" required></textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="phone">Giá Nhập</label>
                                        <input type="number" class="form-control" name="base_price" id="base_price" value="" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="email">Giá bán</label>
                                        <input type="number" class="form-control" name="unit_price" id="unit_price" value="" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="phone">Số lượng</label>
                                        <input type="number" class="form-control" name="quantity" id="quantity" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="exampleSelectSuccess">Loại sản phẩm</label>
                                        <select class="form-control border-success" id="category" name="category">
                                            <option>1</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="exampleSelectSuccess">Thương hiệu</label>
                                        <select class="form-control border-success" id="brand" name="brand">
                                            <option>1</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="exampleSelectSuccess">Nhà cung cấp</label>
                                        <select class="form-control border-success" id="supplier" name="supplier">
                                            <option>1</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="photo">Hình sản phẩm</label>
                                <input type="file" class="dropify" accept="image/*" name="product_image[]" id="product_image" multiple="multiple" required/>
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
                default_pass: false,
                password: ''
            },
        });
    </script>
@endsection