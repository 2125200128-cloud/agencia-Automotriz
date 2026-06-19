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
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-16 rounded overflow-hidden bg-zinc-800 flex-shrink-0">
                                    </div>
                                    <div>
                                        <p class="font-bold text-white">Nissan Skyline GT-R R34</p>
                                        <p class="text-xs text-gray-400 mt-0.5">VIN: JNR340001</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">Tokyo Import Parts</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-blue-600"></span>Bayside Blue
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-white">$1,850,000</td>
                            <td class="px-6 py-4 font-bold">1</td>
                            <td class="px-6 py-4"><span class="rounded-full bg-green-500/15 px-3 py-1 text-xs font-bold text-green-300">En Venta</span></td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button class="rounded-lg bg-blue-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-blue-500">Editar</button>
                                    <button class="rounded-lg bg-red-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-red-500">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-16 rounded overflow-hidden bg-zinc-800 flex-shrink-0"></div>
                                    <div>
                                        <p class="font-bold text-white">Toyota Supra MK4</p>
                                        <p class="text-xs text-gray-400 mt-0.5">VIN: JTA800452</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">Tokyo Import Parts</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-white border border-gray-600"></span>Pearl White
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-white">$1,420,000</td>
                            <td class="px-6 py-4 text-red-400 font-bold">0</td>
                            <td class="px-6 py-4"><span class="rounded-full bg-red-500/15 px-3 py-1 text-xs font-bold text-red-300">Agotado</span></td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button class="rounded-lg bg-blue-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-blue-500">Editar</button>
                                    <button class="rounded-lg bg-red-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-red-500">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-16 rounded overflow-hidden bg-zinc-800 flex-shrink-0"></div>
                                    <div>
                                        <p class="font-bold text-white">Mazda RX-7 FD</p>
                                        <p class="text-xs text-gray-400 mt-0.5">VIN: JMFD3S099</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">Elite Detail MX</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-red-600"></span>Candy Red
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-white">$980,000</td>
                            <td class="px-6 py-4 font-bold">2</td>
                            <td class="px-6 py-4"><span class="rounded-full bg-green-500/15 px-3 py-1 text-xs font-bold text-green-300">En Venta</span></td>
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
