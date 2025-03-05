@extends('layout.app')

@section('contenido')


<div class="app-content mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="card mb-4 shadow-sm border-0 animate__animated animate__fadeIn">
                {{-- Encabezado con fondo más suave --}}
                <div class="card-header bg-light text-success border-bottom border-success animate__animated animate__fadeInUp">
                    <h2 class="card-title mb-0 animate__animated animate__fadeInDown">Productos</h2>
                </div>

                <div class="card-body table-responsive">
                    <div class="col-md-12">
                        <div class="mb-2">
                            {{-- Mensajes de alerta --}}
                            @if (Session::has('mensaje'))
                                <div class="alert alert-info alert-dismissible fade show animate__animated animate__bounceIn" role="alert">
                                    <i class="bi bi-info-circle me-2"></i> {{ Session::get('mensaje') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if (Session::has('error'))
                                <div class="alert alert-warning alert-dismissible fade show animate__animated animate__shakeX" role="alert">
                                    <i class="bi bi-exclamation-triangle me-2"></i> {{ Session::get('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        </div>

                        {{-- Barra de búsqueda y botón "Nuevo" --}}
                        <div class="d-flex align-items-center mb-4 animate__animated animate__fadeInLeft">
                            {{-- Formulario de búsqueda --}}
                            <form action="{{ route('productos.index') }}" method="GET" class="d-flex flex-grow-1 me-3">
                                <div class="input-group">
                                    <input type="text" name="texto" class="form-control" value="{{ $texto }}"
                                        placeholder="Buscar productos..." style="border-radius: 8px;">
                                    <button class="btn btn-secondary" type="submit" style="border-radius: 8px;">
                                        <i class="fas fa-search"></i> Buscar
                                    </button>
                                </div>
                            </form>

                            {{-- Botón "Nuevo" --}}
                            @can('producto-crear')
                                <button class="btn btn-primary btn-sm fw-bold d-flex align-items-center shadow-sm animate__animated animate__pulse animate__infinite"
                                    data-bs-toggle="modal" data-bs-target="#modal-Nuevo"
                                    style="border-radius: 8px; padding: 8px 12px;">
                                    <i class="bi bi-plus-circle me-2 fs-5 text-light"></i> Nuevo
                                </button>
                            @endcan
                        </div>
                    </div>

                    {{-- Tabla de productos --}}
                    <div class="table-responsive animate__animated animate__fadeInUp">
                        <table class="table table-bordered table-hover table-striped text-center">
                            <thead class="table-dark">
                                <tr>
                                    @can('producto-activar')
                                        <th style="width: 150px;">Acciones</th>
                                    @endcan
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Precio</th>
                                    <th>Categoría</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($registros) <= 0)
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="bi bi-info-circle fs-4"></i> No hay registros disponibles
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($registros as $reg) 
                                        <tr class="align-middle animate__animated animate__fadeInUp">
                                            @can('producto-activar')
                                                <td>
                                                    {{-- Botón de editar --}}
                                                    <button class="btn btn-outline-primary btn-sm animate__animated animate__heartBeat"
                                                        data-bs-toggle="modal" data-bs-target="#modal-editar-{{ $reg->id }}"
                                                        style="border-radius: 8px; padding: 5px 10px;">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>

                                                    {{-- Botón de eliminar --}}
                                                    <button class="btn btn-outline-danger btn-sm animate__animated animate__wobble"
                                                        data-bs-toggle="modal" data-bs-target="#modal-eliminar-{{ $reg->id }}"
                                                        style="border-radius: 8px; padding: 5px 10px;">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>
                                            @endcan
                                            <td>{{ $reg->id }}</td>
                                            <td>{{ $reg->nombre }}</td>
                                            <td>{{ $reg->codigo }}</td>
                                            <td>{{ $reg->precio }}</td>
                                            <td>{{ $reg->categoria->nombre }}</td>
                                            <td>{{ $reg->stock }}</td>
                                        </tr>
                                        @include('producto.edit')
                                        @include('producto.delete')
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

{{-- Modal para crear nuevo producto --}}
@include('producto.create')

@endsection