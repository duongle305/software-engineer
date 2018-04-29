@extends('admin.layouts.app')

@section('title','Quản lý danh mục sản phẩm')

@section('plugin_css')
@endsection

@section('wrapper')
    <div class="row grid-margin">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Danh mục sản phẩm</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên danh mục sản phẩm</th>
                                <th>Ngày tạo</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->title}}</td>
                                    <td>{{$category->created_at->format('d-m-Y')}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning icon-btn btn-xs"><i class="ti-pencil"></i>
                                                Sửa</a>
                                            <a href="{{ route('categories.destroy', $category->id) }}" class="btn btn-danger icon-btn btn-xs"><i class="ti-pencil"></i>
                                                Xóa</a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="4">Không có</td>
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