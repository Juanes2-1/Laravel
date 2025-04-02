<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function showRegistroForm()
    {
        return view('usuario.registro');
    }

    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required|numeric|unique:usuarios,documento',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'correo' => 'required|email|unique:usuarios,correo',
            'saldoIni' => 'nullable|numeric|min:0',
            'ciudadNa' => 'required|string',
            'contraseña' => 'required|string|min:6',
        ]);

        Usuario::create([
            'documento' => $request->documento,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo,
            'saldoIni' => $request->saldoIni ?? 0,
            'ciudadNa' => $request->ciudadNa,
            'contraseña' => Hash::make($request->contraseña),
        ]);

        return redirect()->route('registro')->with('success', 'Usuario registrado con éxito.');
    }

    public function show(Usuario $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'correo' => 'required|email|unique:usuarios,correo,'.$usuario->id,
            'saldoIni' => 'nullable|numeric|min:0',
            'ciudadNa' => 'required|string',
        ]);

        $usuario->update($request->only(['nombre', 'apellido', 'correo', 'saldoIni', 'ciudadNa']));

        return redirect()->route('usuarios.show', $usuario)->with('success', 'Usuario actualizado con éxito.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito.');
    }

    // ✅ Método para mostrar el formulario de recarga
    public function showRecargaForm()
    {
        return view('usuario.recargar');
    }

    // ✅ Método para procesar la recarga
    public function recargar(Request $request)
    {
        $request->validate([
            'monto' => 'required|numeric|min:1'
        ]);

        $usuario = Auth::user(); // Obtener usuario autenticado
        $usuario->saldoIni += $request->monto;
        

        return redirect()->route('recargar.form')->with('success', 'Recarga exitosa. Tu nuevo saldo es: $' . $usuario->saldoIni);
    }
}
