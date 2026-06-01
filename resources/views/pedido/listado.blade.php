@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-screen-2xl">
        <div class="border-l-4 border-red-500 pl-5">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-red-300">Ventas</p>
            <h1 class="mt-3 text-4xl font-black text-white sm:text-5xl">Gestión de Pedidos</h1>
            <p class="mt-3 max-w-2xl text-gray-400">Consulta y gestiona el estado de las compras realizadas por los clientes.</p>
        </div>

        {{-- Filtros --}}
        <div class="mt-8 rounded-xl border border-white/10 bg-zinc-950 p-5">
            <div class="grid gap-4 lg:grid-cols-[1fr_200px_200px_auto]">
                <input type="search" placeholder="Buscar por folio o cliente..." class="w-full rounded-lg border border-white/10 bg-black p-3 text-white placeholder:text-gray-500 focus:border-red-500 focus:ring-red-500">
                <select class="rounded-lg border border-white/10 bg-black p-3 text-white focus:border-red-500 focus:ring-red-500">
                    <option>Todos los estados</option>
                    <option>Pendiente</option>
                    <option>Pagado</option>
                    <option>En proceso</option>
                    <option>Entregado</option>
                    <option>Cancelado</option>
                </select>
                <select class="rounded-lg border border-white/10 bg-black p-3 text-white focus:border-red-500 focus:ring-red-500">
                    <option>Cualquier fecha</option>
                    <option>Hoy</option>
                    <option>Esta semana</option>
                    <option>Este mes</option>
                </select>
                <button class="rounded-lg border border-red-500/60 px-5 py-3 font-bold text-red-200 transition hover:bg-red-500 hover:text-white">Filtrar</button>
            </div>
        </div>

        {{-- Tabla de Pedidos --}}
        <div class="mt-8 overflow-hidden rounded-xl border border-white/10 bg-zinc-950">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-300">
                    <thead class="bg-black text-xs uppercase tracking-wider text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Folio</th>
                            <th class="px-6 py-4">Fecha</th>
                            <th class="px-6 py-4">Cliente</th>
                            <th class="px-6 py-4">Vehículo</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4">Método</th>
                            <th class="px-6 py-4">Estado</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        {{-- Ejemplo 1: Pendiente --}}
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 font-bold text-white">#ORD-1024</td>
                            <td class="px-6 py-4 text-gray-400">28/05/2026</td>
                            <td class="px-6 py-4">Carlos Mendoza</td>
                            <td class="px-6 py-4">Toyota Supra MK4</td>
                            <td class="px-6 py-4 font-bold text-white">$1,420,000</td>
                            <td class="px-6 py-4">Tarjeta</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-yellow-500/15 px-3 py-1 text-xs font-bold text-yellow-300">Pendiente</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <select class="rounded-lg border border-white/10 bg-zinc-900 px-2 py-1 text-xs text-white focus:border-red-500 focus:ring-red-500">
                                        <option selected>Pendiente</option>
                                        <option>Pagado</option>
                                        <option>En proceso</option>
                                        <option>Entregado</option>
                                        <option>Cancelado</option>
                                    </select>
                                    <button class="rounded-lg bg-red-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-red-500">Actualizar</button>
                                </div>
                            </td>
                        </tr>
                        {{-- Ejemplo 2: Pagado --}}
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 font-bold text-white">#ORD-1025</td>
                            <td class="px-6 py-4 text-gray-400">27/05/2026</td>
                            <td class="px-6 py-4">Ana Torres</td>
                            <td class="px-6 py-4">Nissan Skyline GT-R R34</td>
                            <td class="px-6 py-4 font-bold text-white">$1,850,000</td>
                            <td class="px-6 py-4">Transferencia</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-green-500/15 px-3 py-1 text-xs font-bold text-green-300">Pagado</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <select class="rounded-lg border border-white/10 bg-zinc-900 px-2 py-1 text-xs text-white focus:border-red-500 focus:ring-red-500">
                                        <option>Pendiente</option>
                                        <option selected>Pagado</option>
                                        <option>En proceso</option>
                                        <option>Entregado</option>
                                        <option>Cancelado</option>
                                    </select>
                                    <button class="rounded-lg bg-red-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-red-500">Actualizar</button>
                                </div>
                            </td>
                        </tr>
                        {{-- Ejemplo 3: Entregado --}}
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 font-bold text-white">#ORD-1026</td>
                            <td class="px-6 py-4 text-gray-400">20/05/2026</td>
                            <td class="px-6 py-4">Luis Rivera</td>
                            <td class="px-6 py-4">Honda Civic Type R</td>
                            <td class="px-6 py-4 font-bold text-white">$980,000</td>
                            <td class="px-6 py-4">Financiamiento</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-blue-500/15 px-3 py-1 text-xs font-bold text-blue-300">Entregado</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <select class="rounded-lg border border-white/10 bg-zinc-900 px-2 py-1 text-xs text-white focus:border-red-500 focus:ring-red-500">
                                        <option>Pendiente</option>
                                        <option>Pagado</option>
                                        <option>En proceso</option>
                                        <option selected>Entregado</option>
                                        <option>Cancelado</option>
                                    </select>
                                    <button class="rounded-lg bg-red-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-red-500">Actualizar</button>
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
