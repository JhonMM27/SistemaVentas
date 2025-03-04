@extends('layout.app')

@section('contenido')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">Registrar Nueva Venta</h2>
            <a href="{{ route('ventas.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver
            </a>
        </div>

        <form action="{{ route('ventas.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <!-- Detalles de Venta -->
            <div class="card shadow mb-4 border-0">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center py-3">
                    <span class="fw-bold fs-5">Productos</span>
                    <button type="button" class="btn btn-primary btn-lg shadow-sm px-4 ms-auto" id="agregarDetalle">
                        <i class="fas fa-cart-plus me-2"></i> Agregar Producto
                    </button>


                </div>
                <div class="card-body">
                    <div id="detallesVenta">
                        <div class="row mb-3 detalle-venta align-items-end">

                            <div id="alerta_stock_0" class="alert alert-danger d-none" role="alert">
                                No hay suficiente stock para el producto seleccionado.
                            </div>

                            <div class="col-md-4">
                                <label for="producto_0" class="form-label fw-bold text-muted">Producto</label>
                                <select name="productos[]" id="producto_0" class="form-select producto" required
                                    onchange="actualizarStock(this)">
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}"
                                            data-stock="{{ $producto->stock }}">
                                            {{ $producto->nombre }} - ${{ $producto->precio }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="cantidad_0" class="form-label fw-bold text-muted">Cantidad</label>
                                <input type="number" name="cantidades[]" id="cantidad_0" class="form-control cantidad"
                                    min="1" required oninput="verificarStock(this)">
                            </div>

                            <div class="col-md-3">
                                <label for="subtotal_0" class="form-label fw-bold text-muted">Subtotal</label>
                                <input type="number" step="0.01" name="subtotales[]" id="subtotal_0"
                                    class="form-control subtotal" readonly>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-detalle w-100">
                                    <i class="fas fa-trash me-2"></i>Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Datos de Boleta/Factura -->
            <div class="card shadow mb-4 border-0">
                <div class="card-header bg-warning text-white py-3">
                    <span class="fw-bold fs-5">Boleta / Factura</span>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="total" class="form-label fw-bold text-muted">Total</label>
                        <input type="number" step="0.01" name="total" id="totalVenta" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="metodo_pago" class="form-label fw-bold text-muted">Método de Pago</label>
                        <select name="metodo_pago" id="metodo_pago" class="form-select" required>
                            <option value="efectivo">Efectivo</option>
                            <option value="tarjeta">Tarjeta</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tipo_comprobante" class="form-label fw-bold text-muted">Tipo de Comprobante</label>
                        <select name="tipo_comprobante" id="tipo_comprobante" class="form-select" required>
                            <option value="boleta">Boleta</option>
                            <option value="factura">Factura</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold fs-5">
                <i class="fas fa-save me-2"></i>Registrar Venta
            </button>
        </form>
    </div>

    <script>
        // Función para actualizar subtotales y total
        function actualizarTotales() {
            let totalVenta = 0;
            document.querySelectorAll('.detalle-venta').forEach((detalle, index) => {
                let cantidad = detalle.querySelector('.cantidad').value || 0;
                let precio = detalle.querySelector('.producto').selectedOptions[0].dataset.precio || 0;
                let subtotal = cantidad * precio;
                detalle.querySelector('.subtotal').value = subtotal.toFixed(2);
                totalVenta += subtotal;
            });
            document.getElementById('totalVenta').value = totalVenta.toFixed(2);
        }

        // Agregar nuevo detalle
        document.getElementById('agregarDetalle').addEventListener('click', function() {
            let original = document.querySelector('.detalle-venta');
            let nuevo = original.cloneNode(true);
            let index = document.querySelectorAll('.detalle-venta').length;

            nuevo.querySelector('.producto').id = `producto_${index}`;
            nuevo.querySelector('.cantidad').id = `cantidad_${index}`;
            nuevo.querySelector('.subtotal').id = `subtotal_${index}`;

            nuevo.querySelector('.cantidad').value = "";
            nuevo.querySelector('.subtotal').value = "";

            nuevo.querySelector('.remove-detalle').addEventListener('click', function() {
                nuevo.remove();
                actualizarTotales();
            });

            nuevo.querySelector('.cantidad').addEventListener('input', actualizarTotales);
            nuevo.querySelector('.producto').addEventListener('change', actualizarTotales);

            document.getElementById('detallesVenta').appendChild(nuevo);
        });

        // Eliminar un detalle
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-detalle')) {
                event.target.closest('.detalle-venta').remove();
                actualizarTotales();
            }
        });

        // Actualizar subtotal al cambiar cantidad o producto
        document.addEventListener('input', function(event) {
            if (event.target.classList.contains('cantidad') || event.target.classList.contains('producto')) {
                actualizarTotales();
            }
        });

        function verificarStock(input) {
            let cantidad = parseInt(input.value) || 0;
            let detalleVenta = input.closest('.detalle-venta');
            let productoSeleccionado = detalleVenta.querySelector('.producto');
            let stockDisponible = parseInt(productoSeleccionado.selectedOptions[0].dataset.stock);
            let alerta = detalleVenta.querySelector('.alert');

            if (cantidad > stockDisponible) {
                alerta.classList.remove("d-none");
            } else {
                alerta.classList.add("d-none");
            }
        }

        function actualizarStock(select) {
            let detalleVenta = select.closest('.detalle-venta');
            let inputCantidad = detalleVenta.querySelector('.cantidad');
            inputCantidad.value = ""; // Reiniciar cantidad al cambiar de producto
            verificarStock(inputCantidad);
        }
    </script>

    <style>
        /* Estilos personalizados */
        .card {
            border-radius: 10px;
        }

        .card-header {
            border-radius: 10px 10px 0 0;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .btn-danger {
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #dc3545;
        }

        .btn-light {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            transition: background-color 0.3s ease;
        }

        .btn-light:hover {
            background-color: #e2e6ea;
        }

        #agregarDetalle {
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        #agregarDetalle:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
    </style>
@endsection
