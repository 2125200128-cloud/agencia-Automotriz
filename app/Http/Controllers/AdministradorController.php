<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdministradorController extends Controller
{
    public function listado()
    {
        $administradores = Administrador::all();

        return view('administradores.inicio', compact('administradores'));
    }

    public function inicio()
    {
        $roles = Administrador::ROLES;
        $estados = Administrador::ESTADOS;

        return view('administradores.formulario', compact('roles', 'estados'));
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'email', 'max:255'],
            'usuario' => ['required', 'string', 'max:255'],
            'contrasena' => ['required', 'string', 'min:6'],
            'imagen' => ['required', 'image', 'max:2048'],
            'rol' => ['required', Rule::in(array_keys(Administrador::ROLES))],
            'estado' => ['required', Rule::in(array_keys(Administrador::ESTADOS))],
        ]);

        $administrador = new Administrador();
        $administrador->nombres = $request->input('nombres');
        $administrador->apellidos = $request->input('apellidos');
        $administrador->correo = $request->input('correo');
        $administrador->usuario = $request->input('usuario');
        $administrador->contrasena = Hash::make($request->input('contrasena'));
        $administrador->rol = $request->input('rol');
        $administrador->estado = $request->input('estado', 'activo');

        $administrador->save();

        if ($request->hasFile('imagen')) {
            $administrador->imagen = $this->guardarImagen($request, $administrador->id);
            $administrador->save();
        }

        return redirect('/administrador')->with('success', 'Administrador guardado exitosamente.');
    }

    public function ver($id)
    {
        $administrador = Administrador::find($id);

        if (!$administrador) {
            abort(404);
        }

        return view('administradores.ver', compact('administrador'));
    }

    public function edit($id)
    {
        $administrador = Administrador::find($id);

        if (!$administrador) {
            abort(404);
        }

        $roles = Administrador::ROLES;
        $estados = Administrador::ESTADOS;

        return view('administradores.editar', compact('administrador', 'roles', 'estados'));
    }

    public function update(Request $request, $id)
    {
        $administrador = Administrador::find($id);

        if (!$administrador) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'email', 'max:255', Rule::unique('administradores', 'correo')->ignore($administrador->id)],
            'usuario' => ['required', 'string', 'max:255', Rule::unique('administradores', 'usuario')->ignore($administrador->id)],
            'contrasena' => ['nullable', 'string', 'min:6'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'rol' => ['required', Rule::in(array_keys(Administrador::ROLES))],
            'estado' => ['required', Rule::in(array_keys(Administrador::ESTADOS))],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $administrador->nombres = $request->input('nombres');
        $administrador->apellidos = $request->input('apellidos');
        $administrador->correo = $request->input('correo');
        $administrador->usuario = $request->input('usuario');
        $administrador->rol = $request->input('rol');
        $administrador->estado = $request->input('estado');

        if ($request->filled('contrasena')) {
            $administrador->contrasena = Hash::make($request->input('contrasena'));
        }

        if ($request->hasFile('imagen')) {
            $imagenAnterior = $administrador->imagen;
            $administrador->imagen = $this->guardarImagen($request, $administrador->id);
            $this->borrarImagen($imagenAnterior, $administrador->imagen);
        }

        $administrador->save();

        return redirect('/administrador')->with('success', 'Administrador actualizado exitosamente.');
    }

    public function eliminar($id)
    {
        $administrador = Administrador::find($id);

        if (!$administrador) {
            abort(404);
        }

        return view('administradores.eliminar', compact('administrador'));
    }

    public function destroy($id)
    {
        $administrador = Administrador::find($id);

        if (!$administrador) {
            abort(404);
        }

        $imagen = $administrador->imagen;
        $administrador->delete();
        $this->borrarImagen($imagen);

        return redirect('/administrador')->with('success', 'Administrador eliminado exitosamente.');
    }

    private function guardarImagen(Request $request, int $id): string
    {
        $archivo = $request->file('imagen');
        $nombre = 'administrador_' . $id . '.' . $archivo->getClientOriginalExtension();

        return $archivo->storeAs('administradores', $nombre, 'public');
    }

    private function borrarImagen(?string $anterior, ?string $nueva = null): void
    {
        if ($anterior && $anterior !== $nueva && Storage::disk('public')->exists($anterior)) {
            Storage::disk('public')->delete($anterior);
        }
    }

    public function citas()
    {
        $citas = Cita::orderBy('fecha', 'desc')->orderBy('hora', 'desc')->get();
        return view('administradores.citas', compact('citas'));
    }

    public function valuador()
    {
        return view('administradores.valuador');
    }

    public function valuarVehiculo(Request $request)
    {
        $request->validate([
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'anio' => 'required|integer|min:1980|max:' . (date('Y') + 1),
            'kilometraje' => 'required|integer|min:0',
            'condicion' => 'required|string|in:excelente,buena,regular,mala',
        ]);

        $marca = $request->input('marca');
        $modelo = $request->input('modelo');
        $anio = (int)$request->input('anio');
        $kilometraje = (int)$request->input('kilometraje');
        $condicion = $request->input('condicion');

        // Algoritmo de valuación realista basado en depreciación
        // Base estimada de precio original
        $precioBase = 450000; // Valor base por defecto
        
        $marcaLower = strtolower($marca);
        if (str_contains($marcaLower, 'audi') || str_contains($marcaLower, 'bmw') || str_contains($marcaLower, 'mercedes')) {
            $precioBase = 850000;
        } elseif (str_contains($marcaLower, 'porsche')) {
            $precioBase = 1500000;
        } elseif (str_contains($marcaLower, 'toyota') || str_contains($marcaLower, 'honda')) {
            $precioBase = 380000;
        } elseif (str_contains($marcaLower, 'nissan') || str_contains($marcaLower, 'chevrolet')) {
            $precioBase = 320000;
        }

        // Depreciación por año (8% anual acumulado)
        $aniosTranscurridos = max(0, date('Y') - $anio);
        $precioDepreciado = $precioBase * pow(0.92, $aniosTranscurridos);

        // Depreciación por kilometraje (3% por cada 20,000 km, máx 40%)
        $depreciacionKm = min(0.40, ($kilometraje / 20000) * 0.03);
        $precioDepreciado = $precioDepreciado * (1 - $depreciacionKm);

        // Multiplicador por condición
        $multiplicadoresCondicion = [
            'excelente' => 1.0,
            'buena' => 0.90,
            'regular' => 0.75,
            'mala' => 0.50,
        ];
        $multiplicador = $multiplicadoresCondicion[$condicion] ?? 0.75;
        $valorFinalCompra = max($precioBase * 0.08, $precioDepreciado * $multiplicador); // Nunca vale menos del 8% de su valor original

        // Calcular rangos
        $valorVentaSugerido = $valorFinalCompra * 1.22; // Margen de ganancia de la agencia de 22%
        $rangoMercadoBajo = $valorVentaSugerido * 0.93;
        $rangoMercadoAlto = $valorVentaSugerido * 1.07;

        return response()->json([
            'success' => true,
            'marca' => $marca,
            'modelo' => $modelo,
            'anio' => $anio,
            'compra_sugerida' => round($valorFinalCompra, 2),
            'venta_sugerida' => round($valorVentaSugerido, 2),
            'rango_bajo' => round($rangoMercadoBajo, 2),
            'rango_alto' => round($rangoMercadoAlto, 2),
            'message' => 'Valuación calculada exitosamente usando nuestro motor de análisis de depreciación Veloce.',
        ]);
    }
}
