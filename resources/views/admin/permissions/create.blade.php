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
                        <b-form-radio-group v-model="permissionType" class="mb-4">
                            <b-form-radio name="permission_type" value="basic">Cơ bản</b-form-radio>
                            <b-radio name="permission_type" value="crud">Nâng cao</b-radio>
                        </b-form-radio-group>
                        <div class="form-group" v-if="permissionType == 'basic'">
                            <label for="display_name">Tên hiển thị</label>
                            <input type="text" class="form-control" name="display_name" id="display_name">
                        </div>
                        <div class="form-group" v-if="permissionType == 'basic'">
                            <label for="slug">Tên</label>
                            <input type="text" class="form-control" name="slug" id="slug">
                        </div>
                        <div class="form-group" v-if="permissionType == 'basic'">
                            <label for="description">Mô tả</label>
                            <input type="text" class="form-control" name="description" id="description">
                        </div>

                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" class="form-control" name="resource">
                        </div>
                        <div class="mb-2" v-if="permissionType == 'crud'">
                            <div class="row">
                                <div class="col-sm-4">
                                    <b-form-checkbox v-model="crudSelected" value="create" >Thêm</b-form-checkbox>
                                    <b-form-checkbox v-model="crudSelected" value="read" >Xem</b-form-checkbox>
                                    <b-form-checkbox v-model="crudSelected" value="update" >Cập nhật</b-form-checkbox>
                                    <b-form-checkbox v-model="crudSelected" value="delete" >Xóa</b-form-checkbox>
                                </div>
                                <div class="col-sm-8">

                                </div>
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
                permissionType: 'basic',
                crudSelected: ['create','read','update','delete']
            }
        });
    </script>
@endsection