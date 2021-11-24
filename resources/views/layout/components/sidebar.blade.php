<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard.home')}}" class="brand-link">
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
                    <a href="{{route('dashboard.home')}}"
                       class="nav-link @if(Route::current()->getName() == 'dashboard.home')) active @endif">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('dashboard.users')}}"
                       class="nav-link @if(Route::current()->getName() == 'dashboard.users')) active @endif">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Usuários
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('dashboard.customers')}}"
                       class="nav-link @if(Route::current()->getName() == 'dashboard.customers') active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Clientes
                        </p>
                    </a>
                </li>

                <li class="nav-item @if(Route::current()->getPrefix() == 'dashboard/tickets') menu-open @endif">
                    <a href="#"
                       class="nav-link @if(Route::current()->getPrefix() == 'dashboard/tickets') active @endif">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>
                            Tickets
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('dashboard.tickets.open')}}"
                               class="nav-link @if(Route::current()->getName() == 'dashboard.tickets.open')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tickets Abertos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dashboard.tickets.finished')}}"
                               class="nav-link @if(Route::current()->getName() == 'dashboard.tickets.finished')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tickets Finalizados</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('dashboard.tickets.new')}}"
                               class="nav-link @if(Route::current()->getName() == 'dashboard.tickets.new')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Novo Ticket</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('dashboard.tickets.categories')}}"
                               class="nav-link @if(Route::current()->getName() == 'dashboard.tickets.categories')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categorias</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav><!-- /.sidebar-menu -->
    </div><!-- /.sidebar -->
</aside>
