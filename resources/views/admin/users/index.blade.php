@extends('admin.layouts.app')

@section('title','Quản lý nhân viên')

@section('plugin_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection

@section('wrapper')
    <div class="row grid-margin" id="app">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>Nhân viên</span></li>
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
                                    @if($user->id !== \Illuminate\Support\Facades\Auth::user()->id)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                        <td>{{ ucwords(strtolower($user->sex)) }}</td>
                                        <td><img src="{{ asset($user->photo) }}" alt="photo"></td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-success icon-btn btn-xs"><i class="ti-eye"></i> Xem</a>
                                                <button type="button" data-delete="{{ route('users.destroy', $user->id) }}" data-name="{{$user->first_name}} {{$user->last_name}}" @click.one="showDelete" class="btn btn-danger icon-btn btn-xs"><i class="ti-trash"></i> Xóa</button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
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
    <script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
@endsection
@section('custom_js')
    <script src="{{ asset('js/user.js') }}"></script>
@endsection