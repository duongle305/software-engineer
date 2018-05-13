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
                        <i class="ti-package icon-lg text-success"></i>
                        <div class="ml-3">
                            <p class="mb-0">Sản phẩm</p>
                            <h4>{{ \App\Models\Product :: all()->count()}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                        <i class="ti-receipt icon-lg text-warning"></i>
                        <div class="ml-3">
                            <p class="mb-0">Đơn hàng</p>
                            <h4>{{ \App\Models\Order:: all()->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                        <i class="ti-user icon-lg text-info"></i>
                        <div class="ml-3">
                            <p class="mb-0">Khách hàng</p>
                            <h4>{{ \App\Models\Customer::all()->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                        <i class="ti-stats-up icon-lg text-danger"></i>
                        <div class="ml-3">
                            <p class="mb-0">Thống kê tháng {{ date('m') }}</p>
                            <h4>{{ number_format($total) }} VNĐ</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                        <i class="ti-receipt icon-lg text-danger"></i>
                        <div class="ml-3">
                            <p class="mb-0">Đơn hàng chờ xử lý</p>
                            <h4>{{ \App\Models\Order::whereStatus('PENDING')->count()}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                        <i class="ti-archive icon-lg text-danger"></i>
                        <div class="ml-3">
                            <p class="mb-0">Đơn hàng đang giao</p>
                            <h4>{{ \App\Models\Order::whereStatus('SHIPPED')->count()}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>Sản phẩm bán chạy trong tháng {{ date('m') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng bán được</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($hotProducts as $key => $product)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->quantity }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>Khách hàng thân thiết</h5>
                    <div class="table-responsive-sm">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Họ</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Số lần mua hàng</th>
                                    <th>Tổng tiền mua hàng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hotCustomers as $key => $customer)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $customer->first_name }}</td>
                                    <td>{{ $customer->last_name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->order_quantity }}</td>
                                    <td>{{ number_format($customer->order_total) }} VNĐ</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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