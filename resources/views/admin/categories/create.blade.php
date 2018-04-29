@extends('admin.layouts.app')

@section('title','Thêm mới danh mục sản phẩm')

@section('plugin_css')
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Quản lý loại sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Thêm mới</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            {{ csrf_field() }}
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Tên danh mục sản phẩm</label>
                                    <input type="text" class="form-control" name="title" id="title" v-model="title">
                                </div>
                                <div class="form-group">
                                    <label for="slug">Tên slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug" :value="slugTitle(title)" readonly>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success">Thêm</button>
                                </div>
                            </div>

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
            el:'#app',
            data: {
                title:'',
                slug:''
            },
            methods:{
                slugTitle: (title) => {
                    return strslug(title)
                }
            }
        });
    </script>
@endsection