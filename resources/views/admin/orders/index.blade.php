@extends('admin.layouts.app')

@section('title','Quản lý đơn hàng')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel-2/assets/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel-2/assets/owl.theme.default.min.css') }}'" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Đơn hàng</span></li>
                </ol>
            </nav>
            <div class="card" id="app">

                <input type="hidden" id="href-data" value="{{ route('orders.data',false) }}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="search">Tìm kiếm</label>
                        <input type="search" class="form-control" id="search" v-model="search">
                    </div>
                    <ul class="nav nav-tabs tab-solid  tab-solid-primary text-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" href="#" :class="{'active':tab=='PENDING'}" @click.one="getDataOrders('PENDING')">Chờ xử lý</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" :class="{'active':tab=='READY'}" @click.one="getDataOrders('READY')" >Sẵn sàng giao</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" :class="{'active':tab=='SHIPPED'}" @click.one="getDataOrders('SHIPPED')">Đang giao</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" :class="{'active':tab=='DELIVERED'}" @click.one="getDataOrders('DELIVERED')">Hoàn thành</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" :class="{'active':tab=='CANCELLED'}" @click.one="getDataOrders('CANCELLED')">Hủy bỏ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" :class="{'active':tab=='DELIVERY FAILED'}" @click.one="getDataOrders('DELIVERY FAILED')" >Thất bại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" :class="{'active':tab=='RETURNED'}" @click.one="getDataOrders('RETURNED')">Trả hàng</a>
                        </li>
                    </ul>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="data-body">
                            <tr class="text-center" v-for="(item,index) in result">
                                <td>@{{ (index+1) }}</td>
                                <td>@{{ (item.code) }}</td>
                                <td>@{{ (item.created_at) }}</td>
                                <td>@{{ formatNumber(item.totals) }} VNĐ</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a :href="url+item.id" class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i> Xem</a>
                                        @if(auth()->user()->roles()->first()->name != 'shipper')
                                            <button type="button" class="btn btn-primary icon-btn btn-xs" v-if="tab === 'PENDING'" @click="readyToShip(index)"><i class="ti-package"></i> Sẵn sàng</button>
                                            <button type="button" class="btn btn-danger icon-btn btn-xs" v-if="tab === 'PENDING'" @click="cancelled(index)"><i class="ti-close"></i> Hủy bỏ</button>
                                            <button type="button" class="btn btn-primary icon-btn btn-xs" v-if="tab === 'READY'" @click="shipped(index)"><i class="ti-check"></i> Giao hàng</button>
                                        @endif
                                        @if(auth()->user()->roles()->first()->name != 'employee')
                                        <button type="button" class="btn btn-primary icon-btn btn-xs" v-if="tab === 'SHIPPED'" @click="delivered(index)"><i class="ti-check"></i> Hoàn thành</button>
                                        <button type="button" class="btn btn-info icon-btn btn-xs" v-if="tab === 'SHIPPED'" @click="returned(index)"><i class="ti-reload"></i> Trả hàng</button>
                                        <button type="button" class="btn btn-danger icon-btn btn-xs" v-if="tab === 'SHIPPED'" @click="deliveryFailed(index)"><i class="ti-close"></i> Thất bại</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="!pagination.total">
                                <td class="text-center" colspan="5">Không có dữ liệu.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <pagination :pagination="pagination" @click.native="getDataOrders(tab, pagination.current_page)" v-if="pagination.total > pagination.per_page"></pagination>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/number-format/jquery.number.min.js') }}"></script>
@endsection
@section('custom_js')
    <script src="{{ asset('js/orders.js') }}"></script>
@endsection