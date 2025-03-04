<div class="modal fade" id="modal-Nuevo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalNuevoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-3">
            
            <!-- Encabezado del modal -->
            <div class="modal-header bg-primary-subtle text-primary">
                <h5 class="modal-title fw-bold" id="modalNuevoLabel">
                    <i class="fas fa-folder-plus"></i> Nueva Categoría
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <!-- Formulario -->
            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf
                
                <!-- Cuerpo del modal -->
                <div class="modal-body py-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nombreCategoria" name="nombre" placeholder="Ingrese Categoría" required>
                        <label for="nombreCategoria" class="fw-bold">Nombre de la Categoría</label>
                        @error('nombre')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Pie del modal con botones -->
                <div class="modal-footer d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary px-4">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>
