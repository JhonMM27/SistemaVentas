<div class="modal fade" id="modal-eliminar-{{ $reg->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEliminarLabel-{{ $reg->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-3">
            
            <!-- Encabezado del modal -->
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="modalEliminarLabel-{{ $reg->id }}">
                    <i class="fas fa-trash-alt"></i> Eliminar Usuario
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <!-- Formulario -->
            <form action="{{ route('usuarios.destroy', $reg->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <!-- Cuerpo del modal -->
                <div class="modal-body text-center py-3">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                    <p class="fw-bold mb-1">¿Está seguro de eliminar este Usuario?</p>
                    <p class="text-muted">Esta acción no se puede deshacer.</p>
                    <h5 class="fw-bold text-danger">"{{ $reg->name }}"</h5>
                </div>

                <!-- Pie del modal con botones -->
                <div class="modal-footer d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger px-4">Eliminar</button>
                </div>
            </form>

        </div>
    </div>
</div>
