@extends('layout.app')
@section('contenido')
    <div class="app-content mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Usuarios</h3>
                    </div>

                    <div class="card-body table-responsive">
                        <div class="col-md-12">
                            <div class="mb-1.5">
                                @if (Session::has('mensaje'))
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        {{ Session::get('mensaje') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                @if (Session::has('error'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ Session::get('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                            <div class="d-flex align-items-star cold-md-12">

                                <form action="{{ route('usuarios.index') }}" method="GET" class="mb-3 mr-2">
                                    <div class="input-group">
                                        <input type="text" name="texto" class="form-control"
                                            value="{{ $texto }}" placeholder="Ingrese Texto a Buscar">
                                        <div class="input-group-append ms-1.5">
                                            <button class="btn btn-secondary" type="submit"><i
                                                    class="fas fa-search"></i>Buscar</button>
                                        </div>
                                </form>
                            </div>
                            @can('usuario-crear')
                                <div class="ms-2">
                                    <button class="btn btn-primary ml-2" data-bs-toggle="modal"
                                        data-bs-target="#modal-Nuevo">Nuevo</button>
                                </div>
                            @endcan
                        </div>
                        @include('usuario.create')

                        <table class="table table-bordered table-hover table-striped">
                            <thead>
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
                                @if (count($registros) <= 0)
                                    <tr>
                                        <td colspan="6">No hay registros disponibles</td>
                                    </tr>
                                @else
                                {{-- @dd($usuarios->first()); // Verifica que el primer elemento sea un objeto User --}}
                                    @foreach ($registros as $reg)
                                        <tr class="align-middle">
                                            @can('usuario-activar')
                                            <td>
                                                {{-- <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modal-editar-{{ $reg->id }}">&#9998;</button> --}}
                                                <a href="{{route('usuarios.edit',$reg->id)}}" class="btn btn-secondary btn-sm">&#9998</a>
                                                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modal-eliminar-{{ $reg->id }}">&#128465;</button>
                                            </td>
                                            @endcan
                                            {{-- @include('usuario.edit') --}}
                                            <td>{{ $reg->id }}</td>
                                            <td>{{ $reg->name }}</td>
                                            <td>{{ $reg->email }}</td>
                                            <td>
                                                @foreach ($reg->getRoleNames() as $role)
                                                    {{ $role }}
                                                @endforeach
                                            </td>
                                            <td>
                                                <!-- Botón dentro de la tabla para mostrar el modal -->
                                                @php
                                                    $permisos = $reg->getAllPermissions()->pluck('name')->toArray();
                                                    $permisosMostrados = array_slice($permisos, 0, 3); // Muestra solo 3 permisos
                                                @endphp

                                                @foreach ($permisosMostrados as $permiso)
                                                    <span class="badge bg-secondary p-2 fs-6">{{ $permiso }}</span>
                                                @endforeach

                                                @if (count($permisos) > 3)
                                                    <!-- Botón estilizado para abrir el modal -->
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
                    <div class="card-footer clearfix table-responsive">
                        {{ $registros->appends(['texto' => $texto]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
