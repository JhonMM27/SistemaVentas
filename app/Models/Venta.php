<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $fillable = [
        'total',
        'metodo_pago',
        'user_id',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    /**
     * Relación con el usuario que realizó la venta
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación con los detalles de venta (productos vendidos)
     */
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'ventas_id');
    }

    /**
     * Relación con el comprobante (boleta o factura)
     */
    public function comprobante()
    {
        return $this->hasOne(Comprobante::class, 'ventas_id');
    }
}
