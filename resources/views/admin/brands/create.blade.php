@extends('admin.layouts.app')

@section('title','Thương hiệu - Thêm mới')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/dist/css/dropify.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">Thương hiệu</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Thêm mới</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            {{ csrf_field() }}
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Tên thương hiệu</label>
                                    <input type="text" class="form-control" name="title" id="title">
                                </div>
                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea type="text" class="form-control" rows="4" name="description" id="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Hình</label>
                                    <input type="file" class="dropify" name="image" id="image" />
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success">Thêm</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/vendor/dropify/dist/js/dropify.min.js') }}"></script>
@endsection
@section('custom_js')
    <script>
        $(document).ready(function(){
            $('.dropify').dropify();
        });
    </script>
@endsection