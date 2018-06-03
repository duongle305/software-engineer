@extends('admin.layouts.app')

@section('title','Thêm mới sản phẩm')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/dist/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" />
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Thêm mới</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                @csrf
                            </div>
                            <div class="form-group">
                                <label for="title">Tên sản phẩm</label>
                                <input type="text" class="form-control" minlength="5" name="title" id="title" v-model="name">
                            </div>
                            <div class="form-group">
                                <label for="slug">Tên slug</label>
                                <input readonly type="text" class="form-control"  name="slug" id="slug" :value="getSlug(name)">
                            </div>
                            <div class="form-group">
                                <label for="summernote">Mô tả</label>
                                <textarea id="summernote" class="form-control" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="base_price">Giá Nhập</label>
                                            <input type="number" class="form-control" name="base_price" id="base_price">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="unit_price">Giá bán</label>
                                            <input type="number" class="form-control" name="unit_price" id="unit_price">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="quantity">Số lượng</label>
                                            <input type="number" class="form-control" name="quantity" id="quantity">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="category_id">Danh mục sản phẩm</label>
                                            <select class="form-control" id="category_id" name="category_id">
                                                @foreach($categories as $categorie)
                                                    <option value="{{ $categorie->id }}">{{ $categorie->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="brand_id">Thương hiệu</label>
                                            <select class="form-control" id="brand_id" name="brand_id">
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="supplier_id">Nhà cung cấp</label>
                                            <select class="form-control" id="supplier_id" name="supplier_id">
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row colors">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check form-check-flat">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" v-model="isAddColor" @change="getColors" data-href="{{ route('ajax.colors') }}">
                                                Màu sắc
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group" v-if="isAddColor">
                                        <label for="colors">Chọn màu sắc sản phẩm</label>
                                        <select2-multiple :options="colors" name="colors[]"></select2-multiple>
                                        {{--<select name="colors[]" id="colors" multiple class="select-multiple-colors" style="width: 100%;"></select>--}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check form-check-flat">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" v-model="isAddSize">
                                                Kích thước
                                            </label>
                                        </div>
                                    </div>
                                    <div v-if="isAddSize">
                                        <div class="form-group">
                                            <label for="size_type_id">Chọn loại kích thước sản phẩm</label>
                                            <div class="row">
                                                <div class="col-xs-12 col-md-6">
                                                    <select id="size_type_id" name="size_type_id" class="form-control"
                                                            v-model="sizeTypeId" @change="getSizes">
                                                        @foreach(\App\Models\SizeType::all() as $type)
                                                            <option value="{{ $type->id }}"
                                                                    data-href="{{ route('ajax.sizes', $type->id )  }}">{{ $type->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xs-12 col-md-6" v-if="sizeTypeId">
                                                    {{--<select class="select-multiple-sizes" name="sizes[]" multiple style="width: 100%">--}}
                                                    {{--</select>--}}
                                                    <select2-multiple :options="sizes" name="sizes[]"></select2-multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="photo">Hình sản phẩm</label>
                                <input type="file" class="dropify" accept="image/*" name="images[]" id="images"
                                       multiple/>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success">Thêm</button>
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
    <script src="{{ asset('assets/vendor/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"></script>
@endsection
@section('custom_js')
    <script src="{{ asset('js/create-product.js') }}"></script>
@endsection