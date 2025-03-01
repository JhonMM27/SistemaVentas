@extends('layout.app')
@section('contenido')
    <div class="app-content mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Productos</h3>
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

                                <form action="{{ route('productos.index') }}" method="GET" class="mb-3 mr-2">
                                    <div class="input-group">
                                        <input type="text" name="texto" class="form-control" value="{{ $texto }}"
                                            placeholder="Ingrese Texto a Buscar">
                                        <div class="input-group-append ms-1.5">
                                            <button class="btn btn-secondary" type="submit"><i
                                                    class="fas fa-search"></i>Buscar</button>
                                        </div>
                                </form>
                            </div>
                            @can('producto-crear')
                                
                            <div class="ms-2">
                                <button class="btn btn-primary ml-2" data-bs-toggle="modal"
                                data-bs-target="#modal-Nuevo">Nuevo</button>
                            </div>
                            @endcan
                        </div>
                        @include('producto.create')
                        <table class="table table-bordered table-hover table-stripes ">
                            <thead>
                                <tr>
                                    @can('producto-activar')
                                        
                                    <th>Opciones</th>
                                    @endcan
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Codigo</th>
                                    <th>Precio</th>
                                    <th>Categoria</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($registros) <= 0)
                                    <tr>
                                        <td colspan="3">No hay Registros de lo Buscado</td>
                                    </tr>
                                @else
                                    @foreach ($registros as $reg ) 
                                    
                                        <tr class="align-middle">
                                            @can('producto-activar')
                                                
                                            <td>
                                                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modal-editar-{{ $reg->id }}">&#9998</button>
                                                {{-- <a href="{{route('categorias.edit',$reg->id)}}" class="btn btn-secondary btm-sm">&#9998;</a> --}}
                                                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modal-eliminar-{{ $reg->id }}">&#128465;</button>
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
                    <div class="card-footer clearfix table-responsive">
                        {{ $registros->appends(['texto' => $texto]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- @include('categoria.create') --}}
@endsection
