<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('admin.dashboard')}}" class="nav-link">Home</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-cog"></i> {{Auth::user()->name}}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Settings</span>
                <div class="dropdown-divider"></div>
                <a href="{{route('admin.change_profile')}}" class="dropdown-item">
                    <i class="nav-icon fas fa-users-cog"></i> Profile Settings
                    <span class="float-right text-muted text-sm"></span>
                </a>
                <a href="{{route('logout')}}" class="dropdown-item">
                    <i class="nav-icon fas fa-sign-out-alt"></i> Logout
                    <span class="float-right text-muted text-sm"></span>
                </a>
            </div>
        </li>
    </ul>
</nav>