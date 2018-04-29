@extends('admin.layouts.app')

@section('title',$category->title.' - Cập nhật danh mục sản phẩm')

@section('plugin_css')
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Quản lý loại sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Cập nhật danh mục sản phẩm: {{ $category->title }}</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            @csrf
                            @method('PUT')
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" id="url" value="{{ route('ajax.category', $category->id) }}">
                                </div>
                                <div class="form-group">
                                    <label for="title">Tên danh mục sản phẩm</label>
                                    <input type="text" class="form-control" name="title" id="title" v-model="title">
                                </div>
                                <div class="form-group">
                                    <label for="slug">Tên slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug" :value="slugTitle(title)" readonly>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success">Cập nhật</button>
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
                url: $('#url').val(),
                title:'',
                slug:''
            },
            methods:{
                slugTitle: (title) => {
                    return strslug(title)
                },
                getCategory(){
                    axios.get(this.url).then(rs =>{
                        this.title = rs.data.title;
                        this.slug = rs.data.slug;
                    });
                }
            },
            mounted(){
                this.getCategory();
            }
        });
    </script>
@endsection