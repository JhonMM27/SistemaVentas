<div class="modal fade" id="modal-Nuevo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalNuevoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Hacemos el modal más amplio -->
        <div class="modal-content shadow-lg rounded-3"> <!-- Agregamos sombra y bordes redondeados -->
            
            <!-- Encabezado del modal -->
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="modalNuevoLabel">Nuevo Producto</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <form action="{{route('productos.store')}}" method="post">
                    @csrf

                    <div class="row g-3"> <!-- Espaciado entre filas -->

                        <div class="col-md-6">
                            <label for="nombre" class="form-label fw-bold">Nombre del Producto</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required>
                            @error('nombre')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="categoria_id" class="form-label fw-bold">Categoría</label>
                            <select id="categoria_id" name="categoria_id" class="form-select" required>
                                <option value="" disabled selected>Seleccione una categoría</option>
                                @foreach ($categorias as $cat)
                                    <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                                @endforeach
                            </select>
                            @error('categoria_id')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="codigo" class="form-label fw-bold">Código</label>
                            <input type="text" id="codigo" name="codigo" class="form-control" required>
                            @error('codigo')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="stock" class="form-label fw-bold">Stock</label>
                            <input type="number" id="stock" name="stock" class="form-control" min="1" required>
                            @error('stock')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="precio" class="form-label fw-bold">Precio de Venta</label>
                            <input type="text" id="precio" name="precio" class="form-control" required>
                            @error('precio')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                    </div>

                    <!-- Botones de acción -->
                    <div class="modal-footer mt-4">
                        <button type="submit" class="btn btn-success">Registrar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
