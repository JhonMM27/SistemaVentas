@foreach ($registros as $reg)
<div class="modal fade" id="modalPermisos-{{ $reg->id }}" tabindex="-1"
    aria-labelledby="modalPermisosLabel-{{ $reg->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-3">

            <!-- Header del Modal -->
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="modalPermisosLabel-{{ $reg->id }}">
                    Permisos de {{ $reg->name }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Cuerpo del Modal -->
            <div class="modal-body">
                <p class="text-muted">Lista de permisos asignados a este usuario:</p>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($reg->getAllPermissions() as $permiso)
                        <span class="badge bg-secondary p-2 fs-6">{{ $permiso->name }}</span>
                    @endforeach
                </div>
            </div>

            <!-- Footer del Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Cerrar <i class="fas fa-times"></i>
                </button>
            </div>

        </div>
    </div>
</div>
@endforeach