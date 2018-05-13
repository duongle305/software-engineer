<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row {{ session()->get('header')}}">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href=""><img src="{{ asset('assets/images/logo.svg') }}" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href=""><img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav">
            <li class="nav-item dropdown d-none d-lg-flex">
                <a class="nav-link dropdown-toggle nav-btn" id="actionDropdown" href="#" data-toggle="dropdown">
                    <span class="btn">+ Thêm mới</span>
                </a>
                <div class="dropdown-menu navbar-dropdown dropdown-left" aria-labelledby="actionDropdown">
                    @can('create-users')
                    <a class="dropdown-item" href="{{ route('users.create') }}">
                        <i class="icon-user text-primary"></i>
                        Nhân viên
                    </a>
                    @endcan
                    @can('create-acl')
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('roles.create') }}">
                        <i class="icon-lock text-primary"></i>
                        Vai trò
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('permissions.create') }}">
                        <i class="icon-key text-primary"></i>
                        Quyền
                    </a>
                    @endcan
                    @can('create-suppliers')
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('suppliers.create') }}">
                        <i class="icon-home text-primary"></i>
                        Nhà cung cấp
                    </a>
                    @endcan
                    @can('create-products')
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('products.create') }}">
                            <i class="icon-tag text-primary"></i>
                            Sản phẩm
                        </a>
                    @endcan
                    @can('create-brands')
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('brands.create') }}">
                            <i class="icon-diamond text-primary"></i>
                            Thương hiệu
                        </a>
                    @endcan
                    @can('create-categories')
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('categories.create') }}">
                            <i class="icon-list text-primary"></i>
                            Danh mục sản phẩm
                        </a>
                    @endcan
                    @can('create-orders')
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('orders.create') }}">
                            <i class="icon-bag text-primary"></i>
                            Đơn hàng
                        </a>
                    @endcan
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>