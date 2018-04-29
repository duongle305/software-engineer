@extends('admin.layouts.app')

@section('title','Quản lý đơn hàng')

@section('plugin_css')
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

@endsection
@section('custom_js')
@endsection