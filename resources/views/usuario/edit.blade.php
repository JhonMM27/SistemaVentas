@extends('layout.app')
@section('contenido')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Editar Usuario</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('usuarios.update', ['usuario' => $registro->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Nombre -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" id="name" name="name" class="form-control" required value="{{ $registro->name }}">
                        <input type="hidden" name="old_name" value="{{ $registro->name }}">
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required value="{{ $registro->email }}">
                        <input type="hidden" name="old_email" value="{{ $registro->email }}">
                    </div>

                    <!-- Contraseña -->
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Contraseña (déjalo vacío si no deseas cambiarla)</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                </div>

                <!-- Sección de Roles y Permisos -->
                <div class="row">
                    <!-- Roles -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header bg-secondary text-white">
                                <strong>Roles</strong>
                            </div>
                            <div class="card-body">
                                @foreach ($roles as $role)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="role_{{ $role->id }}" 
                                            name="roles[]" value="{{ $role->name }}" 
                                            {{ $registro->hasRole($role->name) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Permisos -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header bg-secondary text-white">
                                <strong>Permisos</strong>
                            </div>
                            <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                                @foreach ($permisos as $permiso)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_{{ $permiso->id }}" 
                                            name="permissions[]" value="{{ $permiso->name }}" 
                                            {{ $registro->hasPermissionTo($permiso->name) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="permiso_{{ $permiso->id }}">{{ $permiso->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                
            </form>
        </div>
    </div>
</div>

@endsection
