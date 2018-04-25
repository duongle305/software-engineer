@extends('admin.layouts.app')

@section('title','Dashboard')

@section('plugin_css')
@endsection

@section('wrapper')
    <div class="row grid-margin">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Library</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 grid-margin stretch-card">
                            <div class="card text-center">
                                <div class="card-body">
                                    <p class="text-muted"></p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th class="text-left">Tên (Slug):</th>
                                                <td class="text-left">{{ $permission->name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Hiển thị tên:</th>
                                                <td class="text-left">{{ $permission->display_name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Mô tả:</th>
                                                <td class="text-left">{{ $permission->description }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Ngày tạo:</th>
                                                <td class="text-left">{{ $permission->created_at->format('d-m-Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Ngày cập nhật:</th>
                                                <td class="text-left">{{ $permission->updated_at->format('d-m-Y') }}</td>
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