@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-5xl">
        <div class="mb-8 border-l-4 border-white/30 pl-5">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-zinc-300">Tabla productos_pedido</p>
            <h1 class="mt-3 text-3xl font-black text-white sm:text-4xl">Formulario de Productos Pedido</h1>
            <p class="mt-2 text-gray-400"></p>
        </div>

        <div class="rounded-3xl border border-white/10 bg-zinc-950 p-6 shadow-[0_0_45px_rgba(255,255,255,0.10)] sm:p-8">
            <form action="#" method="POST" class="space-y-6">
                @csrf

                @if(isset($pedido_id))
                    <input type="hidden" name="pedido_id" value="{{ $pedido_id }}">
                @endif

                <div class="grid gap-6 md:grid-cols-2">
                    @unless(isset($pedido_id))
                        <div>
                            <label for="pedido_id" class="mb-2 block text-sm font-bold text-white">pedido_id</label>
                            <select id="pedido_id" name="pedido_id" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white focus:border-white/30 focus:ring-white/30">
                                <option value="" selected>Selecciona un pedido</option>
                                @foreach($pedidos ?? [] as $pedido)
                                    <option value="{{ $pedido->id }}">Pedido #{{ $pedido->id }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endunless

                    <div>
                        <label for="producto_id" class="mb-2 block text-sm font-bold text-white">producto_id</label>
                        <select id="producto_id" name="producto_id" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white focus:border-white/30 focus:ring-white/30">
                            <option value="" selected>Selecciona un producto</option>
                            @foreach($productos ?? [] as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="cantidad" class="mb-2 block text-sm font-bold text-white">cantidad</label>
                        <input type="number" id="cantidad" name="cantidad" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white focus:border-white/30 focus:ring-white/30">
                    </div>

                    <div>
                        <label for="precio" class="mb-2 block text-sm font-bold text-white">precio</label>
                        <input type="number" step="0.01" id="precio" name="precio" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white focus:border-white/30 focus:ring-white/30">
                    </div>

                    <div>
                        <label for="descuento" class="mb-2 block text-sm font-bold text-white">descuento</label>
                        <input type="number" step="0.01" id="descuento" name="descuento" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white focus:border-white/30 focus:ring-white/30">
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-white/10 pt-6 sm:flex-row sm:justify-end">
                    <button type="reset" class="rounded-xl border border-white/15 px-6 py-3 font-bold text-zinc-200 transition hover:border-white/30 hover:text-white hover:shadow-[0_0_22px_rgba(255,255,255,0.14)]">Limpiar</button>
                    <button type="submit" class="rounded-xl bg-white px-8 py-3 font-black text-black transition hover:bg-zinc-200 hover:shadow-[0_0_30px_rgba(255,255,255,0.22)]">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection



