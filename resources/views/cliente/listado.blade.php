@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-screen-2xl">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div class="border-l-4 border-red-500 pl-5">
                <p class="text-sm font-semibold uppercase tracking-[0.35em] text-red-300">Administracion</p>
                <h1 class="mt-3 text-4xl font-black text-white sm:text-5xl">Buscador de Clientes</h1>
                <p class="mt-3 max-w-2xl text-gray-400">Busca y consulta los clientes registrados en la plataforma.</p>
            </div>

            <a href="/cliente/formulario" class="neon-red inline-flex items-center justify-center rounded-xl bg-red-600 px-6 py-3 text-sm font-black uppercase tracking-wide text-white transition hover:bg-red-500">
                + Nuevo Cliente
            </a>
        </div>

        @if (session('success'))
            <div class="mt-6 rounded-xl border border-green-500/40 bg-green-950/30 p-4 font-bold text-green-200">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="mt-6 rounded-xl border border-red-500/40 bg-red-950/30 p-4 font-bold text-red-200">{{ session('error') }}</div>
        @endif

        <div class="mt-8 overflow-hidden rounded-xl border border-white/10 bg-zinc-950">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-300">
                    <thead class="bg-black text-xs uppercase tracking-wider text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Imagen</th>
                            <th class="px-6 py-4">Cliente</th>
                            <th class="px-6 py-4">Correo</th>
                            <th class="px-6 py-4">Telefono</th>
                            <th class="px-6 py-4">Direccion</th>
                            <th class="px-6 py-4">Estado</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($clientes as $cliente)
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-6 py-4">
                                    @include('plantilla.imagen-tabla', [
                                        'imagen' => $cliente->imagen,
                                        'alt' => $cliente->nombres . ' ' . $cliente->apellidos,
                                    ])
                                </td>
                                <td class="px-6 py-4 font-bold text-white">{{ $cliente->nombres }} {{ $cliente->apellidos }}</td>
                                <td class="px-6 py-4 text-white">{{ $cliente->correo }}</td>
                                <td class="px-6 py-4">{{ $cliente->telefono ?? 'Sin telefono' }}</td>
                                <td class="max-w-[220px] truncate px-6 py-4">{{ $cliente->direccion ?? 'Sin direccion' }}</td>
                                <td class="px-6 py-4">
                                    <span class="rounded-full bg-green-500/15 px-3 py-1 text-xs font-bold text-green-300">{{ $cliente->estado }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="/cliente/{{ $cliente->id }}" class="rounded-lg bg-zinc-800 px-3 py-1 text-xs font-bold text-zinc-200 transition hover:bg-zinc-700">Ver</a>
                                        <a href="/cliente/{{ $cliente->id }}/editar" class="rounded-lg bg-blue-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-blue-500">Editar</a>
                                        <a href="/cliente/{{ $cliente->id }}/eliminar" class="rounded-lg bg-red-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-red-500">Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-400">No hay clientes registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
