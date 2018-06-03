@extends('admin.layouts.app')

@section('title',$supplier->title.' - Chi tiết nhà cung cấp')

@section('plugin_css')

@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Nhà cung cấp</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>{{ $supplier->title  }}</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 grid-margin stretch-card">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="text-left mb-3">{{ $supplier->title  }}</h4>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th class="text-left">Số điện thoại: </th>
                                                            <td class="text-left" >{{ $supplier->phone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-left">Email: </th>
                                                            <td class="text-left">{{ $supplier->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-left">Địa chỉ: </th>
                                                            <td class="text-left">{{ $supplier->address }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-left">Ngày thêm: </th>
                                                            <td class="text-left" >{{ $supplier->created_at->format('d-m-Y') }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('plugin_js')

@endsection
@section('custom_js')
    <script type="text/javascript">
        let app = new Vue({
            el: '#app',
            data:{
                isUpdateSupplier: false,
            }
        })
    </script>
@endsection