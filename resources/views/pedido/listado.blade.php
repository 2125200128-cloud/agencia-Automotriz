@extends('plantilla.base')

@section('dinamico')
    <section class="min-h-screen bg-white px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-screen-2xl">
            <div class="border-l-4 border-black pl-5">
                <p class="text-sm font-semibold uppercase tracking-[0.35em] text-gray-700">Ventas</p>
                <h1 class="mt-3 text-4xl font-black text-black sm:text-5xl">Gestión de Pedidos</h1>
                <p class="mt-3 max-w-2xl text-gray-400">Consulta y gestiona el estado de las compras realizadas por los
                    clientes.</p>
            </div>

            <div class="mt-6">
                <a href="/pedido/formulario"
                    class="inline-flex rounded-xl bg-black px-6 py-3 text-sm font-black uppercase tracking-wide text-white transition hover:bg-gray-800">Registrar
                    pedido</a>
            </div>

            <div class="mt-8 rounded-xl border border-gray-200 bg-white p-5">
                <div class="grid gap-4 lg:grid-cols-[1fr_200px_200px_auto]">
                    <input type="search" placeholder="Buscar por folio o cliente..."
                        class="w-full rounded-lg border border-gray-200 bg-white p-3 text-black placeholder:text-gray-500 focus:border-black focus:ring-black/10">
                    <select
                        class="rounded-lg border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10">
                        <option>Todos los estados</option>
                        <option>Pendiente</option>
                        <option>Pagado</option>
                        <option>En proceso</option>
                        <option>Entregado</option>
                        <option>Cancelado</option>
                    </select>
                    <select
                        class="rounded-lg border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10">
                        <option>Cualquier fecha</option>
                        <option>Hoy</option>
                        <option>Esta semana</option>
                        <option>Este mes</option>
                    </select>
                    <button
                        class="rounded-lg border border-black px-5 py-3 font-bold text-black transition hover:bg-gray-800 hover:text-white">Filtrar</button>
                </div>
            </div>

            <div class="mt-8 overflow-hidden rounded-xl border border-gray-200 bg-white">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-700">
                        <thead class="border-b border-black bg-white text-xs uppercase tracking-wider text-black">
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
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($pedidos as $pedido)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-bold text-black">
                                        #ORD-{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4 text-gray-400">{{ $pedido->fecha->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4">{{ $pedido->cliente?->nombres }}
                                        {{ $pedido->cliente?->apellidos }}</td>
                                    <td class="px-6 py-4">
                                        {{ $pedido->productos->pluck('nombre')->implode(', ') ?: 'Sin productos' }}</td>
                                    <td class="px-6 py-4 font-bold text-black">${{ number_format($pedido->total, 2) }}</td>
                                    <td class="px-6 py-4">{{ $pedido->pagos->first()?->metodo_pago ?? 'Sin pago' }}</td>
                                    <td class="px-6 py-4">{{ ucfirst($pedido->estado) }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <button type="button"
                                                class="rounded-lg border border-black px-3 py-1 text-xs font-bold text-black transition hover:bg-gray-100">Ver</button>
                                            <button type="button"
                                                class="rounded-lg bg-black px-3 py-1 text-xs font-bold text-white transition hover:bg-gray-800">Editar</button>
                                            <button type="button"
                                                class="rounded-lg border border-black px-3 py-1 text-xs font-bold text-black transition hover:bg-gray-100">Eliminar</button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-10 text-center text-gray-400">
                                        No hay pedidos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
