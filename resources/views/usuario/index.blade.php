@extends('layout.app')

@section('contenido')




<div class="app-content mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="card mb-4 shadow-sm border-0 animate__animated animate__fadeIn">
                {{-- Encabezado --}}
                <div class="card-header bg-light text-primary border-bottom border-primary">
                    <h3 class="card-title mb-0 animate__animated animate__fadeInDown">Usuarios</h3>
                </div>

                <div class="card-body table-responsive">
                    <div class="col-md-12">
                        <div class="mb-2">
                            {{-- Mensajes de alerta --}}
                            @if (Session::has('mensaje'))
                                <div class="alert alert-info alert-dismissible fade show animate__animated animate__bounceIn" role="alert">
                                    {{ Session::get('mensaje') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if (Session::has('error'))
                                <div class="alert alert-warning alert-dismissible fade show animate__animated animate__shakeX" role="alert">
                                    {{ Session::get('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        </div>

                        {{-- Barra de búsqueda y botón "Nuevo" --}}
                        <div class="d-flex align-items-center">
                            {{-- Formulario de búsqueda --}}
                            <form action="{{ route('usuarios.index') }}" method="GET" class="d-flex flex-grow-1 me-3">
                                <div class="input-group">
                                    <input type="text" name="texto" class="form-control" value="{{ $texto }}"
                                        placeholder="Buscar usuarios..." style="border-radius: 8px;">
                                    <button class="btn btn-secondary" type="submit" style="border-radius: 8px;">
                                        <i class="fas fa-search"></i> Buscar
                                    </button>
                                </div>
                            </form>

                            {{-- Botón "Nuevo" --}}
                            @can('usuario-crear')
                                <button class="btn btn-primary btn-sm fw-bold d-flex align-items-center shadow-sm animate__animated animate__pulse animate__infinite"
                                    data-bs-toggle="modal" data-bs-target="#modal-Nuevo"
                                    style="border-radius: 8px; padding: 8px 12px;">
                                    <i class="bi bi-plus-circle me-2 fs-5 text-light"></i> Nuevo
                                </button>
                            @endcan
                        </div>
                    </div>

                    @include('usuario.create')


                    {{-- Tabla de usuarios --}}
                    <div class="table-responsive animate__animated animate__fadeInUp mt-3">
                        <table class="table table-bordered table-hover table-striped text-center">
                            <thead class="table-dark">
                                <tr>
                                    @can('usuario-activar')
                                        <th>Opciones</th>
                                    @endcan
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Permisos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($registros->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="bi bi-info-circle fs-4"></i> No hay registros disponibles
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($registros as $reg)
                                        <tr class="align-middle animate__animated animate__fadeInUp">
                                            @can('usuario-activar')
                                                <td>
                                                    {{-- Botón de editar --}}
                                                    <a href="{{ route('usuarios.edit', $reg->id) }}"
                                                        class="btn btn-outline-primary btn-sm animate__animated animate__heartBeat"
                                                        style="border-radius: 8px; padding: 5px 10px;">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>

                                                    {{-- Botón de eliminar --}}
                                                    <button class="btn btn-outline-danger btn-sm animate__animated animate__wobble"
                                                        data-bs-toggle="modal" data-bs-target="#modal-eliminar-{{ $reg->id }}"
                                                        style="border-radius: 8px; padding: 5px 10px;">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>
                                            @endcan
                                            <td>{{ $reg->id }}</td>
                                            <td>{{ $reg->name }}</td>
                                            <td>{{ $reg->email }}</td>
                                            <td>
                                                @foreach ($reg->getRoleNames() as $role)
                                                    <span class="badge bg-success p-2 fs-6">{{ $role }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @php
                                                    $permisos = $reg->getAllPermissions()->pluck('name')->toArray();
                                                    $permisosMostrados = array_slice($permisos, 0, 3);
                                                @endphp

                                                @foreach ($permisosMostrados as $permiso)
                                                    <span class="badge bg-secondary p-2 fs-6">{{ $permiso }}</span>
                                                @endforeach

                                                @if (count($permisos) > 3)
                                                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                                        data-bs-target="#modalPermisos-{{ $reg->id }}">
                                                        Ver más <i class="fas fa-eye"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @include('usuario.permisos')
                                        @include('usuario.delete')
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pie de la tarjeta (Paginación) --}}
                <div class="card-footer bg-light text-center animate__animated animate__fadeInUp">
                    {{ $registros->appends(['texto' => $texto]) }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    document.getElementById('modal-Nuevo').addEventListener('shown.bs.modal', function () {
    this.classList.add('animate__animated', 'animate__fadeInDown');
});

document.getElementById('modal-Nuevo').addEventListener('hidden.bs.modal', function () {
    this.classList.remove('animate__animated', 'animate__fadeInDown');
});

</script> --}}
@endsection
