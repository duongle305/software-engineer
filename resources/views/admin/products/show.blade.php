@extends('admin.layouts.app')

@section('title','Dashboard')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel-2/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel-2/assets/owl.theme.default.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Chi tiết sản phẩm</span></li>
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
                                                        <th class="text-left">Mô tả</th>
                                                        <td class="text-left">{{ $product->description }}</td>
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
                                                        <th class="text-left">Ngày update</th>
                                                        <td class="text-left">{{ $product->updated_at->format('d-m-Y') }}</td>
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
    <script>
        $.fn.andSelf = function() {
            return this.addBack.apply(this, arguments);
        }

        if($('.full-width').length) {
            $('.full-width').owlCarousel({
                loop: true,
                margin: 10,
                items: 1,
                nav: true,
                autoplay: true,
                autoplayTimeout:5500,
                navText: ["<i class='mdi mdi-chevron-left'></i>","<i class='mdi mdi-chevron-right'></i>"]
            });
        }

    </script>
@endsection
@section('custom_js')
@endsection