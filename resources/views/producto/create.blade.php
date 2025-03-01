<div class="modal fade" id="modal-Nuevo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Nuevo Producto</h3>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix table-responsive">
                    <form action="{{route('productos.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nombre">Ingrese Nombre</label>
                                    <input type="text" name="nombre" class="form-control" required>
                                    @error('nombre')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nombre">Seleccione una categoria</label>

                                    <select name="categoria_id" class="form-control" required>
                                        @foreach ($categorias as $cat)
                                        <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                                        @endforeach
                                    </select>

                                    @error('nombre')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nombre">Ingrese Codigo</label>
                                    <input type="text" name="codigo" class="form-control" required>
                                    @error('nombre')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nombre">Ingrese Stock</label>
                                    <input type="text" name="stock" class="form-control" required>
                                    @error('nombre')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nombre">Ingrese Precio de Venta</label>
                                    <input type="text" name="precio" class="form-control" required>
                                    @error('nombre')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button type="submit" name="button"  class="btn btn-primary mt-2">Registrar</button>
                                    <button type="button" class="btn btn-secondary mt-2" data-bs-dismiss="modal">cancelar</button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>   
            
        </div>
    </div>
</div>

