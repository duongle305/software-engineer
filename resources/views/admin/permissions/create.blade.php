@extends('admin.layouts.app')

@section('title','thêm mới quyền')

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
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            {{ csrf_field() }}
                        </div>
                        <div class="form-group">
                            <label for="first_name">Tên</label>
                            <input type="text" class="form-control" name="first_name" id="first_name"
                                   value="">

                        </div>
                        <div class="form-group">
                            <label for="first_name">Mô tả</label>
                            <textarea type="text" class="form-control" rows = "5" name="first_name" id="first_name"
                                      value=""></textarea>

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