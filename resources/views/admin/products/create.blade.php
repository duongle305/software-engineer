@extends('admin.layouts.app')

@section('title','Thêm mới sản phẩm')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/dist/css/dropify.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Thêm</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div>
                            <div class="form-group">
                                <label for="title">Tên sản phẩm</label>
                                <input type="text" class="form-control" minlength="5" name="title" id="title">
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea class="form-control" rows="5" minlength="10" name="description"
                                          id="description"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="base_price">Giá Nhập</label>
                                        <input type="number" class="form-control" name="base_price" id="base_price">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="unit_price">Giá bán</label>
                                        <input type="number" class="form-control" name="unit_price" id="unit_price">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="quantity">Số lượng</label>
                                        <input type="number" class="form-control" name="quantity" id="quantity">
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check form-check-flat">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" v-model="isAddColor">
                                                Thêm màu sắc
                                            </label>
                                        </div>
                                        <div class="form-group" v-if="isAddColor">
                                            <label for="size">Chọn màu sắc cho sản phẩm</label>
                                            <div class="form-check form-check-flat">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" value=""
                                                                   name="colors[]">
                                                            Màu 1
                                                            <i class="input-helper"></i>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" value=""
                                                                   name="colors[]">
                                                            Màu 2
                                                            <i class="input-helper"></i>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        {{--<div class="form-check form-check-flat">--}}
                                        {{--<label class="form-check-label">--}}
                                        {{--<input type="checkbox" class="form-check-input" v-model="isAddSize">--}}
                                        {{--Thêm size--}}
                                        {{--</label>--}}
                                        {{--</div>--}}
                                        <div class="form-group">
                                            <label for="size">Chọn size cho sản phẩm</label>
                                            <select name="ward" id="ward" class="form-control form-control-sm"
                                                    v-model="sizeTypeId" @change="getSizes">
                                                @foreach(\App\Models\SizeType::all() as $type)
                                                    <option value="{{ $type->id }}"
                                                            data-href="{{ route('ajax.sizes', $type->id )  }}">{{ $type->title }}</option>
                                                @endforeach
                                            </select>

                                            <div class="form-check form-check-flat" v-if="sizeTypeId">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="form-check-label" v-for="size in sizes">
                                                            <input type="checkbox" class="form-check-input"
                                                                   :value="size.id"
                                                                   name="sizes[]">
                                                            @{{ size.name }}
                                                            <i class="input-helper"></i>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" value=""
                                                                   name="sizes[]">
                                                            Size 2
                                                            <i class="input-helper"></i>
                                                        </label>
                                                    </div>
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
    <script src="{{ asset('assets/vendor/inputmask/dist/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor/inputmask/dist/inputmask/bindings/inputmask.binding.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
@endsection
@section('custom_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
        });
        let app = new Vue({
            el: '#app',
            data: {
                isAddColor: false,
                isAddSize: false,
                sizeTypeId: '',
                sizes: []
            },
            methods: {
                getSizes: (e) => {
                    if (e.target.options.selectedIndex > -1) {
                        let href = e.target.options[e.target.options.selectedIndex].dataset.href;
                        axios.get(href).then(rs => {
                            this.sizes = rs.data;
                        }).catch(e => {
                        });
                    }

                }
            },
        });
    </script>
@endsection