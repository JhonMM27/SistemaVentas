<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $primaryKay = 'id';

    protected $table = 'pagos';

    protected $fillable = [
        'metodo_pago',
        'monto',
        'ventas_id',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'ventas_id');
    }
}
