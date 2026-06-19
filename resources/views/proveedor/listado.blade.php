@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-screen-2xl">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div class="border-l-4 border-red-500 pl-5">
                <p class="text-sm font-semibold uppercase tracking-[0.35em] text-red-300">Proveedores</p>
                <h1 class="mt-3 text-4xl font-black text-white sm:text-5xl">Directorio de Proveedores</h1>
                <p class="mt-3 max-w-2xl text-gray-400">Gestion de red comercial, importadores y servicios aliados del negocio.</p>
            </div>

            <a href="/proveedor/formulario" class="neon-red inline-flex items-center justify-center rounded-xl bg-red-600 px-6 py-3 text-sm font-black uppercase tracking-wide text-white transition hover:bg-red-500">
                + Nuevo Proveedor
            </a>
        </div>

        @if (session('success'))
            <div class="mt-6 rounded-xl border border-green-500/40 bg-green-950/30 p-4 font-bold text-green-200">{{ session('success') }}</div>
        @endif

        <div class="mt-8 overflow-hidden rounded-xl border border-white/10 bg-zinc-950">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-300">
                    <thead class="bg-black text-xs uppercase tracking-wider text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Proveedor</th>
                            <th class="px-6 py-4">Contacto</th>
                            <th class="px-6 py-4">Telefono</th>
                            <th class="px-6 py-4">Correo</th>
                            <th class="px-6 py-4">Estado</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($proveedores as $proveedor)
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-6 py-4 font-bold text-white">{{ $proveedor->nombre }}</td>
                                <td class="px-6 py-4">{{ $proveedor->contacto ?? 'Sin contacto' }}</td>
                                <td class="px-6 py-4">{{ $proveedor->telefono ?? 'Sin telefono' }}</td>
                                <td class="px-6 py-4">{{ $proveedor->correo ?? 'Sin correo' }}</td>
                                <td class="px-6 py-4">
                                    <span class="rounded-full bg-green-500/15 px-3 py-1 text-xs font-bold text-green-300">{{ $proveedor->estado }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="/proveedor/{{ $proveedor->id }}" class="rounded-lg bg-zinc-800 px-3 py-1 text-xs font-bold text-zinc-200 transition hover:bg-zinc-700">Ver</a>
                                        <a href="/proveedor/{{ $proveedor->id }}/editar" class="rounded-lg bg-blue-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-blue-500">Editar</a>
                                        <a href="/proveedor/{{ $proveedor->id }}/eliminar" class="rounded-lg bg-red-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-red-500">Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-400">No hay proveedores registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
