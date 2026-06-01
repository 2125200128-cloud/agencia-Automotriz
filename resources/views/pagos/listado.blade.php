@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-screen-2xl">
        <div class="border-l-4 border-red-500 pl-5">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-red-300">Finanzas</p>
            <h1 class="mt-3 text-4xl font-black text-white sm:text-5xl">Historial de Pagos</h1>
            <p class="mt-3 max-w-2xl text-gray-400">Registro de todos los pagos procesados a través de la plataforma.</p>
        </div>

        {{-- Filtros --}}
        <div class="mt-8 rounded-xl border border-white/10 bg-zinc-950 p-5">
            <div class="grid gap-4 lg:grid-cols-[1fr_200px_200px_auto]">
                <input type="search" placeholder="Buscar por pedido, cliente o referencia..." class="w-full rounded-lg border border-white/10 bg-black p-3 text-white placeholder:text-gray-500 focus:border-red-500 focus:ring-red-500">
                <select class="rounded-lg border border-white/10 bg-black p-3 text-white focus:border-red-500 focus:ring-red-500">
                    <option>Todos los métodos</option>
                    <option>Tarjeta</option>
                    <option>Transferencia</option>
                    <option>Financiamiento</option>
                    <option>Efectivo</option>
                </select>
                <select class="rounded-lg border border-white/10 bg-black p-3 text-white focus:border-red-500 focus:ring-red-500">
                    <option>Todos los estados</option>
                    <option>Completado</option>
                    <option>Pendiente</option>
                    <option>Reembolsado</option>
                </select>
                <button class="rounded-lg border border-red-500/60 px-5 py-3 font-bold text-red-200 transition hover:bg-red-500 hover:text-white">Filtrar</button>
            </div>
        </div>

        {{-- Tabla de Pagos --}}
        <div class="mt-8 overflow-hidden rounded-xl border border-white/10 bg-zinc-950">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-300">
                    <thead class="bg-black text-xs uppercase tracking-wider text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Referencia</th>
                            <th class="px-6 py-4">Pedido</th>
                            <th class="px-6 py-4">Cliente</th>
                            <th class="px-6 py-4">Método</th>
                            <th class="px-6 py-4">Monto</th>
                            <th class="px-6 py-4">Fecha</th>
                            <th class="px-6 py-4">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 font-bold text-white">PAY-78A3F</td>
                            <td class="px-6 py-4">#ORD-1025</td>
                            <td class="px-6 py-4">Ana Torres</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="h-2 w-2 rounded-full bg-blue-400"></span>
                                    Transferencia
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-white">$1,850,000</td>
                            <td class="px-6 py-4 text-gray-400">27/05/2026</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-green-500/15 px-3 py-1 text-xs font-bold text-green-300">Completado</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 font-bold text-white">PAY-92D1B</td>
                            <td class="px-6 py-4">#ORD-1024</td>
                            <td class="px-6 py-4">Carlos Mendoza</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="h-2 w-2 rounded-full bg-purple-400"></span>
                                    Tarjeta
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-white">$1,420,000</td>
                            <td class="px-6 py-4 text-gray-400">28/05/2026</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-yellow-500/15 px-3 py-1 text-xs font-bold text-yellow-300">Pendiente</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-white/5 transition opacity-60">
                            <td class="px-6 py-4 font-bold text-white">PAY-45E7C</td>
                            <td class="px-6 py-4">#ORD-1019</td>
                            <td class="px-6 py-4">Luis Rivera</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="h-2 w-2 rounded-full bg-green-400"></span>
                                    Efectivo
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-white">$980,000</td>
                            <td class="px-6 py-4 text-gray-400">12/05/2026</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-red-500/15 px-3 py-1 text-xs font-bold text-red-300">Reembolsado</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
