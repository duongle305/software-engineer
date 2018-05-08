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
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Sản phẩm</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <input type="hidden" id="href-data" value="{{ route('products.all') }}">
                    <form role="form" class="mt-2" @submit.prevent="search" data-search="{{ route('products.search') }}">
                        <h5 class="title">Tìm kiếm</h5>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Danh mục sản phẩm</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="from-group">
                                    <input type="search" class="form-control" name="code" placeholder="Mã sản phẩm">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="from-group">
                                    <input type="search" class="form-control" name="title" placeholder="Tên sản phẩm">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="from-group">
                                    <input type="search" class="form-control" name="unit_price" placeholder="Giá bán">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="from-group">
                                    <input type="date" class="form-control" name="created_at">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="from-group text-center">
                                    <button type="submit" class="btn btn-facebook">Tìm kiếm</button>
                                    <button @click.prevent="getAllProducts" class="btn btn-facebook">Tải lại</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-if="result.length == 0">
                                    <td colspan="7" class="text-center">Không có sản phẩm nào</td>
                                </tr>
                                <tr v-for="product in result">
                                    <td>@{{ product.id }}</td>
                                    <td>@{{ product.code }}</td>
                                    <td>@{{ product.title }}</td>
                                    <td>@{{ product.quantity }}</td>
                                    <td>@{{ product.unit_price }}</td>
                                    <td>@{{ product.created_at }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href=""
                                               class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i>
                                                Xem</a>
                                            <a href=""
                                               class="btn btn-warning icon-btn btn-xs"><i class="ti-pencil"></i>
                                                Sửa</a>
                                            <button type="button" :data-delete="'{{ route('products.destroy',false) }}'+'/'+product.id" :data-title="product.title" @click.one="showDelete" class="btn btn-danger icon-btn btn-xs"><i class="ti-trash"></i> Xóa</button>
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
    <script>
        let app = new Vue({
            el:'#app',
            data:{
                delete:'',
                hrefData:'',
                result: [],
                pagination: [],
            },
            methods:{
                showDelete(e){
                    this.delete = e.target.dataset.delete;
                    swal({
                        title: `Bạn có muốn xóa sản phẩm ${e.target.dataset.title}?`,
                        text: "Sau khi đồng ý bạn sẽ không khôi phục lại được.",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#fb9678',
                        confirmButtonText: 'Đồng ý'
                    }).then(() => {
                        this.deleteProduct();
                    }).catch(e => {})
                },
                getAllProducts(page = 1){
                    $('div.loader').show();
                    axios.get(`${this.hrefData}?page=${page}`).then(res=>{
                        this.result = res.data.data;
                        this.pagination = res.data;
                        let time = setTimeout(()=>{
                            $('div.loader').fadeOut();
                            clearTimeout(time);
                        },500);
                    });
                },
                deleteProduct(){
                    axios.delete(this.delete).then(rs => {
                        if(rs.status === 200){
                            swal(
                                'Đã xóa!',
                                `${rs.data.message}`,
                                'success'
                            ).then(()=>{
                                this.getAllProducts();
                            })
                        }
                    }).catch(e =>{
                        if(e.response.status === 401)
                            swal(
                                'Thông báo!',
                                `${e.response.data.message}`,
                                'error'
                            )
                    });
                },
                search(e){
                    let form = new FormData(e.target);
                    let href= e.target.dataset.search;
                    axios.post(`${href}`,form).then(res=>{
                        $('div.loader').show();
                        this.pagination = res.data;
                        this.result = res.data.data;
                        let time = setTimeout(()=>{
                            $('div.loader').fadeOut();
                            clearTimeout(time);
                        },500);
                    }).catch(er=>{

                    });
                }
            },
            mounted(){
                this.hrefData = $('#href-data').val();
                this.getAllProducts();
            }
        });
    </script>
@endsection