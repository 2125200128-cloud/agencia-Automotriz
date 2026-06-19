@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-screen-2xl">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div class="border-l-4 border-red-500 pl-5">
                <p class="text-sm font-semibold uppercase tracking-[0.35em] text-red-300">Administradores</p>
                <h1 class="mt-3 text-4xl font-black text-white sm:text-5xl">Personal autorizado</h1>
                <p class="mt-3 max-w-2xl text-gray-400">Listado interno para controlar accesos, roles y estado del equipo administrativo.</p>
            </div>

            <a href="/administrador/formulario" class="neon-red inline-flex items-center justify-center rounded-xl bg-red-600 px-6 py-3 text-sm font-black uppercase tracking-wide text-white transition hover:bg-red-500">
                + Agregar
            </a>
        </div>

        <div class="mt-8 grid gap-4 md:grid-cols-4">
            <article class="rounded-xl border border-white/10 bg-zinc-950 p-5">
                <p class="text-sm text-gray-400">Administradores</p>
                <p class="mt-2 text-3xl font-black text-white">{{ $administradores->count() }}</p>
            </article>
            <article class="rounded-xl border border-white/10 bg-zinc-950 p-5">
                <p class="text-sm text-gray-400">Activos</p>
                <p class="mt-2 text-3xl font-black text-green-400">{{ $administradores->where('estado', 'activo')->count() }}</p>
            </article>
            <article class="rounded-xl border border-white/10 bg-zinc-950 p-5">
                <p class="text-sm text-gray-400">Superadmins</p>
                <p class="mt-2 text-3xl font-black text-red-300">{{ $administradores->where('rol', 'superadministrador')->count() }}</p>
            </article>
            <article class="rounded-xl border border-white/10 bg-zinc-950 p-5">
                <p class="text-sm text-gray-400">Inactivos</p>
                <p class="mt-2 text-3xl font-black text-red-400">{{ $administradores->where('estado', 'inactivo')->count() }}</p>
            </article>
        </div>

        <div class="mt-8 rounded-xl border border-white/10 bg-zinc-950 p-5">
            <div class="grid gap-4 lg:grid-cols-[1fr_220px_220px_auto]">
                <input type="search" placeholder="Buscar por nombre, usuario o correo" class="w-full rounded-lg border border-white/10 bg-black p-3 text-white placeholder:text-gray-500 focus:border-red-500 focus:ring-red-500">
                <select class="rounded-lg border border-white/10 bg-black p-3 text-white focus:border-red-500 focus:ring-red-500">
                    <option>Todos los roles</option>
                    <option>Superadministrador</option>
                    <option>Vendedor</option>
                    <option>Capturista</option>
                </select>
                <select class="rounded-lg border border-white/10 bg-black p-3 text-white focus:border-red-500 focus:ring-red-500">
                    <option>Todos los estados</option>
                    <option>Activo</option>
                    <option>Inactivo</option>
                </select>
                <button class="rounded-lg border border-red-500/60 px-5 py-3 font-bold text-red-200 transition hover:bg-red-500 hover:text-white">Filtrar</button>
            </div>
        </div>

        <div class="mt-8 grid gap-5 lg:grid-cols-3">
            @forelse ($administradores->take(3) as $admin)
                <article class="rounded-xl border border-white/10 bg-zinc-950 p-5 transition hover:border-red-500/70">
                    <span class="rounded-full bg-red-500/15 px-3 py-1 text-xs font-bold text-red-300">{{ $admin->rol }}</span>
                    <h2 class="mt-4 text-xl font-black text-white">{{ $admin->nombres }} {{ $admin->apellidos }}</h2>
                    <p class="mt-2 text-gray-400">{{ $admin->correo }}</p>
                    <p class="mt-4 text-sm text-gray-500">Usuario: {{ $admin->usuario }} · {{ $admin->estado }}</p>
                </article>
            @empty
                <p class="text-gray-400">No hay administradores registrados.</p>
            @endforelse
        </div>

        <div class="mt-8 overflow-hidden rounded-xl border border-white/10 bg-zinc-950">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-300">
                    <thead class="bg-black text-xs uppercase tracking-wider text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Imagen</th>
                            <th class="px-6 py-4">Nombre</th>
                            <th class="px-6 py-4">Usuario</th>
                            <th class="px-6 py-4">Correo</th>
                            <th class="px-6 py-4">Rol</th>
                            <th class="px-6 py-4">Estado</th>
                            <th class="px-6 py-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($administradores as $admin)
                            <tr class="border-t border-white/10 hover:bg-white/5">
                                <td class="px-6 py-4">@include('plantilla.imagen-tabla', [
                                    'imagen' => $admin->imagen,
                                    'alt' => $admin->nombres . ' ' . $admin->apellidos,
                                ])</td>
                                <td class="px-6 py-4 font-bold text-white">{{ $admin->nombres }} {{ $admin->apellidos }}</td>
                                <td class="px-6 py-4">{{ $admin->usuario }}</td>
                                <td class="px-6 py-4">{{ $admin->correo }}</td>
                                <td class="px-6 py-4">{{ $admin->rol }}</td>
                                <td class="px-6 py-4"><span class="rounded-full bg-green-500/15 px-3 py-1 text-xs font-bold text-green-300">{{ $admin->estado }}</span></td>
                                <td class="px-6 py-4"><div class="flex gap-2"><a href="/administrador/{{ $admin->id }}" class="rounded-lg bg-zinc-800 px-3 py-1 text-xs font-bold text-zinc-200 transition hover:bg-zinc-700">Ver</a><a href="/administrador/{{ $admin->id }}/editar" class="rounded-lg bg-blue-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-blue-500">Editar</a><a href="/administrador/{{ $admin->id }}/eliminar" class="rounded-lg bg-red-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-red-500">Eliminar</a></div></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-400">No hay administradores registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
