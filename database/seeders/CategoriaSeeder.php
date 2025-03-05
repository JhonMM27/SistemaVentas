<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Laptops y Computadoras'],
            ['nombre' => 'Accesorios de Computadora'],
            ['nombre' => 'Monitores'],
            ['nombre' => 'Impresoras y Escáneres'],
            ['nombre' => 'Componentes de PC'],
            ['nombre' => 'Almacenamiento'],
            ['nombre' => 'Redes y Conectividad'],
            ['nombre' => 'Software'],
            ['nombre' => 'Electrónica de Consumo'],
            ['nombre' => 'Gaming'],
        ];

        // Insertar categorías en la base de datos
        Categoria::insert($categorias);
    }
}
