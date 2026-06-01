@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-screen-2xl">
        <div class="border-l-4 border-red-500 pl-5">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-red-300">Finanzas</p>
            <h1 class="mt-3 text-4xl font-black text-white sm:text-5xl">Historial de Pagos</h1>
            <p class="mt-3 max-w-2xl text-gray-400">Registro de todos los pagos procesados a través de la plataforma.</p>
        </div>

        <div class="mt-6">
            <a href="/pagos/formulario" class="inline-flex rounded-xl bg-red-600 px-6 py-3 text-sm font-black uppercase tracking-wide text-white transition hover:bg-red-500">Registrar pago</a>
        </div>

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
                        @forelse ($pagos as $pago)
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-6 py-4 font-bold text-white">PAY-{{ str_pad($pago->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4">#ORD-{{ str_pad($pago->pedido_id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4">{{ $pago->pedido?->cliente?->nombres }} {{ $pago->pedido?->cliente?->apellidos }}</td>
                                <td class="px-6 py-4">{{ ucfirst($pago->metodo_pago) }}</td>
                                <td class="px-6 py-4 font-bold text-white">${{ number_format($pago->monto, 2) }}</td>
                                <td class="px-6 py-4 text-gray-400">{{ $pago->fecha_pago->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">{{ ucfirst($pago->estado) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                                    No hay pagos registrados.
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
