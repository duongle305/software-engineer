@extends('admin.layouts.app')

@section('title','Quản lý nhân viên')

@section('plugin_css')
@endsection

@section('wrapper')
    <div class="row grid-margin">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Sản phẩm</span></li>
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
                                <th>Tên</th>
                                <th>Số lượng</th>
                                <th>Giá bán</th>
                                <th>Ngày tạo</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->code}}</td>
                                    <td>{{$product->title}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->unit_price}}</td>
                                    <td>{{$product->created_at->format('d-m-Y')}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{route('products.show', $product->id)}}"
                                               class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i>
                                                Xem</a>
                                            <a href="{{route('products.edit', $product->id)}}"
                                               class="btn btn-warning icon-btn btn-xs"><i class="ti-pencil"></i>
                                                Sửa</a>
                                            <a href="{{route('products.delete', $product->id)}}"
                                               class="btn btn-danger icon-btn btn-xs"><i class="ti-pencil"></i>
                                                Xoá</a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="7">Không có</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('plugin_js')

@endsection
@section('custom_js')
@endsection