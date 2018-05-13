@extends('admin.layouts.app')

@section('title','Thông tin khách hàng: '. $customer-> first_name.' '.$customer->last_name)

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel-2/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel-2/assets/owl.theme.default.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Khách hàng</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Thông tin khách hàng</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 grid-margin stretch-card">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="text-left">{{ $customer-> first_name }} {{ $customer-> last_name }}</h4><br>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <th class="text-left">Số điện thoại</th>
                                                        <td class="text-left">{{ $customer->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Email</th>
                                                        <td class="text-left">{{ $customer->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Địa chỉ</th>
                                                        <td class="text-left">{{ $customer->address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Ngày tạo</th>
                                                        <td class="text-left">{{ $customer->created_at->format('d-m-Y')}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Ngày update</th>
                                                        <td class="text-left">{{ $customer->updated_at->format('d-m-Y')}}</td>
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
            <script src="{{ asset('assets/vendor/owl-carousel-2/owl.carousel.min.js') }}"></script>
            <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
@endsection
@section('custom_js')
@endsection