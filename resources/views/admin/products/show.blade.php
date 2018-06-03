@extends('admin.layouts.app')

@section('title',$product->title.' - chi tiết sản phẩm')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel-2/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel-2/assets/owl.theme.default.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>{{ $product->title }}</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 grid-margin stretch-card">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="text-left">{{ $product->title }}</h4><br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <th class="text-left">Mã sản phẩm</th>
                                                        <td class="text-left">{{ $product->code }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Giá nhập</th>
                                                        <td class="text-left">{{ number_format($product->base_price) }} VNĐ</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Giá bán</th>
                                                        <td class="text-left">{{ number_format($product->unit_price) }} VNĐ</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Số lượng</th>
                                                        <td class="text-left">{{ $product->quantity }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Loại sản phẩm</th>
                                                        <td class="text-left"><a href="{{ route('categories.show',$product->category->id) }}">{{ $product->category->title }}</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Thương hiệu</th>
                                                        <td class="text-left"><a href="{{ route('brands.show',$product->brand->id) }}">{{ $product->brand->title }}</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Nhà cung cấp</th>
                                                        <td class="text-left"><a href="{{ route('suppliers.show',$product->supplier->id) }}">{{ $product->supplier->title }}</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Ngày tạo</th>
                                                        <td class="text-left">{{ $product->created_at->format('d-m-Y') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Ngày cập nhật</th>
                                                        <td class="text-left">{{ $product->updated_at->format('d-m-Y') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">Màu sắc</th>
                                                        <td class="text-left">{{ $product->colors()->first()->name }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="owl-carousel owl-theme full-width">
                                                @foreach($product->images as$image)
                                                <div class="item">
                                                    <img src="{{ asset($image->url) }}" alt="image"/>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            {!!  $product->description !!}
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
    <script src="{{ asset('assets/vendor/owl-carousel-2/owl.carousel.min.js') }}"></script>
@endsection
@section('custom_js')
    <script src="{{ asset('js/show-product.js') }}"></script>
@endsection