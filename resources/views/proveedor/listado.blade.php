@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-screen-2xl">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div class="border-l-4 border-red-500 pl-5">
                <p class="text-sm font-semibold uppercase tracking-[0.35em] text-red-300">Proveedores</p>
                <h1 class="mt-3 text-4xl font-black text-white sm:text-5xl">Directorio de Proveedores</h1>
                <p class="mt-3 max-w-2xl text-gray-400">Gestión de red comercial, importadores y servicios aliados del negocio.</p>
            </div>

            <a href="/proveedor/formulario" class="neon-red inline-flex items-center justify-center rounded-xl bg-red-600 px-6 py-3 text-sm font-black uppercase tracking-wide text-white transition hover:bg-red-500">
                + Nuevo Proveedor
            </a>
        </div>

        <div class="mt-8 overflow-hidden rounded-xl border border-white/10 bg-zinc-950">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-300">
                    <thead class="bg-black text-xs uppercase tracking-wider text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Proveedor</th>
                            <th class="px-6 py-4">Categoría</th>
                            <th class="px-6 py-4">País</th>
                            <th class="px-6 py-4">Contacto</th>
                            <th class="px-6 py-4">Estado</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 font-bold text-white">Tokyo Import Parts</td>
                            <td class="px-6 py-4">Refacciones</td>
                            <td class="px-6 py-4">Japón</td>
                            <td class="px-6 py-4">parts@tokyo.test</td>
                            <td class="px-6 py-4"><span class="rounded-full bg-green-500/15 px-3 py-1 text-xs font-bold text-green-300">Activo</span></td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button class="rounded-lg bg-blue-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-blue-500">Editar</button>
                                    <button class="rounded-lg bg-red-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-red-500">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 font-bold text-white">Elite Detail MX</td>
                            <td class="px-6 py-4">Detallado</td>
                            <td class="px-6 py-4">México</td>
                            <td class="px-6 py-4">contacto@elite.test</td>
                            <td class="px-6 py-4"><span class="rounded-full bg-green-500/15 px-3 py-1 text-xs font-bold text-green-300">Activo</span></td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button class="rounded-lg bg-blue-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-blue-500">Editar</button>
                                    <button class="rounded-lg bg-red-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-red-500">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 font-bold text-white">Apex Auto Logistics</td>
                            <td class="px-6 py-4">Importación</td>
                            <td class="px-6 py-4">Estados Unidos</td>
                            <td class="px-6 py-4">ops@apex.test</td>
                            <td class="px-6 py-4"><span class="rounded-full bg-yellow-500/15 px-3 py-1 text-xs font-bold text-yellow-300">Revisión</span></td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button class="rounded-lg bg-blue-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-blue-500">Editar</button>
                                    <button class="rounded-lg bg-red-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-red-500">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
