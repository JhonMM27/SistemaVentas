@extends('layout.app')

@section('contenido')
<div class="app-content mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Lista de Ventas</h3>
                </div>

                <div class="card-body table-responsive">
                    {{-- Alertas de sesión --}}
                    <div class="col-md-12">
                        @if (Session::has('mensaje'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                {{ Session::get('mensaje') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ Session::get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>

                    {{-- Barra de búsqueda y botón de nueva venta --}}
                    <div class="d-flex align-items-start col-md-12 mb-3">
                        <form action="{{ route('ventas.index') }}" method="GET" class="mb-3 me-2">
                            <div class="input-group">
                                <input type="text" name="texto" class="form-control" value="{{ request('texto') }}" placeholder="Buscar venta">
                                <div class="input-group-append ms-1">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fas fa-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="ms-2">
                            <a href="{{ route('ventas.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Nueva Venta
                            </a>
                        </div>
                    </div>

                    {{-- Tabla de ventas --}}
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($ventas->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">No hay registros de ventas</td>
                                </tr>
                            @else
                                @foreach($ventas as $venta)
                                    <tr class="align-middle">
                                        <td>{{ $venta->id }}</td>
                                        <td>{{ $venta->usuario->name }}</td>
                                        <td>${{ number_format($venta->total, 2) }}</td>
                                        <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-outline-info btn-sm shadow-sm">
                                                <i class="fas fa-eye"></i> Ver
                                            </a>
                                            <button class="btn btn-outline-danger btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar-{{ $venta->id }}">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                    @include('venta.delete')
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                {{-- Paginación --}}
                <div class="card-footer clearfix table-responsive">
                    {{ $ventas->appends(['texto' => request('texto')])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
