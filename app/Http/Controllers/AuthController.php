<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('login.index');
    }
    public function login(Request $request){
        $credenciales = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'El email es obligatorio.',
            'password.required' => 'El password es obligatorio.'
        ]);
        if (Auth::attempt($credenciales)) {
            // Regenerar la sesión para evitar ataques de fijación de sesión
            $request->session()->regenerate();
            // Redirigir al usuario a la ruta deseada (dashboard en este ejemplo)
            return redirect()->intended(route('dashboard'));
        }
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas son incorrectas.',
        ])->onlyInput('email');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }
}
