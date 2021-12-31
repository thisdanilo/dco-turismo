<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light ml-5"><strong>Agência </strong>Turismo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="" class="nav-link ">
                        <i class="fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('bland.index') }}" class="nav-link {{ Ekko::isActiveRoute('bland*') }}">
                        <i class="fas fa-bookmark"></i>
                        <p>Marcas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('plane.index') }}" class="nav-link {{ Ekko::isActiveRoute('plane*') }}">
                        <i class="fas fa-plane"></i>
                        <p>Aviões</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</aside>
