@extends('admin.layouts.app')

@section('title','Dashboard')

@section('plugin_css')
@endsection

@section('wrapper')
    <div class="row grid-margin">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Library</span></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 grid-margin stretch-card">
                            <div class="card text-center">
                                <div class="card-body">
                                    <img src="{{ asset($user->photo) }}" alt="image" class="img-lg rounded-circle mb-2"/>
                                    <h4>{{ $user->first_name }} {{ $user->last_name }}</h4>
                                    <p class="text-muted">{{ $user->roles()->first()->display_name }}</p>
                                    <a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning btn-sm mt-3 mb-4">Sửa</a>
                                    <div class="border-top pt-3">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p>Ngày sinh: {{ date('d-m-Y',strtotime($user->birthday)) }} </p>
                                                <p>Giới tính: {{ ucwords(strtolower($user->sex)) }}</p>
                                                <p>Email: {{ $user->email }}</p>
                                                <p>Địa chỉ thường trus</p>
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
    </div>
@endsection

@section('plugin_js')

@endsection
@section('custom_js')
@endsection