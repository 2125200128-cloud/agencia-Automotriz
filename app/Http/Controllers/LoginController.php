<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'usuario' => ['required', 'string'],
            'contrasena' => ['required', 'string'],
        ]);

        $admin = Administrador::where('usuario', $request->input('usuario'))->first();

        if ($admin && !$admin->estaActivo()) {
            return back()
                ->withErrors(['status' => 'Esta cuenta se encuentra desactivada.'])
                ->withInput($request->only('usuario'));
        }

        $credenciales = [
            'usuario' => $request->input('usuario'),
            'password' => $request->input('contrasena'),
            'estado' => 'activo',
        ];

        if (Auth::guard('admin')->attempt($credenciales)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()
            ->withErrors(['error' => 'Credenciales incorrectas o cuenta inactiva.'])
            ->withInput($request->only('usuario'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
