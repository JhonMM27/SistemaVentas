<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    
    protected $table = 'reportes';

    protected $fillable = [
        'fecha',
        'total_ventas',
        'ingresos_totales',
        'tipo_reporte',
        'datos_adicionales',
        'usuario_id'
    ];

    protected $casts = [
        'fecha' => 'date',
        'datos_adicionales' => 'array'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
