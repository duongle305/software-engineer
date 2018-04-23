@extends('admin.layouts.app')

@section('title','Quản lý loại sản phẩm')

@section('plugin_css')
@endsection

@section('wrapper')
    <div class="row grid-margin">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Quản lý loại sản phẩm</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên loại sản phẩm</th>
                                <th>Ngày tạo</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="" class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i> Xem</a>
                                        <a href="" class="btn btn-warning icon-btn btn-xs"><i class="ti-pencil"></i> Sửa</a>
                                    </div>
                                </td>
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