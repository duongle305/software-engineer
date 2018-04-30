@extends('admin.layouts.app')

@section('title','Quản lý danh mục sản phẩm')

@section('plugin_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Danh mục sản phẩm</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên danh mục sản phẩm</th>
                                <th>Ngày tạo</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->title}}</td>
                                    <td>{{$category->created_at->format('d-m-Y')}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning icon-btn btn-xs"><i class="ti-pencil"></i>
                                                Sửa</a>
                                            <button type="button" data-delete="{{ route('categories.destroy', $category->id) }}" data-title="{{$category->title}}" @click.one="showDelete" class="btn btn-danger icon-btn btn-xs"><i class="ti-trash"></i> Xóa</button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="4">Không có</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
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
            },
            methods:{
                showDelete(e){
                    this.delete = e.target.dataset.delete;
                    swal({
                        title: `Bạn có muốn xóa danh mục ${e.target.dataset.title}?`,
                        text: "Sau khi đồng ý bạn sẽ không khôi phục lại được.",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#fb9678',
                        confirmButtonText: 'Đồng ý'
                    }).then(() => {
                        this.deleteUser();
                    }).catch(e => {})
                },
                deleteUser(){
                    axios.delete(this.delete).then(rs => {
                        if(rs.status === 200){
                            swal(
                                'Đã xóa!',
                                `${rs.data.message}`,
                                'success'
                            ).then(()=>{
                                location.reload();
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
                }
            }
        })
    </script>
@endsection