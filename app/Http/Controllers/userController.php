<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function index(Request $request)
    {
        $texto = $request->get('texto');
        // $user = User::with(['roles', 'permissions'])->findOrFail($id);
        $usuarios = User::all();
        $roles = Role::all();
        $permisos = Permission::all();
        $registros = User::where('name', 'LIKE', '%' . $texto . '%')->paginate(10);

        return view('usuario.index', compact(['roles', 'permisos', 'texto', 'registros', 'usuarios']));
    }

    public function create() {}

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
    }



    public function edit($id)
    {
        $registro = User::findOrFail($id);
        $roles = Role::all();
        $permisos = Permission::all();
        return view('usuario.edit', compact(['registro', 'roles', 'permisos']));

        // return view('usuario.edit')->with([
        //     'registro' => $registro,
        //     'roles' => $roles,
        //     'permisos' => $permisos
        // ]);
    }




    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validar los datos
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        // Detectar cambios (si son distintos a los valores originales)
        $registro = [];
        if ($request->name !== $request->old_name) {
            $registro['name'] = $request->name;
        }
        if ($request->email !== $request->old_email) {
            $registro['email'] = $request->email;
        }

        // Si la contraseña es ingresada, la actualiza
        if ($request->filled('password')) {
            $registro['password'] = Hash::make($request->password);
        }

        // Solo actualizar si hay cambios
        if (!empty($registro)) {
            $user->update($registro);
        }

        // Sincroniza roles y permisos
        $user->syncRoles($request->roles ?? []);
        $user->syncPermissions($request->permissions ?? []);

        return redirect()->route('usuarios.index')->with('success', 'Usuario editado correctamente');
    }

    public function destroy($id)
    {
        try {
            $registro = User::findOrFail($id);
            $registro->delete();
            return redirect()->route('usuarios.index')->with('mensaje', 'Usuario ' . $registro->nombre . ' eliminado con exito');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('usuarios.index')->with('error', 'Error al eliminar el Usuario porque esta siendo usado');
        }
    }
}
