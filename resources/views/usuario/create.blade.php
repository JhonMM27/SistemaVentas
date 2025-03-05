<div class="modal fade" id="modal-Nuevo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalNuevoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg rounded-3">

            <!-- Encabezado del modal -->
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="modalNuevoLabel">Nuevo Usuario</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                    </div>

                    <!-- Sección de Roles y Permisos -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow-sm">
                                <div class="card-header bg-secondary text-white">
                                    <strong>Roles</strong>
                                </div>
                                <div class="card-body">
                                    @foreach ($roles as $role)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->name }}">
                                            <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow-sm">
                                <div class="card-header bg-secondary text-white">
                                    <strong>Permisos</strong>
                                </div>
                                
                                <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                                    @foreach ($permisos as $permiso)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="permiso_{{ $permiso->id }}" name="permissions[]" value="{{ $permiso->name }}">
                                            <label class="form-check-label" for="permiso_{{ $permiso->id }}">{{ $permiso->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botón de Guardar -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("modal-Nuevo");

    modal.addEventListener("show.bs.modal", function () {
        gsap.fromTo(modal, { opacity: 0, y: -50 }, { opacity: 1, y: 0, duration: 0.5 });
    });

    modal.addEventListener("hide.bs.modal", function () {
        gsap.to(modal, { opacity: 0, y: -50, duration: 0.5 });
    });

});

</script>
