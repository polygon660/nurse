<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Nursing Room</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name ??''}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-header">Menu</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=" {{ route('workspace.workspaces') }} " class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Work Space
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('historyboard.historyboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Histroy
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('registryguest.registryguests') }}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Registry Guest
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Setting
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('setting.roles') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.drugs') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Drug Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.medics') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Medical Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.prefix') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Prefix Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.type') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Type Management</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <form method="POST" class="nav-link" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <i class="fas fa-door-open"></i>
                            <p>{{ __('Log Out') }}</p>
                        </a>
                    </form>
                </li>
            </ul>

        </nav>

        <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
</aside>
