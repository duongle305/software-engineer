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
                    <li class="breadcrumb-item"><a href="#">Quản lý loại sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Thông tin role</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 grid-margin stretch-card">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="text-left">Category name</h4><br>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th class="text-left">Sluggable</th>
                                                <td class="text-left">category-name</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Ngày tạo</th>
                                                <td class="text-left">01/01/2018 12:00</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Ngày cập nhật</th>
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