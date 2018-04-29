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
                    <li class="breadcrumb-item"><a href="#">Quản lý thương hiệu</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Thông tin {{ $brand->title }}</span>
                    </li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 grid-margin stretch-card">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3 class="text-left">{{ $brand->title }}</h3>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <th class="text-left">Mô tả</th>
                                                        <td class="text-left">{{ $brand->description }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Ngày tạo</th>
                                                        <td class="text-left">{{ $brand->created_at->format('d-m-Y') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Ngày cập nhật</th>
                                                        <td class="text-left">{{ $brand->updated_at->format('d-m-Y') }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <img src="{{ asset($brand->image) }}" alt="{{ $brand->title }}"
                                                 style="width: 150px;height: auto">
                                        </div>
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