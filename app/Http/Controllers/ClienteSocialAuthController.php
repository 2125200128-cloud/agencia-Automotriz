<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class ClienteSocialAuthController extends Controller
{
    public function showLogin()
    {
        return view('clientes.login-social');
    }

    public function redirectToGoogle(): RedirectResponse
    {
        if (!$this->googleConfigurado()) {
            return redirect('/cliente/login')->withErrors([
                'google' => 'No se pudo conectar con Google. Intenta nuevamente.',
            ]);
        }

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable) {
            return redirect('/cliente/login')->withErrors([
                'google' => 'No se pudo iniciar sesion con Google. Intenta nuevamente.',
            ]);
        }

        $correo = $googleUser->getEmail();

        if (!$correo) {
            return redirect('/cliente/login')->withErrors([
                'google' => 'Tu cuenta de Google no compartio un correo valido.',
            ]);
        }

        $cliente = Cliente::where('google_id', $googleUser->getId())
            ->orWhere('correo', $correo)
            ->first();

        if (!$cliente) {
            [$nombres, $apellidos] = $this->separarNombre($googleUser->getName() ?: $googleUser->getNickname() ?: 'Cliente Google');

            $cliente = Cliente::create([
                'google_id' => $googleUser->getId(),
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'correo' => $correo,
                'contrasena' => Str::random(32),
                'imagen' => $googleUser->getAvatar(),
                'google_avatar' => $googleUser->getAvatar(),
                'estado' => 'activo',
            ]);
        } else {
            $cliente->google_id = $cliente->google_id ?: $googleUser->getId();
            $cliente->google_avatar = $googleUser->getAvatar();

            if (!$cliente->imagen && $googleUser->getAvatar()) {
                $cliente->imagen = $googleUser->getAvatar();
            }

            $cliente->save();
        }

        if (strtolower(trim((string) $cliente->estado)) !== 'activo') {
            return redirect('/cliente/login')->withErrors([
                'google' => 'Tu cuenta de cliente se encuentra inactiva.',
            ]);
        }

        session([
            'cliente_id' => $cliente->id,
            'cliente_nombre' => trim($cliente->nombres . ' ' . $cliente->apellidos),
            'cliente_correo' => $cliente->correo,
        ]);

        return redirect('/cliente/mis-pedidos')->with('success', 'Sesion iniciada con Google.');
    }

    public function logout(): RedirectResponse
    {
        session()->forget(['cliente_id', 'cliente_nombre', 'cliente_correo']);

        return redirect('/cliente/login')->with('success', 'Sesion de cliente cerrada.');
    }

    private function separarNombre(string $nombreCompleto): array
    {
        $partes = preg_split('/\s+/', trim($nombreCompleto), 2);

        return [$partes[0] ?? 'Cliente', $partes[1] ?? 'Google'];
    }

    private function googleConfigurado(): bool
    {
        return filled(config('services.google.client_id'))
            && filled(config('services.google.client_secret'))
            && filled(config('services.google.redirect'));
    }
}
