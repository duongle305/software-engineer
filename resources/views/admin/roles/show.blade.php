@extends('admin.layouts.app')

@section('title','Dashboard')

@section('plugin_css')
@endsection

@section('wrapper')
    <div class="row grid-margin">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Vai trò</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>{{ $role->display_name }}</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 grid-margin stretch-card">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="text-left mb-3">{{ $role->display_name }}</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th class="text-left">Tên hiển thị</th>
                                                <td class="text-left">{{ $role->display_name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Tên</th>
                                                <td class="text-left">{{ $role->name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Mô tả</th>
                                                <td class="text-left">
                                                    {{ $role->description }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Ngày thêm</th>
                                                <td class="text-left">{{ $role->created_at->format('d-m-Y H:i') }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Danh sách quyền</th>
                                                <td>
                                                    <ul class="list-ticked text-left">
                                                        @foreach($role->permissions as $permission)
                                                        <li>{{ $permission->display_name }} <i>({{ $permission->name }})</i></li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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