@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-white px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-5xl">
        <div class="mb-8 border-l-4 border-black pl-5">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-gray-700">Tabla pedido_producto</p>
            <h1 class="mt-3 text-3xl font-black text-black sm:text-4xl">Formulario de Productos Pedido</h1>
            <p class="mt-2 text-gray-400"></p>
        </div>

        <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">
            <form action="/productos-pedido" method="POST" class="space-y-6">
                @csrf

                @if(isset($pedido_id))
                    <input type="hidden" name="pedido_id" value="{{ $pedido_id }}">
                @endif

                <div class="grid gap-6 md:grid-cols-2">
                    @unless(isset($pedido_id))
                        <div>
                            <label for="pedido_id" class="mb-2 block text-sm font-bold text-black">pedido_id</label>
                            <select id="pedido_id" name="pedido_id" class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10">
                                <option value="" selected>Selecciona un pedido</option>
                                @foreach($pedidos ?? [] as $pedido)
                                    <option value="{{ $pedido->id }}">Pedido #{{ $pedido->id }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endunless

                    <div>
                        <label for="producto_id" class="mb-2 block text-sm font-bold text-black">producto_id</label>
                        <select id="producto_id" name="producto_id" class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10">
                            <option value="" selected>Selecciona un producto</option>
                            @foreach($productos ?? [] as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="cantidad" class="mb-2 block text-sm font-bold text-black">cantidad</label>
                        <input type="number" id="cantidad" name="cantidad" class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10">
                    </div>

                    <div>
                        <label for="precio" class="mb-2 block text-sm font-bold text-black">precio</label>
                        <input type="number" step="0.01" id="precio" name="precio" class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10">
                    </div>

                    <div>
                        <label for="descuento" class="mb-2 block text-sm font-bold text-black">descuento</label>
                        <input type="number" step="0.01" id="descuento" name="descuento" class="block w-full rounded-xl border border-gray-200 bg-white p-3 text-black focus:border-black focus:ring-black/10">
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-gray-200 pt-6 sm:flex-row sm:justify-end">
                    <button type="reset" class="rounded-xl border border-gray-200 px-6 py-3 font-bold text-gray-700 transition hover:border-black hover:text-black ">Limpiar</button>
                    <button type="submit" class="rounded-xl bg-black px-8 py-3 font-black text-white transition hover:bg-gray-800">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

