@extends('admin.layouts.app')

@section('title','Dashboard')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel-2/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel-2/assets/owl.theme.default.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Chi tiết sản phẩm</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 grid-margin stretch-card">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="text-left">Product name</h4><br>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <th class="text-left">Mã sản phẩm</th>
                                                        <td class="text-left">NA12C</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Mô tả</th>
                                                        <td class="text-left">Lorem ipsum dolor sit amet,
                                                            consectetur adipisicing elit.
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Giá nhập</th>
                                                        <td class="text-left">1.500.000đ</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Giá bán</th>
                                                        <td class="text-left">5.000.000đ</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Số lượng</th>
                                                        <td class="text-left">112</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Loại sản phẩm</th>
                                                        <td class="text-left">Điện thoại</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Thương hiệu</th>
                                                        <td class="text-left">Samsung</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Nhà cung cấp</th>
                                                        <td class="text-left">Digiworld</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Ngày tạo</th>
                                                        <td class="text-left">01/01/2018 12:00</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Ngày update</th>
                                                        <td class="text-left">01/01/2018 12:00</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="owl-carousel owl-theme full-width">
                                                <div class="item">
                                                    <img src="https://i.imgur.com/jp8y6Yf.jpg" alt="image"/>
                                                </div>
                                                <div class="item">
                                                    <img src="https://i.imgur.com/YkANwVo.png" alt="image"/>
                                                </div>
                                                <div class="item">
                                                    <img src="https://i.imgur.com/yoQINMn.jpg" alt="image"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section('plugin_js')
            <script src="{{ asset('assets/vendor/owl-carousel-2/owl.carousel.min.js') }}"></script>
            <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
@endsection
@section('custom_js')
@endsection