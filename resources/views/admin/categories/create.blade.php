@extends('admin.layouts.app')

@section('title','Thêm mới loại sản phẩm')

@section('plugin_css')
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Quản lý loại sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Thêm mới</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            {{ csrf_field() }}
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-pull-6">
                                <div class="form-group">
                                    <label for="first_name">Tên loại sản phẩm</label>
                                    <input type="text" class="form-control" name="categories_name" id="categories_name"
                                           value="">
                                </div>
                                <div class="form-group">
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

@endsection
@section('custom_js')
@endsection