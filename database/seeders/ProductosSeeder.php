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
        $productos = [
            ['codigo' => Str::random(10), 'nombre' => 'Laptop HP', 'precio' => 1500.00, 'stock' => 10, 'categoria_id' => 1],
            ['codigo' => Str::random(10), 'nombre' => 'Mouse Inalámbrico', 'precio' => 25.99, 'stock' => 50, 'categoria_id' => 2],
            ['codigo' => Str::random(10), 'nombre' => 'Teclado Mecánico', 'precio' => 89.99, 'stock' => 30, 'categoria_id' => 2],
            ['codigo' => Str::random(10), 'nombre' => 'Monitor 24"', 'precio' => 220.50, 'stock' => 15, 'categoria_id' => 3],
            ['codigo' => Str::random(10), 'nombre' => 'Impresora Epson', 'precio' => 199.99, 'stock' => 12, 'categoria_id' => 4],
        ];

        
        
        // for ($i = 0; $i < 1000; $i++) {
        //     Producto::create([
        //         'codigo' => Str::random(10),
        //         'nombre' => 'Producto ' . $i,
        //         'precio' => rand(10, 1000),
        //         'stock' => rand(1, 100),
        //         'categoria_id' => rand(1, 5),
        //     ]);
        // }
        DB::table('productos')->insert($productos);
    }
}
