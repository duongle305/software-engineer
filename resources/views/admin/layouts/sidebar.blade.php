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
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">Dashboard</span>
                <span class="badge badge-success">New</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="icon-people menu-icon"></i>
                <span class="menu-title">Nhân viên</span>
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
    </ul>
</nav>