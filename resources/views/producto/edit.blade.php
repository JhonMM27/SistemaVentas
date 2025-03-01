<div class="modal fade" id="modal-editar-{{ $reg->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Editar Producto</h3>
                </div>

                <div class="card-footer clearfix table-responsive">
                    <form action="{{ route('productos.update', ['producto' => $reg->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body table-responsive row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="hidden" name="id" value="{{ $reg->id }}">
                                    <input type="text" name="nombre" class="form-control" required value="{{ $reg->nombre }}">
                                    @error('nombre')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="categoria-id">Seleccione una categoría</label>
                                    <select name="categoria-id" class="form-control" required>
                                        @foreach ($categorias as $cat)
                                            <option value="{{$cat->id}}" {{ $reg->categoria_id == $cat->id ? 'selected' : '' }}>
                                                {{$cat->nombre}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('categoria-id')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="codigo">Ingrese Código</label>
                                    <input type="text" name="codigo" class="form-control" required value="{{ $reg->codigo }}">
                                    @error('codigo')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="stock">Ingrese Stock</label>
                                    <input type="text" name="stock" class="form-control" required value="{{ $reg->stock }}">
                                    @error('stock')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="precio">Ingrese Precio de Venta</label>
                                    <input type="text" name="precio" class="form-control" required value="{{ $reg->precio }}">
                                    @error('precio')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
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
