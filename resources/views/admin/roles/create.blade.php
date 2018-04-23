@extends('admin.layouts.app')

@section('title','Thêm mới vai trò')

@section('plugin_css')
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Quản lý role</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Thêm mới role</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            {{ csrf_field() }}
                        </div>
                        <div class="form-group">
                            <label for="first_name">Tên</label>
                            <input type="text" class="form-control" name="role_name" id="rolet_name"
                                   value="">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Mô tả</label>
                            <textarea type="text" class="form-control" rows="5" name="role_description" id="role_description"
                                      value=""></textarea>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Quyền hạn</label>
                            <div class="row">
                                <div class="col-sm-12 col-md-2">
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="role_permission" id="role_permission_1">
                                            Default
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="role_permission" id="role_permission_1">
                                            Default
                                        </label>
                                    </div>
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
@endsection