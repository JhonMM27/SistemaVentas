<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="{{ route('dashboard') }}" class="nav-link">Inicio</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contacto</a></li>
        </ul>
        <!--end::Start Navbar Links-->
        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path
                            d="M12 2.5a5.25 5.25 0 0 0-2.519 9.857 9.005 9.005 0 0 0-6.477 8.37.75.75 0 0 0 .727.773H20.27a.75.75 0 0 0 .727-.772 9.005 9.005 0 0 0-6.477-8.37A5.25 5.25 0 0 0 12 2.5Z">
                        </path>
                    </svg>
                    <span class="d-none d-md-inline ms-2">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg rounded-3">
                    <!--begin::User Image-->
                    <li class="user-header text-bg-primary p-3 text-center rounded-top">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48"
                            class="mb-2">
                            <path
                                d="M12 2.5a5.25 5.25 0 0 0-2.519 9.857 9.005 9.005 0 0 0-6.477 8.37.75.75 0 0 0 .727.773H20.27a.75.75 0 0 0 .727-.772 9.005 9.005 0 0 0-6.477-8.37A5.25 5.25 0 0 0 12 2.5Z">
                            </path>
                        </svg>
                        <p class="fw-bold mb-0">{{ Auth::user()->name }}</p>
                    </li>

                    <!--begin::Menu Footer-->
                    <li class="user-footer d-flex justify-content-between p-3">
                        <a href="#" class="btn btn-outline-primary w-50">Perfil</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="btn btn-outline-danger w-50 ms-2">
                            Cerrar Sesión
                        </a>
                    </li>
                    <!--end::Menu Footer-->
                </ul>
            </li>
            <!--end::User Menu Dropdown-->

        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
<!--end::Header-->
