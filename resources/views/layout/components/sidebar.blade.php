<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{!! asset('img/logo-b-branca.png') !!}" alt="AdminLTE Logo" class="brand-image"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Cores Mágicas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="/dashboard/home" class="nav-link @if(Route::current()->getName() == 'dashboard/home')) active @endif">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/dashboard/usuarios" class="nav-link @if(Route::current()->getName() == 'dashboard/usuarios')) active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Usuários
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
