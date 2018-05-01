@extends('admin.layouts.app')

@section('title','Thương hiệu')

@section('plugin_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Thương hiệu</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên thương hiệu</th>
                                <th class="text-center">Ảnh thương hiệu</th>
                                <th>Ngày tạo</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($brands as $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>
                                    <td>{{ $brand->title }}</td>
                                    <td class="text-center"><img src="{{ asset($brand->image) }}" alt="{{ $brand->title }}"></td>
                                    <td>{{ $brand->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('brands.show', $brand->id) }}" class="btn btn-success icon-btn btn-xs"><i class="ti-pencil"></i>
                                                Xem</a>
                                            <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning icon-btn btn-xs"><i class="ti-pencil"></i>
                                                Sửa</a>
                                            <button type="button" data-delete="{{ route('brands.destroy', $brand->id) }}" data-title="{{$brand->title}}" @click.one="showDelete" class="btn btn-danger icon-btn btn-xs"><i class="ti-trash"></i> Xóa</button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="5">Không có</td>
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
                        title: `Bạn có muốn xóa thương hiệu ${e.target.dataset.title}?`,
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