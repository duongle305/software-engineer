@extends('admin.layouts.app')

@section('title','Quản lý role')

@section('plugin_css')
@endsection

@section('wrapper')
    <div class="row grid-margin">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Vai trò</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên hiển thị</th>
                                <th>Ngày thêm</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->display_name }}</td>
                                        <td>{{ $role->created_at->format('d-m-Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('roles.show', $role->id) }}" class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i> Xem</a>
                                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning icon-btn btn-xs"><i class="ti-pencil"></i> Sửa</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

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