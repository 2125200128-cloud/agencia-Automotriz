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
                            <select id="cliente_id" name="cliente_id"
                                class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10"
                                required>
                                <option value="">Selecciona un cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombres }} {{ $cliente->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="fecha" class="mb-2 block text-sm font-bold text-black">Fecha</label>
                            <input type="date" id="fecha" name="fecha"
                                class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10"
                                required>
                        </div>

                        <div>
                            <label for="descuento" class="mb-2 block text-sm font-bold text-black">Descuento</label>
                            <input type="number" step="0.01" min="0" id="descuento" name="descuento"
                                value="0"
                                class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10"
                                required>
                        </div>

                        <div>
                            <label for="iva" class="mb-2 block text-sm font-bold text-black">IVA</label>
                            <input type="number" step="0.01" min="0" id="iva" name="iva" value="0"
                                class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10"
                                required>
                        </div>

                        <div>
                            <label for="total" class="mb-2 block text-sm font-bold text-black">Total</label>
                            <input type="number" step="0.01" min="0" id="total" name="total"
                                class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10"
                                required>
                        </div>

                        <div>
                            <label for="estado" class="mb-2 block text-sm font-bold text-black">Estado</label>
                            <select id="estado" name="estado"
                                class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10"
                                required>
                                <option value="pendiente" selected>Pendiente</option>
                                <option value="confirmado">Confirmado</option>
                                <option value="completado">Completado</option>
                                <option value="cancelado">Cancelado</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end border-t border-gray-200 pt-6">
                        <button type="submit"
                            class="rounded-xl bg-black px-8 py-3 font-black text-white transition hover:bg-gray-800">Guardar
                            pedido</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
