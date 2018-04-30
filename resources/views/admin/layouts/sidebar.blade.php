@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="profile-image">
                    <img src="{{ asset($user->photo) }}" alt="image"/>
                    <span class="online-status online"></span>
                </div>
                <div class="profile-name">
                    <p class="name">
                        {{ $user->first_name.' '.$user->last_name }}
                    </p>
                    <p class="designation">
                        {{ $user->roles()->first()->display_name }}
                    </p>
                    <a href="{{ route('admin.logout') }}" class="btn btn-warning btn-xs mt-2">Đăng xuất</a>
                </div>

            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">Bảng điều khiển</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="icon-user menu-icon"></i>
                <span class="menu-title">Nhân viên</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customers.index') }}">
                <i class="icon-people menu-icon"></i>
                <span class="menu-title">Khách hàng</span>
            </a>
        </li>
        <li class="nav-item d-none d-lg-block">
            <a class="nav-link" data-toggle="collapse" href="#role-permission" aria-expanded="false" aria-controls="sidebar-layouts">
                <i class="icon-key menu-icon"></i>
                <span class="menu-title">Vai trò & Quyền</span>
                <span class="badge badge-warning">2</span>
            </a>
            <div class="collapse" id="role-permission">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('roles.index') }}">Vai trò</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('permissions.index') }}">Quyền</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('suppliers.index') }}">
                <i class="icon-home menu-icon"></i>
                <span class="menu-title">Nhà cung cấp</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('brands.index') }}">
                <i class="icon-tag menu-icon"></i>
                <span class="menu-title">Thương hiệu</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('categories.index') }}">
                <i class="icon-list menu-icon"></i>
                <span class="menu-title">Danh mục sản phẩm</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('products.index') }}">
                <i class="icon-handbag menu-icon"></i>
                <span class="menu-title">Sản phẩm</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('orders.index') }}">
                <i class="icon-basket-loaded menu-icon"></i>
                <span class="menu-title">Đơn hàng</span>
            </a>
        </li>

    </ul>
</nav>