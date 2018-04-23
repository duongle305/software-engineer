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
            <a class="nav-link" href="">
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
    </ul>
</nav>