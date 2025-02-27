<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $primaryKay = 'id';

    protected $table = 'productos';

    protected $fillable = [
        'codigo',
        'nombre',
        'price',
        'stock',
        'categoria_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
