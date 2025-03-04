<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    protected $table = 'comprobantes';

    protected $fillable = [
        'tipo',
        'numero',
        'fecha',
        'total',
        'ventas_id',
    ];

    protected $casts = [
        'fecha' => 'date',
        'total' => 'decimal:2',
    ];

    /**
     * Relación con la venta
     */
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'ventas_id');
    }

    /**
     * Genera un número único para el comprobante
     */
    public static function generarNumeroComprobante($tipo)
    {
        $prefijo = $tipo === 'factura' ? 'F' : 'B'; // F para factura, B para boleta
        $ultimoComprobante = self::where('tipo', $tipo)->latest('id')->first();
        $numero = $ultimoComprobante ? intval(substr($ultimoComprobante->numero, 1)) + 1 : 100000;
        return $prefijo . str_pad($numero, 8, "0", STR_PAD_LEFT);
    }

}
