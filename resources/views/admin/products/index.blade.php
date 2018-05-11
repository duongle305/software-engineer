@extends('admin.layouts.app')

@section('title','Quản lý Sản phẩm')

@section('plugin_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Sản phẩm</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 pull-right">
                            <div class="form-group">
                                <label for="search">Tìm kiếm</label>
                                <input type="search" id="search" v-model="search" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="href-data" value="{{ route('products.all') }}">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã</th>
                                    <th>Tên</th>
                                    <th>Số lượng</th>
                                    <th>Giá bán</th>
                                    <th>Ngày tạo</th>
                                    <th>Trạng thái</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="result.length == 0">
                                    <td colspan="7" class="text-center">Không có sản phẩm nào</td>
                                </tr>
                                <tr v-for="(product, index) in result">
                                    <td>@{{ (index+1) }}</td>
                                    <td>@{{ product.code }}</td>
                                    <td>@{{ product.title }}</td>
                                    <td>@{{ product.quantity }}</td>
                                    <td>@{{ product.unit_price }}</td>
                                    <td>@{{ formatDate(product.created_at) }}</td>
                                    <td>
                                        <i v-if="(product.status === 'ACTIVE')" class="text-success ti-check"></i>
                                        <i v-else class="text-danger ti-close"></i>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a :href="`{{ route('products.index') }}/${product.id}`" class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i> Xem</a>
                                            <a :href="`{{ route('products.index') }}/${product.id}/edit`" class="btn btn-warning icon-btn btn-xs"><i class="ti-pencil"></i> Sửa</a>
                                            <button type="button" :data-delete="`{{ route('products.index') }}/{product.id}`" @click.one="showDelete($event,index)" class="btn btn-danger icon-btn btn-xs"><i class="ti-trash"></i> Xóa</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <pagination v-if="result.length >= pagination.per_page" :pagination="pagination" @click.native="getAllProducts(tab, pagination.current_page)"></pagination>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('plugin_js')
    <script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
@endsection
@section('custom_js')
    <script src="{{ asset('js/products.js') }}"></script>
@endsection