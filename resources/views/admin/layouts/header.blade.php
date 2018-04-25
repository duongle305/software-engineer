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
                    <a class="dropdown-item" href="{{ route('users.create') }}">
                        <i class="icon-user text-primary"></i>
                        Nhân viên
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('permissions.create') }}">
                        <i class="icon-key text-primary"></i>
                        Quyền
                    </a>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-lg-flex">
                <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown">
                    <i class="flag-icon flag-icon-gb"></i>
                    English
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
                    <a class="dropdown-item font-weight-medium" href="#">
                        <i class="flag-icon flag-icon-fr"></i>
                        French
                    </a>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="icon-bell mx-0"></i>
                    <span class="count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    <a class="dropdown-item">
                        <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
                        </p>
                        <span class="badge badge-pill badge-warning float-right">View all</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-success">
                                <i class="icon-info mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-medium">Application Error</h6>
                            <p class="font-weight-light small-text">
                                Just now
                            </p>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>