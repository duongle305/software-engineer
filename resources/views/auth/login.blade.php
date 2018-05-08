@extends('auth.layouts.app')

@section('title', 'Đăng nhập')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-toast-plugin/dist/jquery.toast.min.css') }}">
@endsection

@section('wrapper')
    <div class="container-fluid page-body-wrapper">
        <div class="row">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-full-bg" style="background-image: url({{ asset('uploads/background.jpg') }})">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-dark text-left p-5">
                            <h2>Sales Management</h2>
                            <form class="pt-5" method="post" action="{{ route('login') }}">
                                <div class="form-group">
                                    {{ csrf_field() }}
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Mật khẩu</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="mt-5">
                                    <button class="btn btn-block btn-warning btn-lg font-weight-medium">Đăng Nhập</button>
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="#" class="auth-link text-white">Quên mật khẩu?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/vendor/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
@endsection

@section('custom_js')
    @include('blocks.errors')
@endsection