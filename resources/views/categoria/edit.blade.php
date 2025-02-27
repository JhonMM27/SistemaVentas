<div class="modal fade" id="modal-editar-{{ $reg->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Editar Categoría</h3>
                </div>

                <div class="card-footer clearfix table-responsive">
                    <form action="{{ route('categorias.update', ['categoria' => $reg->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body table-responsive">
                            <div class="form-group">
                                <label for="nombre" class="fw-bold">Nombre</label>
                                <input type="hidden" name="id" value="{{ $reg->id }}">
                                <input type="text" class="form-control" id="nombre"
                                    value="{{ $reg->nombre }}" placeholder="Ingrese Categoría" name="nombre" required>
                                @error('nombre')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer table-responsive">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>   
        </div>
    </div>
</div>
