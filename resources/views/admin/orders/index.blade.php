@extends('admin.layouts.app')

@section('title','Quản lý đơn hàng')

@section('plugin_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Đơn hàng</span></li>
                </ol>
            </nav>
            <div class="card" id="app">
                <div class="card-body">
                    <ul class="nav nav-tabs tab-solid  tab-solid-primary text-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" href="#" :class="{'active':tab=='PENDING'}" @click.one="getDataOrders('PENDING')">Đang xác nhận</a>
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
                            <a class="nav-link" href="#" :class="{'active':tab=='DELIVERY_FAILED'}" @click.one="getDataOrders('DELIVERY_FAILED')" >Thất bại</a>
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
                            <tbody>
                            <tr class="text-center" v-for="(item,index) in result">
                                <td>@{{ (index+1) }}</td>
                                <td>@{{ (item.code) }}</td>
                                <td>@{{ (item.created_at) }}</td>
                                <td>@{{ formatNumber(item.totals) }} VNĐ</td>
                            </tr>
                            <tr v-if="!pagination.total">
                                <td class="text-center" colspan="5">Không có dữ liệu.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <pagination :pagination="pagination" @click.native="getDataOrders(tab, pagination.current_page)" ></pagination>
                </div>
            </div>
        </div>
    </div>
    </div>@endsection

@section('plugin_js')
    <script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/number-format/jquery.number.min.js') }}"></script>
@endsection
@section('custom_js')
    <script>
        Vue.component('pagination',{
            template:`
                <ul class="pagination rounded-flat pagination-success justify-content-end" v-if="pagination.total">
                    <li class="page-item" :class="{ 'disabled':(pagination.current_page <= 1)}"><a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)"><i class="mdi mdi-chevron-left"></i></a></li>
                    <li class="page-item" :class="{'active':(pagination.current_page === page)}" v-for="page in pages"><a class="page-link" href="#" @click.prevent="changePage(page)">@{{ page }}</a></li>
                    <li class="page-item" :class="{ 'disabled':(pagination.current_page===pagination.total) }"><a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)"><i class="mdi mdi-chevron-right"></i></a></li>
                </ul>`,
            props:['pagination'],
            computed:{
                pages: function (){
                    let array = [];
                    let totalPages = Math.ceil(this.pagination.total / this.pagination.per_page);
                    for(let i = 1; i <= totalPages; i++){
                        array.push(i);
                    }
                    return array;
                }
            },
            methods:{
                changePage(page){
                    this.pagination.current_page = page;
                }
            }
        });
        let app = new Vue({
            el: '#app',
            data: {
                status:[
                    {name:'Đang xác nhận',st:'PENDING'},
                    {name:'Sẵn sàng giao',st:'READY'},
                    {name:'Đang giao',st:'SHIPPING'},
                    {name:'Đã giao',st:'DELIVERED'},
                    {name:'Hủy bỏ',st:'CANCELLED'},
                    {name:'Thất bại',st:'DELIVERY FAILED'},
                    {name:'Trả hàng',st:'RETURNED'}
                ],
                tab: 'PENDING',
                href: 'http://localhost:8000/admin-dl/data-orders',
                pagination:{},
                result:[]
            },
            methods: {
                getDataOrders(tab,page = 1){
                    this.tab = tab;
                    axios.get(`${this.href}/${tab}?page=${page}`).then(res=>{
                        this.result = res.data.data;
                        this.pagination = res.data;
                    });
                },
                formatNumber(num){
                    return $.number(num);
                },
            },
            mounted(){
                this.getDataOrders(this.tab);
            }
        });

    </script>
@endsection