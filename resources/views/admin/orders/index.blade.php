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
                <ul class="nav nav-tabs tab-solid tab-solid-danger text-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-5-1" data-toggle="tab" href="#pending" role="tab"
                           aria-controls="tab-5-2" aria-selected="true">Đang xác nhận</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-5-2" data-toggle="tab" href="#ready" role="tab"
                           aria-controls="profile-5-2" aria-selected="false">Sẵn sàng giao</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-5-3" data-toggle="tab" href="#shipping" role="tab"
                           aria-controls="contact-5-3" aria-selected="false">Đang giao</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-5-3" data-toggle="tab" href="#delivered" role="tab"
                           aria-controls="contact-5-3" aria-selected="false">Đã giao</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-5-3" data-toggle="tab" href="#cancelled" role="tab"
                           aria-controls="contact-5-3" aria-selected="false">Khách hủy bỏ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-5-3" data-toggle="tab" href="#delivery-failed" role="tab"
                           aria-controls="contact-5-3" aria-selected="false">Thất bại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-5-3" data-toggle="tab" href="#returned" role="tab"
                           aria-controls="contact-5-3" aria-selected="false">Trả hàng</a>
                    </li>
                </ul>
                <div class="tab-content tab-content-solid">
                    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="tab-5-2">
                        <div class="card-body">
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
                                        <tr class="text-center" v-for="(pending,index) in pendings">
                                            <td>@{{ index+1 }}</td>
                                            <td>@{{ pending.code }}</td>
                                            <td>@{{ pending.created_at }}</td>
                                            <td>@{{ formatNumber(pending.totals) }} VNĐ</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a :href="url + pending.id" class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i>Xem</a>
                                                    <button data-toggle="modal" data-target="#statusChange" data-whatever="@mdo" class="btn btn-warning icon-btn btn-xs">Đổi trạng thái</button>
                                                    <button type="button" :data-delete="url+pending.id" :data-code="pending.code" @click.one="showDelete" class="btn btn-danger icon-btn btn-xs"><i class="ti-trash"></i> Xóa</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ready" role="tabpanel" aria-labelledby="tab-5-2">
                        <div class="card-body">
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
                                    <tr class="text-center" v-for="(ready,index) in readys">
                                        <td>@{{ index+1 }}</td>
                                        <td>@{{ ready.code }}</td>
                                        <td>@{{ ready.created_at }}</td>
                                        <td>@{{ formatNumber(ready.totals) }} VNĐ</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a :href="url + ready.id" class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i>Xem</a>
                                                <button data-toggle="modal" data-target="#statusChange" data-whatever="@mdo" class="btn btn-warning icon-btn btn-xs">Đổi trạng thái</button>
                                                <button type="button" :data-delete="url+ready.id" :data-code="ready.code" @click.one="showDelete" class="btn btn-danger icon-btn btn-xs"><i class="ti-trash"></i> Xóa</button>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="tab-5-3">
                        <div class="card-body">
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
                                    <tr class="text-center" v-for="(shipping,index) in shippings">
                                        <td>@{{ index+1 }}</td>
                                        <td>@{{ shipping.code }}</td>
                                        <td>@{{ shipping.created_at }}</td>
                                        <td>@{{ formatNumber(shipping.totals) }} VNĐ</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a :href="url + shipping.id" class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i>Xem</a>
                                                <button data-toggle="modal" data-target="#statusChange" data-whatever="@mdo" class="btn btn-warning icon-btn btn-xs">Đổi trạng thái</button>
                                                <button type="button" :data-delete="url+shipping.id" :data-code="shipping.code" @click.one="showDelete" class="btn btn-danger icon-btn btn-xs"><i class="ti-trash"></i> Xóa</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="shippings.length == 0">
                                        <td class="text-center" colspan="5">Không có</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="tab-5-3">
                        <div class="card-body">
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
                                    <tr class="text-center" v-for="(delivered,index) in delivereds">
                                        <td>@{{ index+1 }}</td>
                                        <td>@{{ delivered.code }}</td>
                                        <td>@{{ delivered.created_at }}</td>
                                        <td>@{{ formatNumber(delivered.totals) }} VNĐ</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a :href="url + delivered.id" class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i>Xem</a>
                                                <button data-toggle="modal" data-target="#statusChange" data-whatever="@mdo" class="btn btn-warning icon-btn btn-xs">Đổi trạng thái</button>
                                                <button type="button" :data-delete="url+delivered.id" :data-code="delivered.code" @click.one="showDelete" class="btn btn-danger icon-btn btn-xs"><i class="ti-trash"></i> Xóa</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="delivereds.length == 0">
                                        <td class="text-center" colspan="5">Không có</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="tab-5-3">
                        <div class="card-body">
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
                                    <tr class="text-center" v-for="(cancelled,index) in cancelleds">
                                        <td>@{{ index+1 }}</td>
                                        <td>@{{ cancelled.code }}</td>
                                        <td>@{{ cancelled.created_at }}</td>
                                        <td>@{{ formatNumber(cancelled.totals) }} VNĐ</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a :href="url + cancelled.id" class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i>Xem</a>
                                                <button data-toggle="modal" data-target="#statusChange" data-whatever="@mdo" class="btn btn-warning icon-btn btn-xs">Đổi trạng thái</button>
                                                <button type="button" :data-delete="url+cancelled.id" :data-code="cancelled.code" @click.one="showDelete" class="btn btn-danger icon-btn btn-xs"><i class="ti-trash"></i> Xóa</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="cancelleds.length == 0">
                                        <td class="text-center" colspan="5">Không có</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="delivery-failed" role="tabpanel" aria-labelledby="tab-5-3">
                        <div class="card-body">
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
                                    <tr class="text-center" v-for="(failed,index) in deliveryFaileds">
                                        <td>@{{ index+1 }}</td>
                                        <td>@{{ failed.code }}</td>
                                        <td>@{{ failed.created_at }}</td>
                                        <td>@{{ formatNumber(failed.totals) }} VNĐ</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a :href="url + failed.id" class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i>Xem</a>
                                                <button data-toggle="modal" data-target="#statusChange" data-whatever="@mdo" class="btn btn-warning icon-btn btn-xs">Đổi trạng thái</button>
                                                <button type="button" :data-delete="url+failed.id" :data-code="failed.code" @click.one="showDelete" class="btn btn-danger icon-btn btn-xs"><i class="ti-trash"></i> Xóa</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="deliveryFaileds.length == 0">
                                        <td class="text-center" colspan="5">Không có</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="returned" role="tabpanel" aria-labelledby="tab-5-3">
                        <div class="card-body">
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
                                    <tr class="text-center" v-for="(returned,index) in returneds">
                                        <td>@{{ index+1 }}</td>
                                        <td>@{{ returned.code }}</td>
                                        <td>@{{ returned.created_at }}</td>
                                        <td>@{{ formatNumber(returned.totals) }} VNĐ</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a :href="url + returned.id" class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i>Xem</a>
                                                <button data-toggle="modal" data-target="#statusChange" data-whatever="@mdo" class="btn btn-warning icon-btn btn-xs">Đổi trạng thái</button>
                                                <button type="button" :data-delete="url+returned.id" :data-code="returned.code" @click.one="showDelete" class="btn btn-danger icon-btn btn-xs"><i class="ti-trash"></i> Xóa</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="returneds.length == 0">
                                        <td class="text-center" colspan="5">Không có</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="statusChange" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-4" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel-4"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="order-status" class="col-form-label">Thay đổi trạng thái:</label>
                                        <select class="form-control" id="order-status" name="order-status">
                                            <option v-for="st in status" :value="st.st">
                                                @{{ st.name }}
                                            </option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success">Cập nhật</button>
                            </div>
                        </div>
                    </div>
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
                delete: '',
                pendings:[],
                readys:[],
                shippings:[],
                delivereds:[],
                cancelleds:[],
                deliveryFaileds:[],
                returneds:[],
                url:'orders/',
                status:[{name:'Đang xác nhận',st:'PENDING'},{name:'Sẵn sàng giao',st:'READY'},{name:'Đang giao',st:'SHIPPING'},{name:'Đã giao',st:'DELIVERED'},{name:'Hủy bỏ',st:'CANCELLED'},{name:'Thất bại',st:'DELIVERY FAILED'},{name:'Trả hàng',st:'RETURNED'}]
            },
            methods: {
                showDelete(e) {
                    this.delete = e.target.dataset.delete;
                    swal({
                        title: `Bạn có muốn xóa đơn hàng ${e.target.dataset.code}?`,
                        text: "Sau khi đồng ý bạn sẽ không khôi phục lại được.",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#fb9678',
                        confirmButtonText: 'Đồng ý'
                    }).then(() => {
                        this.deleteOrder();
                    }).catch(e => {
                    })
                },
                getPedding(){
                    axios.get('/admin-dl/ajax/pending').then(rs => {
                        this.pendings = rs.data;
                    });
                },
                getReady(){
                    axios.get('/admin-dl/ajax/ready').then(rs => {
                        this.readys = rs.data;
                    });
                },
                getShipping(){
                    axios.get('/admin-dl/ajax/shipping').then(rs => {
                        this.shippings = rs.data;
                    });
                },
                getDelivered(){
                    axios.get('/admin-dl/ajax/delivered').then(rs => {
                        this.delivereds = rs.data;
                    });
                },
                getCancelled(){
                    axios.get('/admin-dl/ajax/cancelled').then(rs => {
                        this.cancelleds = rs.data;
                    });
                },
                getFailed(){
                    axios.get('/admin-dl/ajax/failed').then(rs => {
                        this.deliveryFaileds = rs.data;
                    });
                },
                getReturned(){
                    axios.get('/admin-dl/ajax/returned').then(rs => {
                        this.returneds = rs.data;
                    });
                },
                deleteOrder(){
                    axios.delete(this.delete).then(rs => {
                        if(rs.status === 200){
                            swal(
                                'Đã xóa!',
                                `${rs.data.message}`,
                                'success'
                            ).then(()=>{
                                location.reload();
                            })
                        }
                    }).catch(e =>{
                        if(e.response.status === 401)
                            swal(
                                'Thông báo!',
                                `${e.response.data.message}`,
                                'error'
                            )
                    });
                },
                formatNumber(num){
                    return $.number(num);
                },
                updateStatus(){

                }
            },
            mounted(){
                this.getPedding();
                this.getReady();
                this.getShipping();
                this.getDelivered();
                this.getCancelled();
                this.getFailed();
                this.getReturned();
            }
        })
    </script>
@endsection