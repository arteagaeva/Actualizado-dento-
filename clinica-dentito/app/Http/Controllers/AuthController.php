<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AuthController extends Controller
{
    /**
     * Muestra la vista de login.
     */
    public function showLogin()
{
    return view('auth.login'); // Ajusta la ruta de la vista si es necesario
}

    /**
     * Muestra la vista de registro.
     */
    public function showRegister()
{
    return view('auth.register'); // Ajusta la ruta de la vista si es necesario
}

    /**
     * Procesa el inicio de sesión.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $usuario = Usuario::where('Email', $request->email)->first();

        if ($usuario && Hash::check($request->password, $usuario->Contraseña)) {
            Auth::login($usuario);

            return redirect()->route('home.index')->with('success', 'Inicio de sesión exitoso.');
        }

        return back()->withErrors(['error' => 'Credenciales incorrectas.']);
    }

    /**
     * Procesa el registro de un nuevo usuario.
     */
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:usuarios,Email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $usuario = Usuario::create([
            'Email' => $request->email,
            'Contraseña' => Hash::make($request->password),
        ]);

        Auth::login($usuario);

        return redirect()->route('home.index')->with('success', 'Registro exitoso. Bienvenido.');
    }

    /**
     * Cierra sesión.
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}
