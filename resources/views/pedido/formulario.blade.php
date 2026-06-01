@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-4xl">
        <div class="mb-8 border-l-4 border-white/30 pl-5">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-zinc-300">Nuevo pedido</p>
            <h1 class="mt-3 text-3xl font-black text-white sm:text-4xl">Registrar Pedido</h1>
        </div>

        <div class="rounded-3xl border border-white/10 bg-zinc-950 p-6 shadow-[0_0_45px_rgba(255,255,255,0.10)] sm:p-8">
            <form action="/pedido" method="POST" class="space-y-6">
                @csrf

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="cliente_id" class="mb-2 block text-sm font-bold text-white">Cliente</label>
                        <select id="cliente_id" name="cliente_id" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white" required>
                            <option value="">Selecciona un cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombres }} {{ $cliente->apellidos }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="fecha" class="mb-2 block text-sm font-bold text-white">Fecha</label>
                        <input type="date" id="fecha" name="fecha" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white" required>
                    </div>

                    <div>
                        <label for="descuento" class="mb-2 block text-sm font-bold text-white">Descuento</label>
                        <input type="number" step="0.01" min="0" id="descuento" name="descuento" value="0" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white" required>
                    </div>

                    <div>
                        <label for="iva" class="mb-2 block text-sm font-bold text-white">IVA</label>
                        <input type="number" step="0.01" min="0" id="iva" name="iva" value="0" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white" required>
                    </div>

                    <div>
                        <label for="total" class="mb-2 block text-sm font-bold text-white">Total</label>
                        <input type="number" step="0.01" min="0" id="total" name="total" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white" required>
                    </div>

                    <div>
                        <label for="estado" class="mb-2 block text-sm font-bold text-white">Estado</label>
                        <select id="estado" name="estado" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white" required>
                            <option value="pendiente" selected>Pendiente</option>
                            <option value="confirmado">Confirmado</option>
                            <option value="completado">Completado</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end border-t border-white/10 pt-6">
                    <button type="submit" class="rounded-xl bg-white px-8 py-3 font-black text-black transition hover:bg-zinc-200">Guardar pedido</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
