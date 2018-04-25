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
                    <li class="breadcrumb-item"><a href="#">Nhà cung cấp</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Chi tiết nhà cung cấp</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 grid-margin stretch-card">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="text-left">Suppeliter name</h4><br>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <th class="text-left">Số điện thoại</th>
                                                        <td class="text-left">0969363678</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Email</th>
                                                        <td class="text-left">alice@gmail.com</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Địa chỉ</th>
                                                        <td class="text-left">Quận 12, HCM</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Ngày tạo</th>
                                                        <td class="text-left">30/04/2018 12:00</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Ngày cập nhật</th>
                                                        <td class="text-left">30/04/2018 12:00</td>
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
        </div>
@endsection

@section('plugin_js')

@endsection
@section('custom_js')
@endsection