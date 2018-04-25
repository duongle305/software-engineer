@extends('admin.layouts.app')

@section('title','Quản lý nhân viên')

@section('plugin_css')
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Library</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên (Slug)</th>
                                    <th>Tên hiển thị</th>
                                    <th>Mô tả</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->display_name }}</td>
                                    <td>{{ $permission->description }}</td>
                                    <td>{{ $permission->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button  type="button" data-target="#edit" data-toggle="modal" data-edit="{{ route('permissions.edit', $permission->id) }}" data-update="{{ route('permissions.update', $permission->id) }}" class="btn btn-success icon-btn btn-xs">
                                                <i class="ti-eye"></i> Xem
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
        @include('admin.permissions.modal')
    </div>
@endsection

@section('plugin_js')

@endsection
@section('custom_js')
    <script type="text/javascript" src="{{ asset('js/permission.js') }}"></script>
@endsection