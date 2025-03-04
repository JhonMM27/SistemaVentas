<div class="modal fade" id="modal-eliminar-{{$reg->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEliminarLabel-{{$reg->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-3">

            <!-- Encabezado del modal -->
            <div class="modal-header bg-danger-subtle text-danger">
                <h5 class="modal-title fw-bold" id="modalEliminarLabel-{{$reg->id}}">
                    <i class="fas fa-exclamation-triangle"></i> Confirmar Eliminación
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body text-center py-3">
                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                <p class="fw-bold mb-1">¿Está seguro de eliminar este Producto?</p>
                <p class="text-muted">Esta acción no se puede deshacer.</p>
                <h5 class="fw-bold text-danger">"{{ $reg->nombre }}"</h5>
            </div>

            <!-- Pie del modal con botones -->
            <div class="modal-footer d-flex justify-content-center gap-2">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{route('productos.destroy',$reg->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">Eliminar</button>
                </form>
            </div>

        </div>
    </div>
</div>
