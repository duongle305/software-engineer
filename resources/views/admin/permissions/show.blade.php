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
                                                <th class="text-left">Tên:</th>
                                                <td class="text-left">permissions</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Hiển thị tên:</th>
                                                <td class="text-left">display</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Ngày tạo:</th>
                                                <td class="text-left">create</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Ngày cập nhật:</th>
                                                <td class="text-left">update</td>
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