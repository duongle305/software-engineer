@extends('admin.layouts.app')

@section('title','Dashboard')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
@endsection

@section('wrapper')
    <div class="row">
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                        <i class="fa fa-tag icon-lg text-success"></i>
                        <div class="ml-3">
                            <p class="mb-0">Tổng số sản phẩm</p>
                            {{ \App\Models\Product :: all()->count()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                        <i class="fa fa-star icon-lg text-warning"></i>
                        <div class="ml-3">
                            <p class="mb-0">Tổng số loại sản phẩm</p>
                            {{ \App\Models\Category::all()->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                        <i class="mdi mdi-cart icon-lg text-warning"></i>
                        <div class="ml-3">
                            <p class="mb-0">Tổng số đơn hàng</p>
                            {{ \App\Models\Order:: all()->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                        <i class="fa fa-user icon-lg text-info"></i>
                        <div class="ml-3">
                            <p class="mb-0">Tổng số người dùng</p>
                            {{ \App\Models\Customer::all()->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                        <i class="mdi mdi-chart-line-stacked icon-lg text-danger"></i>
                        <div class="ml-3">
                            <p class="mb-0">Thống kê tháng này</p>
                            <h6>{{ number_format($total) }} VNĐ</h6>
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