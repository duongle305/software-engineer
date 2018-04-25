@extends('admin.layouts.app')

@section('title','Thêm mới quyền')

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
                    <form action="{{ route('permissions.store') }}" method="POST">
                        <div class="form-group">
                            @csrf
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-radio form-radio-flat">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" v-model="permissionType" value="basic" name="permission_type">
                                            Cơ bản
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-radio form-radio-flat">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" v-model="permissionType"  value="crud" name="permission_type">
                                            Nâng cao
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" v-if="permissionType == 'basic'">
                            <label for="display_name">Tên hiển thị</label>
                            <input type="text" class="form-control" name="display_name" id="display_name" value="{{ old('display_name') }}">
                        </div>
                        <div class="form-group" v-if="permissionType == 'basic'">
                            <label for="name">Tên</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group" v-if="permissionType == 'basic'">
                            <label for="description">Mô tả</label>
                            <input type="text" class="form-control" name="description" id="description" value="{{ old('description') }}">
                        </div>

                        <div class="form-group" v-if="permissionType == 'crud'">
                            <label for="resource">Resource</label>
                            <input type="text" class="form-control" name="resource" v-model="resource">
                        </div>

                        <div v-if="permissionType == 'crud'">
                            <div class="row">
                                <div class="col-xs-12 col-md-2">
                                    @php $curds = ['create'=>'Thêm','read'=>'Xem','update'=>'Sửa','delete'=>'Xóa'] @endphp
                                    @foreach($curds as $key => $val)
                                        <div class="form-group">
                                            <div class="form-check form-check-flat">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" v-model="crudSelected" value="{{ $key }}">
                                                    {{ $val }}
                                                    <i class="input-helper"></i>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-xs-12 col-md-10" v-if="resource.length >= 3 && crudSelected.length > 0">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Tên hiển thị</th>
                                                <th>Tên (Slug)</th>
                                                <th>Description</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="item in crudSelected">
                                                    <td v-text="crudName(item)"></td>
                                                    <td v-text="crudSlug(item)"></td>
                                                    <td v-text="crudDescription(item)"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" :value="crudSelected" name="crud_selected">
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('plugin_js')

@endsection
@section('custom_js')
    <script>
        let app = new Vue({
            el: '#app',

            data:{
                resource:'',
                permissionType: 'basic',
                crudSelected: ['create','read','update','delete']
            },
            methods:{
                crudName(item){
                    return item.replace(/create|read|update|delete/gi,function(x){
                        if(x==='create')
                            return  'Thêm';
                        if(x==='read')
                            return  'Xem';
                        if(x==='update')
                            return  'Sửa';
                        if(x==='delete')
                            return  'Xóa';
                    }) + " " + app.resource.toLowerCase();
                },
                crudSlug(item){
                    return item.toLowerCase() + "-" + strslug(app.resource.toLowerCase());
                },
                crudDescription: function(item) {
                    return "Cho phép người dùng " + item.replace(/create|read|update|delete/gi,function(x){
                        if(x==='create')
                            return  'thêm';
                        if(x==='read')
                            return  'xem';
                        if(x==='update')
                            return  'sửa';
                        if(x==='delete')
                            return  'xóa';
                    }) + " " + app.resource.toLowerCase();
                },
            },
        });
    </script>
@endsection