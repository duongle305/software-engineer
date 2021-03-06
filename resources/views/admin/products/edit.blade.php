@extends('admin.layouts.app')

@section('title',$product->title.' - cập nhật sản phẩm')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/dist/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/dist/summernote-bs4.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Cập nhật: {{ $product->title }}</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('products.update',$product->id) }}" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                @csrf
                                @method('PUT')
                            </div>
                            <div class="form-group">
                                <label for="title">Tên sản phẩm</label>
                                <input type="text" class="form-control" minlength="5" name="title" id="title" value="{{ $product->title }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea class="form-control summernote" rows="5" minlength="10" name="description" id="description">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="base_price">Giá Nhập</label>
                                        <input type="number" class="form-control" name="base_price" id="base_price" value="{{ $product->base_price }}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="unit_price">Giá bán</label>
                                        <input type="number" class="form-control" name="unit_price" id="unit_price" value="{{ $product->unit_price }}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="quantity">Số lượng</label>
                                        <input type="number" class="form-control" name="quantity" id="quantity" value="{{ $product->quantity }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="category_id">Loại sản phẩm</label>
                                        <select class="form-control" id="category_id" name="category_id">
                                            @foreach($categories as $categorie)
                                                <option value="{{ $categorie->id }}">{{ $categorie->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="brand_id">Thương hiệu</label>
                                        <select class="form-control" id="brand_id" name="brand_id">
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="supplier_id">Nhà cung cấp</label>
                                        <select class="form-control" id="supplier_id" name="supplier_id">
                                            @foreach($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photo">Thêm hình sản phẩm</label>
                                <input type="file" class="dropify" accept="image/*" name="images[]" id="images" multiple/>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/vendor/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/inputmask/dist/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor/inputmask/dist/inputmask/bindings/inputmask.binding.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/summernote/dist/summernote-bs4.min.js') }}"></script>
@endsection
@section('custom_js')
    <script src="{{ asset('js/edit-product.js') }}"></script>
@endsection