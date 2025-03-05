<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{route('dashboard')}}" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{asset('img/logo-tiendaa.png')}}" alt="Don Pepe Logo"
                class="brand-image opacity-85 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Don Pepe</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                data-accordion="false">
                @can('venta-crear')
                    
                <li class="nav-item">
                    <a href="{{route('ventas.index')}}" class="nav-link">
                        <i class="nav-icon bi bi-cart"></i> 
                        
                        <p>Ventas</p>
                    </a>
                </li>
                @endcan
                @can('categoria-listar')                    
                <li class="nav-item">
                    <a href="{{route('categorias.index')}}" class="nav-link">
                        <i class="nav-icon bi bi-pencil-square"></i>
                        <p>
                            Categorias
                            
                        </p>
                    </a>
                    
                </li>
                @endcan 
                @can('producto-listar')
                    
                <li class="nav-item">
                    <a href="{{route('productos.index')}}" class="nav-link">
                        <i class="nav-icon bi bi-pencil-square"></i>
                        <p>
                            Productos
                            
                        </p>
                    </a>
                    
                </li>
                @endcan
                @can('usuario-activar' )
                    
                <li class="nav-item">
                    <a href="{{route('usuarios.index')}}" class="nav-link">
                        <i class="nav-icon bi bi-person"></i>
                        <p>
                            Usuarios
                            
                        </p>
                    </a>
                    
                </li>
                @endcan
                @can('reporte-generar')
                    
                <li class="nav-item">
                    <a href="{{route('reportes.index')}}" class="nav-link">
                        <i class="nav-icon bi bi-clipboard-fill"></i>
                        <p>
                            Reportes
                            
                        </p>
                    </a>
                </li>
                @endcan
                
                
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->