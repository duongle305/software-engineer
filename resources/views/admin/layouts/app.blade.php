<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="setting" content="{{ route('setting.template') }}">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/perfect-scrollbar/dist/css/perfect-scrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-toast-plugin/dist/jquery.toast.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <!-- endinject -->
    <!-- plugin css for this page -->
    @yield('plugin_css')
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>

<body class="{{ session()->get('sidebar') }} sidebar-fixed">
<div class="container-scroller">
    {{-- start header --}}
    @include('admin.layouts.header')
    {{-- end header--}}
    <div class="container-fluid page-body-wrapper">
        <div class="row row-offcanvas row-offcanvas-right">
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close mdi mdi-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options {{ (session()->get('sidebar')=='sidebar-light')?'selected':'' }}" id="sidebar-light-theme" data-sidebar="sidebar-light">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options {{ (session()->get('sidebar')=='sidebar-dark')?'selected':'' }}" id="sidebar-dark-theme" data-sidebar="sidebar-dark">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    @php
                        $headers = ['primary','success','warning','danger','pink','info','dark','default'];
                    @endphp
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        @foreach($headers as $header)
                        <div class="tiles {{ $header }} {{ (session()->get('header')=='navbar-'.$header)?'selected':'' }}" data-header="navbar-{{ $header }}"></div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- start sidebar --}}
            @include('admin.layouts.sidebar')
            {{-- end sidebar --}}
            {{-- start wrapper--}}
            <div class="content-wrapper">
            @yield('wrapper')
            </div>
            {{-- end wrapper --}}
            <footer class="footer">
                <div class="container-fluid clearfix">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2017 <a href="#">UrbanUI</a>. All rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Backend by <i class="mdi mdi-heart text-danger"></i></span>
                </div>
            </footer>
        </div>
    </div>
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>

<!-- endinject -->
<!-- Plugin js for this page-->
@yield('plugin_js')
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/js/misc.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>

<!-- endinject -->
<!-- Custom js for this page-->
<script type="text/javascript" src="{{ asset('assets/customs/settings.js') }}"></script>
@include('blocks.errors')
@include('blocks.messages')
@yield('custom_js')

<!-- End custom js for this page-->
</body>

</html>
