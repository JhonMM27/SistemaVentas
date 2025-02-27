<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $primaryKay = 'id';

    protected $table = 'detalles_ventas';

    protected $fillable = [
        'cantidad',
        'subtotal',
        'ventas_id',
        'productos_id',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'ventas_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'productos_id');
    }
}
