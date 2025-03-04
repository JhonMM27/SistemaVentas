<div class="modal fade" id="modal-editar-{{ $reg->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modalEditarLabel-{{ $reg->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg rounded-3">

            <!-- Encabezado del modal -->
            <div class="modal-header bg-warning text-white">
                <h3 class="modal-title" id="modalEditarLabel-{{ $reg->id }}">Editar Producto</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <form action="{{ route('productos.update', ['producto' => $reg->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $reg->id }}">

                    <div class="row g-3"> <!-- Espaciado entre filas -->
                        <div class="col-md-6">
                            <label for="nombre-{{ $reg->id }}" class="form-label fw-bold">Nombre</label>
                            <input type="text" id="nombre-{{ $reg->id }}" name="nombre" class="form-control" required value="{{ $reg->nombre }}">
                            @error('nombre')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="categoria_id-{{ $reg->id }}" class="form-label fw-bold">Categoría</label>
                            <select id="categoria_id-{{ $reg->id }}" name="categoria_id" class="form-select" required>
                                @foreach ($categorias as $cat)
                                    <option value="{{ $cat->id }}" {{ $reg->categoria_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categoria_id')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="codigo-{{ $reg->id }}" class="form-label fw-bold">Código</label>
                            <input type="text" id="codigo-{{ $reg->id }}" name="codigo" class="form-control" required value="{{ $reg->codigo }}">
                            @error('codigo')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="stock-{{ $reg->id }}" class="form-label fw-bold">Stock</label>
                            <input type="number" id="stock-{{ $reg->id }}" name="stock" class="form-control" min="1" required value="{{ $reg->stock }}">
                            @error('stock')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="precio-{{ $reg->id }}" class="form-label fw-bold">Precio de Venta</label>
                            <input type="text" id="precio-{{ $reg->id }}" name="precio" class="form-control" required value="{{ $reg->precio }}">
                            @error('precio')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="modal-footer mt-4">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
