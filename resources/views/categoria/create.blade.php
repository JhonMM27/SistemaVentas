<div class="modal fade" id="modal-Nuevo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Nueva Categoría</h3>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix table-responsive">
                    <form action="{{ route('categorias.store') }}" method="POST">
                        @csrf
                        <div class="card-body table-responsive">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="fw-bold">Nombre</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Ingrese Categoría" name="nombre" required ">
                                @error('nombre')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer table-responsive">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                {{-- <a class="btn btn-secondary" href="{{ route('categorias.index') }}">Regresar</a> --}}
                            </div>
                        </div>


                    </form>
                </div>
            </div>   
            
        </div>
    </div>
</div>

