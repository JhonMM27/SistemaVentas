@extends('layout.app')

@section('contenido')

    <div class="app-content mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="card shadow-sm border-0 animate__animated animate__fadeIn">
                    {{-- Encabezado de la tarjeta --}}
                    <div
                        class="card-header bg-light text-primary d-flex justify-content-between align-items-center border-bottom border-primary">
                        <h3 class="mb-0 animate__animated animate__fadeInDown">Lista de Categorías</h3>
                    </div>

                    {{-- Cuerpo de la tarjeta --}}
                    <div class="card-body">
                        {{-- Mensajes de alerta --}}
                        @if (Session::has('mensaje'))
                            <div class="alert alert-success alert-dismissible fade show animate__animated animate__bounceIn"
                                role="alert">
                                <i class="bi bi-check-circle"></i> {{ Session::get('mensaje') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show animate__animated animate__shakeX"
                                role="alert">
                                <i class="bi bi-exclamation-triangle"></i> {{ Session::get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- Barra de búsqueda y botón de nueva categoría --}}
                        <div class="d-flex align-items-center mb-4 animate__animated animate__fadeInLeft">
                            {{-- Formulario de búsqueda --}}
                            <form action="{{ route('categorias.index') }}" method="GET" class="d-flex flex-grow-1 me-3">
                                <div class="input-group">
                                    <input type="text" name="texto" class="form-control" value="{{ $texto }}"
                                        placeholder="Buscar categorías..." style="border-radius: 8px;">
                                    <button class="btn btn-secondary" type="submit" style="border-radius: 8px;">
                                        <i class="bi bi-search"></i> Buscar
                                    </button>
                                </div>
                            </form>

                            @can('categoria-crear')
                                {{-- Botón de nueva categoría --}}
                                <button
                                    class="btn btn-light btn-sm fw-bold d-flex align-items-center shadow-sm 
                                    animate__animated animate__pulse animate__infinite"
                                    data-bs-toggle="modal" data-bs-target="#modal-Nuevo"
                                    style="border-radius: 8px; padding: 8px 12px; transition: all 0.3s ease-in-out;">
                                    <i class="bi bi-plus-circle me-2 fs-5 text-primary"></i> Nueva Categoría
                                </button>
                            @endcan
                        </div>

                        {{-- Tabla de Categorías --}}
                        <div class="table-responsive animate__animated animate__fadeInUp">
                            <table class="table table-bordered table-hover text-center">
                                <thead class="table-dark">
                                    <tr>
                                        @can('categoria-crear')
                                            <th style="width: 150px;">Acciones</th>
                                        @endcan

                                        <th>ID</th>
                                        <th>Nombre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($registros) <= 0)
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-4">
                                                <i class="bi bi-info-circle fs-4"></i> No hay registros disponibles
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($registros as $reg)
                                            <tr class="align-middle animate__animated animate__fadeInUp">
                                                @can('categoria-crear')
                                                    <td>
                                                        {{-- Botón de editar --}}
                                                        <button
                                                            class="btn btn-outline-primary btn-sm animate__animated animate__heartBeat"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-editar-{{ $reg->id }}"
                                                            style="border-radius: 8px; padding: 5px 10px;">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>

                                                        {{-- Botón de eliminar --}}
                                                        <button
                                                            class="btn btn-outline-danger btn-sm animate__animated animate__wobble"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-eliminar-{{ $reg->id }}"
                                                            style="border-radius: 8px; padding: 5px 10px;">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                @endcan

                                                <td>{{ $reg->id }}</td>
                                                <td>{{ $reg->nombre }}</td>
                                            </tr>
                                            @include('categoria.edit')
                                            @include('categoria.delete')
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

    {{-- Modal para crear nueva categoría --}}
    @include('categoria.create')

@endsection
