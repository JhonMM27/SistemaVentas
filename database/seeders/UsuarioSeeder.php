<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;




class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permisos = [
            'rol-listar',
            'rol-crear',
            'rol-editar',
            'rol-eliminar',
            'usuario-listar',
            'usuario-crear',
            'usuario-editar',
            'usuario-activar',
            'categoria-listar',
            'categoria-crear',
            'categoria-editar',
            'categoria-activar',
            'producto-listar',
            'producto-crear',
            'producto-editar',
            'producto-activar',
            'venta-crear',
            'venta-listar',
            'venta-anular',
            'venta-listar',
            'reporte-generar',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        $adminRole->syncPermissions($permisos);

        $vendedorPermisos = [
            'venta-crear',
            'venta-listar',
            'venta-anular',
            'producto-listar',
        ];

        $vendedorRole = Role::firstOrCreate(['name' => 'Vendedor']);
        $vendedorRole->syncPermissions($vendedorPermisos);

        $usuarios = [
            ['name' => 'Usuario Administrador', 'email' => 'admin@prueba.com', 'password' => 'admin', 'role' => $adminRole],
            ['name' => 'Usuario Vendedor', 'email' => 'vendedor@prueba.com', 'password' => 'vendedor', 'role' => $vendedorRole],
        ];

        foreach ($usuarios as $usuarioData) {
            $user = User::firstOrCreate(
                ['email' => $usuarioData['email']],
                ['name' => $usuarioData['name'], 'password' => Hash::make($usuarioData['password'])]
            );
            $user->assignRole($usuarioData['role']);
        }
    }
}
