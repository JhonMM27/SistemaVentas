<div class="modal fade" id="modal-editar-{{ $reg->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditarLabel-{{ $reg->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-3">
            
            <!-- Encabezado del modal -->
            <div class="modal-header bg-warning-subtle text-warning">
                <h5 class="modal-title fw-bold" id="modalEditarLabel-{{ $reg->id }}">
                    <i class="fas fa-edit"></i> Editar Categoría
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <!-- Formulario -->
            <form action="{{ route('categorias.update', ['categoria' => $reg->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Cuerpo del modal -->
                <div class="modal-body py-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nombreCategoria-{{ $reg->id }}" name="nombre" placeholder="Ingrese Categoría" value="{{ $reg->nombre }}" required>
                        <label for="nombreCategoria-{{ $reg->id }}" class="fw-bold">Nombre de la Categoría</label>
                        @error('nombre')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Pie del modal con botones -->
                <div class="modal-footer d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning px-4">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>
