@extends('admin.layouts.app')

@section('title','Quản lý thương hiệu')

@section('plugin_css')
@endsection

@section('wrapper')
    <div class="row grid-margin">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Quản lý thương hiệu</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên thương hiệu</th>
                                <th class="text-center">Ảnh thương hiệu</th>
                                <th>Ngày tạo</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($brands as $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>
                                    <td>{{ $brand->title }}</td>
                                    <td class="text-center"><img src="{{ asset($brand->image) }}" alt="{{ $brand->title }}"></td>
                                    <td>{{ $brand->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('brands.show', $brand->id) }}" class="btn btn-success icon-btn btn-xs"><i class="ti-pencil"></i>
                                                Xem</a>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning icon-btn btn-xs"><i class="ti-pencil"></i>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')

@endsection
@section('custom_js')
@endsection