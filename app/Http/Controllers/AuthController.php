<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar el inicio de sesión
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required|string|min:6',
        ]);

        // Buscar el usuario por correo
        $usuario = Usuario::where('correo', $request->correo)->first();

        if (!$usuario || !Hash::check($request->contraseña, $usuario->contraseña)) {
            return back()->withErrors(['correo' => 'Las credenciales son incorrectas.'])->withInput();
        }

        // Iniciar sesión manualmente
        Session::put('usuario_id', $usuario->id);
        Session::put('usuario_nombre', $usuario->nombre);

        return redirect()->route('dashboard'); // Redirigir al dashboard
    }

    // Cerrar sesión
    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}
