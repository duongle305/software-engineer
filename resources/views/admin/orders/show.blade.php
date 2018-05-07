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
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Đơn hàng</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span>{{ $order->code }}</span></li>
                </ol>
            </nav>
            <div class="card" id="app">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 grid-margin stretch-card">
                            <div class="card text-center">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 text-left">
                                            <h4 class="text-left">Đơn hàng: {{ $order->code }}</h4><br>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="text-right">Trạng thái: <label class="badge badge-info">{{ $order->status }}</label></h5><br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h5 class="title text-left">Thông tin khách hàng</h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <tbody class="text-left">
                                                                    <tr>
                                                                        <th>Ngày đặt</th>
                                                                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Khách hàng</th>
                                                                        <td>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Số điện thoại</th>
                                                                        <td>{{ $order->customer->phone }}</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <tbody>
                                                                    <tr class="text-left">
                                                                        <th>Tổng cộng</th>
                                                                        <td>{{ number_format($order->totals) }} VNĐ</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-2">
                                                    <h5 class="title text-left">Địa chỉ thanh toán</h5>
                                                    {{ ($order->customer->address)}}
                                                </div>
                                                <div class="col-md-2">
                                                    <h5 class="title text-left">Địa chỉ giao hàng</h5>
                                                    {{ ($order->address)? $order->address : $order->customer->address}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <h4 class="text-left">Sản phẩm</h4><br>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Mã SP</th>
                                                        <th>Tên SP</th>
                                                        <th>Đơn giá</th>
                                                        <th>Số lượng</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($order->products as $product)
                                                    <tr>
                                                        <td>{{ $product->code }}</th>
                                                        <td>{{ $product->title }}</td>
                                                        <td>{{ number_format($product->unit_price) }} VNĐ</td>
                                                        <td>
                                                            {{ $product->quantity_order }}
                                                        </td>
                                                    </tr>
                                                        @endforeach
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