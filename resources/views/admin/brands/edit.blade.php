@extends('admin.layouts.app')

@section('title',$brand->title.' - Chỉnh sửa')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/dist/css/dropify.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                    <li class="breadcrumb-item"><a href="{{route('brands.index')}}">Thương hiệu</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>{{ $brand->title  }}</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            @csrf
                            @method('PUT')
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Tên thương hiệu</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ $brand->title  }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea type="text" class="form-control" rows="4" name="description" id="description">{{ $brand->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Hình</label>
                                    <input type="file" class="dropify" name="image" id="image" data-default-file="{{ asset($brand->image) }}"/>
                                </div>

                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success">Cập nhật</button>
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