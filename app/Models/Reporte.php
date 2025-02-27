<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    
    protected $table = 'reportes'; 
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'tipo',
        'datos',
    ];

    protected $casts = [
        'datos' => 'array', 
    ];
}
