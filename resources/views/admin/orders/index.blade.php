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
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Mã</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->code}}</td>
                                    <td>{{$order->created_at->format('d-m-Y')}}</td>
                                    <td></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{route('orders.show', $order->id)}}" class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i>
                                                Xem</a>
                                            <a href="{{route('orders.edit', $order->id)}}" class="btn btn-warning icon-btn btn-xs"><i class="ti-pencil"></i>
                                                Sửa</a>
                                            <button type="button" data-delete="{{ route('categories.destroy', $order->id) }}" data-code="{{$order->code}}" @click.one="showDelete" class="btn btn-danger icon-btn btn-xs"><i class="ti-trash"></i> Xóa</button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">Không có</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('plugin_js')
    <script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
@endsection
@section('custom_js')
    <script>
        let app = new Vue({
            el:'#app',
            data:{
                delete:'',
            },
            methods:{
                showDelete(e){
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
                        this.deleteUser();
                    }).catch(e => {})
                },
                deleteUser(){
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
                }
            }
        })
    </script>
@endsection