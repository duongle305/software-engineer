@extends('admin.layouts.app')

@section('title','Quản lý nhân viên')

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
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Họ tên</th>
                                <th>Giới tính</th>
                                <th>Hình ảnh</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Ngày tạo</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->first_name}} {{$user->last_name}}</td>
                                        <td>{{ucwords(strtolower($user->sex))}}</td>
                                        <td><img src="{{ asset($user->photo) }}" alt="photo"></td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->created_at->format('d-m-Y')}}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i> Xem</a>
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning icon-btn btn-xs"><i class="ti-pencil"></i> Sửa</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('plugin_js')

@endsection
@section('custom_js')
@endsection