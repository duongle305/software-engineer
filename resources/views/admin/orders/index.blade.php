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
                            <tbody>
                            <tr class="text-center" v-for="(item,index) in result">
                                <td>@{{ (index+1) }}</td>
                                <td>@{{ (item.code) }}</td>
                                <td>@{{ (item.created_at) }}</td>
                                <td>@{{ formatNumber(item.totals) }} VNĐ</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a :href="url+item.id" class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i> Xem</a>
                                        @if(auth()->user()->roles()->first()->name != 'shipper')
                                            <button type="button" class="btn btn-warning icon-btn btn-xs" v-if="tab === 'PENDING'" @click="readyToShip(index)">Sẵn sàng</button>
                                            <button type="button" class="btn btn-danger icon-btn btn-xs" v-if="tab === 'PENDING'" @click="cancelled(index)">HỦy bỏ</button>
                                            <button type="button" class="btn btn-warning icon-btn btn-xs" v-if="tab === 'READY'" @click="shipped(index)">Giao hàng</button>
                                        @endif
                                        @if(auth()->user()->roles()->first()->name != 'employee')
                                        <button type="button" class="btn btn-warning icon-btn btn-xs" v-if="tab === 'SHIPPED'" @click="delivered(index)">Hoàn thành</button>
                                        @endif
                                        <button type="button" class="btn btn-warning icon-btn btn-xs" v-if="tab === 'DELIVERY_FAILED'">Trả hàng</button>
                                    </div>
                                </td>
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
        let app = new Vue({
            el: '#app',
            data: {
                tab: 'PENDING',
                href: 'http://localhost:8000/admin-dl/data-orders',
                pagination:{},
                result:[],
                url:'orders/'
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
                changeStatus(status,id){
                    return axios.post(`status-orders/${id}`,{
                        status: status
                    });
                },
                readyToShip(index){
                    if(this.result[index]) {
                        this.changeStatus('READY', this.result[index].id).then(res => {
                            this.result.splice(index, 1);
                            swal(
                                'Thành công',
                                ``,
                                'success'
                            ).then(()=>{
                            })
                        });
                    }
                },
                shipped(index){
                    if(this.result[index]) {
                        this.changeStatus('SHIPPED', this.result[index].id).then(res => {
                            this.result.splice(index, 1);
                            swal(
                                'Thành công',
                                ``,
                                'success'
                            ).then(()=>{
                            })
                        });
                    }
                },
                delivered(index){
                    if(this.result[index]) {
                        this.changeStatus('DELIVERED', this.result[index].id).then(res => {
                            this.result.splice(index, 1);
                            swal(
                                'Thành công',
                                ``,
                                'success'
                            ).then(()=>{
                            })
                        });
                    }
                },
                cancelled(index) {
                    swal({
                        title: `Bạn có muốn hủy bỏ đơn hàng ${this.result[index].code}?`,
                        text: "Sau khi đồng ý bạn sẽ không khôi phục lại được.",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#fb9678',
                        confirmButtonText: 'Đồng ý'
                    }).then(() => {
                        if (this.result[index]) {
                            this.changeStatus('CANCELLED', this.result[index].id).then(res => {
                                this.result.splice(index, 1);
                            });
                        }
                    }).catch(e => {})
                }
            },
            mounted(){
                this.getDataOrders(this.tab);
            }
        });

    </script>
@endsection