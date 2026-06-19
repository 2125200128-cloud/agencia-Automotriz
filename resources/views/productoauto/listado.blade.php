@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-screen-2xl">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div class="border-l-4 border-red-500 pl-5">
                <p class="text-sm font-semibold uppercase tracking-[0.35em] text-red-300">Catálogo</p>
                <h1 class="mt-3 text-4xl font-black text-white sm:text-5xl">Inventario de Vehículos</h1>
                <p class="mt-3 max-w-2xl text-gray-400">Gestión de catálogo, existencias y precios de los autos premium.</p>
            </div>

            <a href="/producto/formulario" class="neon-red inline-flex items-center justify-center rounded-xl bg-red-600 px-6 py-3 text-sm font-black uppercase tracking-wide text-white transition hover:bg-red-500">
                + Nuevo Vehículo
            </a>
        </div>

        <div class="mt-8 overflow-hidden rounded-xl border border-white/10 bg-zinc-950">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-300">
                    <thead class="bg-black text-xs uppercase tracking-wider text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Vehículo</th>
                            <th class="px-6 py-4">Proveedor</th>
                            <th class="px-6 py-4">Color</th>
                            <th class="px-6 py-4">Precio</th>
                            <th class="px-6 py-4">Existencia</th>
                            <th class="px-6 py-4">Estado</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($productos as $producto)
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-12 w-20 flex-shrink-0 overflow-hidden rounded bg-zinc-800">
                                            @include('plantilla.imagen-tabla', [
                                                'imagen' => $producto->imagen_principal,
                                                'alt' => $producto->nombre,
                                            ])
                                        </div>
                                        <div>
                                            <p class="font-bold text-white">{{ $producto->nombre }}</p>
                                            <p class="mt-0.5 text-xs text-gray-400">VIN: {{ $producto->numero_serie ?? 'Sin serie' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">{{ $producto->proveedor->nombre ?? 'Sin proveedor' }}</td>
                                <td class="px-6 py-4">{{ $producto->color->nombre ?? 'Sin color' }}</td>
                                <td class="px-6 py-4 font-bold text-white">${{ number_format((float) $producto->precio, 2) }}</td>
                                <td class="px-6 py-4 font-bold">{{ $producto->existencia }}</td>
                                <td class="px-6 py-4">
                                    <span class="rounded-full bg-green-500/15 px-3 py-1 text-xs font-bold text-green-300">{{ $producto->estado }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="/producto/{{ $producto->id }}" class="rounded-lg bg-zinc-800 px-3 py-1 text-xs font-bold text-zinc-200 transition hover:bg-zinc-700">Ver</a>
                                        <a href="/producto/{{ $producto->id }}/editar" class="rounded-lg bg-blue-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-blue-500">Editar</a>
                                        <a href="/producto/{{ $producto->id }}/eliminar" class="rounded-lg bg-red-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-red-500">Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-400">No hay productos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
