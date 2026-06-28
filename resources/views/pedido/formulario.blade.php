@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-white px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-4xl">
        <div class="mb-8 border-l-4 border-black pl-5">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-gray-700">Nuevo pedido</p>
            <h1 class="mt-3 text-3xl font-black text-black sm:text-4xl">Registrar Pedido</h1>
        </div>

        <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">
            <form action="/pedido" method="POST" class="space-y-6">
                @csrf

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="cliente_id" class="mb-2 block text-sm font-bold text-black">Cliente</label>
                        <select id="cliente_id" name="cliente_id" class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10" required>
                            <option value="">Selecciona un cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombres }} {{ $cliente->apellidos }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="fecha" class="mb-2 block text-sm font-bold text-black">Fecha</label>
                        <input type="date" id="fecha" name="fecha" value="{{ old('fecha', now()->toDateString()) }}" class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10" required>
                    </div>

                    <div class="md:col-span-2">
                        <label for="producto_id" class="mb-2 block text-sm font-bold text-black">Auto vendido</label>
                        <select id="producto_id" name="producto_id" class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10" required>
                            <option value="">Selecciona el auto que se esta vendiendo</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}" @selected(old('producto_id') == $producto->id)>
                                    {{ $producto->nombre }} / {{ $producto->numero_serie ?? 'Sin serie' }} / ${{ number_format((float) $producto->precio, 2) }} / Existencia: {{ $producto->existencia }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="cantidad" class="mb-2 block text-sm font-bold text-black">Cantidad</label>
                        <input type="number" min="1" id="cantidad" name="cantidad" value="{{ old('cantidad', 1) }}" class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10" required>
                    </div>

                    <div>
                        <label for="descuento" class="mb-2 block text-sm font-bold text-black">Descuento</label>
                        <input type="number" step="0.01" min="0" id="descuento" name="descuento" value="{{ old('descuento', 0) }}" class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10" required>
                    </div>

                    <div>
                        <label for="iva" class="mb-2 block text-sm font-bold text-black">IVA</label>
                        <input type="number" step="0.01" min="0" id="iva" name="iva" value="{{ old('iva', 0) }}" class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10" required>
                    </div>

                    <div>
                        <label for="total" class="mb-2 block text-sm font-bold text-black">Total</label>
                        <input type="number" step="0.01" min="0" id="total" name="total" value="{{ old('total') }}" class="block w-full rounded-xl border border-gray-200 bg-gray-50 p-3 text-black focus:border-black focus:ring-black/10" readonly>
                    </div>

                    <div>
                        <label for="estado" class="mb-2 block text-sm font-bold text-black">Estado</label>
                        <select id="estado" name="estado" class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10" required>
                            <option value="pendiente" selected>Pendiente</option>
                            <option value="confirmado">Confirmado</option>
                            <option value="completado">Completado</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>

                    <div>
                        <label for="metodo_pago" class="mb-2 block text-sm font-bold text-black">Metodo de pago</label>
                        <select id="metodo_pago" name="metodo_pago" class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10" required>
                            <option value="">Selecciona metodo</option>
                            <option value="efectivo" @selected(old('metodo_pago') === 'efectivo')>Efectivo</option>
                            <option value="transferencia" @selected(old('metodo_pago') === 'transferencia')>Transferencia</option>
                            <option value="tarjeta" @selected(old('metodo_pago') === 'tarjeta')>Tarjeta</option>
                            <option value="financiamiento" @selected(old('metodo_pago') === 'financiamiento')>Financiamiento</option>
                        </select>
                    </div>

                    <div>
                        <label for="monto_pago" class="mb-2 block text-sm font-bold text-black">Monto pagado</label>
                        <input type="number" step="0.01" min="0" id="monto_pago" name="monto_pago" value="{{ old('monto_pago') }}" class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10">
                    </div>

                    <div>
                        <label for="estado_pago" class="mb-2 block text-sm font-bold text-black">Estado del pago</label>
                        <select id="estado_pago" name="estado_pago" class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10" required>
                            <option value="pendiente" @selected(old('estado_pago') === 'pendiente')>Pendiente</option>
                            <option value="completado" @selected(old('estado_pago', 'completado') === 'completado')>Completado</option>
                            <option value="cancelado" @selected(old('estado_pago') === 'cancelado')>Cancelado</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end border-t border-gray-200 pt-6">
                    <button type="submit" class="rounded-xl bg-black px-8 py-3 font-black text-white transition hover:bg-gray-800">Guardar pedido</button>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const producto = document.getElementById('producto_id');
        const cantidad = document.getElementById('cantidad');
        const descuento = document.getElementById('descuento');
        const iva = document.getElementById('iva');
        const total = document.getElementById('total');
        const montoPago = document.getElementById('monto_pago');

        const recalcular = function () {
            const option = producto.options[producto.selectedIndex];
            const precio = Number(option?.dataset?.precio || 0);
            const piezas = Number(cantidad.value || 1);
            const desc = Number(descuento.value || 0);
            const impuesto = Number(iva.value || 0);
            const calculado = Math.max(0, (precio * piezas) - desc + impuesto).toFixed(2);

            total.value = calculado;

            if (!montoPago.value) {
                montoPago.value = calculado;
            }
        };

        [producto, cantidad, descuento, iva].forEach(function (campo) {
            campo.addEventListener('input', recalcular);
            campo.addEventListener('change', recalcular);
        });

        recalcular();
    });
</script>
@endsection
