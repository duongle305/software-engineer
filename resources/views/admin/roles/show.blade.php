@extends('admin.layouts.app')

@section('title','Dashboard')

@section('plugin_css')
@endsection

@section('wrapper')
    <div class="row grid-margin">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Quản lý role</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Thông tin role</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 grid-margin stretch-card">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="text-left">Role name</h4><br><br>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th class="text-left">Tên hiển thị</th>
                                                <td class="text-left">Administrator</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Tên</th>
                                                <td class="text-left">administrator</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Mô tả</th>
                                                <td class="text-left">Lorem ipsum dolor sit amet, consectetur
                                                    adipisicing elit
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Ngày tạo</th>
                                                <td class="text-left">01/01/2018 12:00</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Cập nhật gần nhất</th>
                                                <td class="text-left">01/01/2018 12:00</td>
                                            </tr>
                                            </tbody>
                                        </table>
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