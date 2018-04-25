@extends('admin.layouts.app')

@section('title','Quản lý nhân viên')

@section('plugin_css')
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Library</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên (Slug)</th>
                                    <th>Tên hiển thị</th>
                                    <th>Mô tả</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->display_name }}</td>
                                    <td>{{ $permission->description }}</td>
                                    <td>{{ $permission->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i> Xem</a>
                                            <button  type="button" data-target="#edit" @click="showEdit" data-toggle="modal" data-href="{{ route('permissions.edit', $permission->id) }}" @click="isShowEdit = true" class="btn btn-warning icon-btn btn-xs"><i class="ti-pencil"></i> Sửa</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Tên (Slug):</label>
                            <input type="text" class="form-control" name="name" id="name" v-model="name">
                        </div>
                        <div class="form-group">
                            <label for="display_name">Tên hiển thị:</label>
                            <input type="text" class="form-control" name="display_name" id="display_name" v-model="display_name">
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả:</label>
                            <input type="text" class="form-control" name="description" id="description" v-model="description">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('plugin_js')

@endsection
@section('custom_js')
    <script>

        let app  = new Vue({
            el: '#app',
            data:{
                href: '',
                id: '',
                name: '',
                display_name:'',
                description:'',
            },
            methods:{
                showEdit(e){
                    axios.get(e.target.dataset.href).then(rs =>{
                        this.id = rs.data.id;
                        this.name = rs.data.name;
                        this.display_name = rs.data.display_name;
                        this.description = rs.data.description;
                    });
                },

            },
        })
    </script>
@endsection