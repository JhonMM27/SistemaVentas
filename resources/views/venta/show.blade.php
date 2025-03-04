@extends('layout.app')

@section('contenido')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Detalles de la Venta #{{ $venta->id }}</h2>
        <a href="{{ route('ventas.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Volver
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white py-3">
            <h5 class="fw-bold mb-0">Información de la Venta</h5>
        </div>
        <div class="card-body">
            <p><strong>Usuario:</strong> {{ $venta->usuario->name }}</p>
            <p><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>
            <p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Método de Pago:</strong> {{ ucfirst($venta->metodo_pago) }}</p>
            {{-- @dd($venta)
            <p><strong>Tipo de Comprobante:</strong> {{ ucfirst($venta->tipo_comprobante->nombre) }}</p> --}}
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-warning text-white py-3">
            <h5 class="fw-bold mb-0">Productos Vendidos</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venta->detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>${{ number_format($detalle->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
