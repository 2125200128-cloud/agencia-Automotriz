@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-4xl">
        <div class="mb-8 border-l-4 border-white/30 pl-5">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-zinc-300">Nuevo pago</p>
            <h1 class="mt-3 text-3xl font-black text-white sm:text-4xl">Registrar Pago</h1>
        </div>

        <div class="rounded-3xl border border-white/10 bg-zinc-950 p-6 shadow-[0_0_45px_rgba(255,255,255,0.10)] sm:p-8">
            <form action="/pagos" method="POST" class="space-y-6">
                @csrf

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="pedido_id" class="mb-2 block text-sm font-bold text-white">Pedido</label>
                        <select id="pedido_id" name="pedido_id" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white" required>
                            <option value="">Selecciona un pedido</option>
                            @foreach ($pedidos as $pedido)
                                <option value="{{ $pedido->id }}">Pedido #{{ $pedido->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="metodo_pago" class="mb-2 block text-sm font-bold text-white">Metodo de pago</label>
                        <select id="metodo_pago" name="metodo_pago" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white" required>
                            <option value="efectivo">Efectivo</option>
                            <option value="transferencia">Transferencia</option>
                            <option value="tarjeta">Tarjeta</option>
                        </select>
                    </div>

                    <div>
                        <label for="monto" class="mb-2 block text-sm font-bold text-white">Monto</label>
                        <input type="number" step="0.01" min="0" id="monto" name="monto" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white" required>
                    </div>

                    <div>
                        <label for="fecha_pago" class="mb-2 block text-sm font-bold text-white">Fecha del pago</label>
                        <input type="date" id="fecha_pago" name="fecha_pago" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white" required>
                    </div>

                    <div>
                        <label for="estado" class="mb-2 block text-sm font-bold text-white">Estado</label>
                        <select id="estado" name="estado" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white" required>
                            <option value="pendiente">Pendiente</option>
                            <option value="completado" selected>Completado</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end border-t border-white/10 pt-6">
                    <button type="submit" class="rounded-xl bg-white px-8 py-3 font-black text-black transition hover:bg-zinc-200">Guardar pago</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
