<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = DB::table('categorias')->pluck('id', 'nombre');

        $productos = [
            [
                'codigo' => Str::random(10),
                'nombre' => 'Laptop HP Pavilion',
                'precio' => 1500.00,
                'stock' => 10,
                'categoria_id' => $categorias['Laptops y Computadoras'],
            ],
            [
                'codigo' => Str::random(10),
                'nombre' => 'Mouse Inalámbrico Logitech',
                'precio' => 25.99,
                'stock' => 50,
                'categoria_id' => $categorias['Accesorios de Computadora'],
            ],
            [
                'codigo' => Str::random(10),
                'nombre' => 'Teclado Mecánico RGB',
                'precio' => 89.99,
                'stock' => 30,
                'categoria_id' => $categorias['Accesorios de Computadora'],
            ],
            [
                'codigo' => Str::random(10),
                'nombre' => 'Monitor LG 24" Full HD',
                'precio' => 220.50,
                'stock' => 15,
                'categoria_id' => $categorias['Monitores'],
            ],
            [
                'codigo' => Str::random(10),
                'nombre' => 'Impresora Epson EcoTank',
                'precio' => 199.99,
                'stock' => 12,
                'categoria_id' => $categorias['Impresoras y Escáneres'],
            ],
            [
                'codigo' => Str::random(10),
                'nombre' => 'Disco Duro Externo 1TB',
                'precio' => 59.99,
                'stock' => 20,
                'categoria_id' => $categorias['Almacenamiento'],
            ],
            [
                'codigo' => Str::random(10),
                'nombre' => 'Router Wi-Fi 6',
                'precio' => 120.00,
                'stock' => 8,
                'categoria_id' => $categorias['Redes y Conectividad'],
            ],
            [
                'codigo' => Str::random(10),
                'nombre' => 'Licencia Windows 10 Pro',
                'precio' => 149.99,
                'stock' => 100,
                'categoria_id' => $categorias['Software'],
            ],
            [
                'codigo' => Str::random(10),
                'nombre' => 'Smart TV 55" 4K',
                'precio' => 499.99,
                'stock' => 5,
                'categoria_id' => $categorias['Electrónica de Consumo'],
            ],
            [
                'codigo' => Str::random(10),
                'nombre' => 'Silla Gamer Ergonómica',
                'precio' => 299.99,
                'stock' => 7,
                'categoria_id' => $categorias['Gaming'],
            ],
        ];

        // Insertar productos en la base de datos
        DB::table('productos')->insert($productos);
    }
}
