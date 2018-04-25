@extends('admin.layouts.app')

@section('title','Dashboard')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">

@endsection

@section('wrapper')
    <div class="row grid-margin">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Đơn hàng</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Chi tiết đơn hàng</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 grid-margin stretch-card">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="text-left">Mã đon hàng</h4><br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <th class="text-left">Trạng thái</th>
                                                        <td class="text-left"><div class="badge badge-primary">đang duyệt</div></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Ngày tạo</th>
                                                        <td class="text-left">01/01/2018 12:00
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Ngày câp nhật</th>
                                                        <td class="text-left">01/01/2018 12:00
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Người đặt hàng</th>
                                                        <td class="text-left"><a href="">NGuyễn a</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Địa chỉ giao </th>
                                                        <td class="text-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Mô tả</th>
                                                        <td class="text-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4 class="text-left">Sản phẩm</h4><br>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <th class="text-left">Samsung Galaxy S9 </th>
                                                        <td>20.000.000đ</td>
                                                        <td><div class="row">&times; 5</div></td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <button type="button" class="btn btn-warning btn-xs "><i class="ti-trash"></i></button>
                                                                <button type="button" class="btn btn-primary btn-xs "><i class="ti-pencil"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Samsung Galaxy S9 </th>
                                                        <td>20.000.000đ</td>
                                                        <td><div class="row">&times; 5</div></td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <button type="button" class="btn btn-warning btn-xs "><i class="ti-trash"></i></button>
                                                                <button type="button" class="btn btn-primary btn-xs "><i class="ti-pencil"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left"><button type="button" class="btn btn-success btn-xs "><i class="fa fa-plus-circle"></i> Thêm</button></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <br><br>
                                                <h5 class="text-left">Tổng giá : <span>100.000.000đ</span></h5>
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
@endsection
@section('custom_js')
@endsection