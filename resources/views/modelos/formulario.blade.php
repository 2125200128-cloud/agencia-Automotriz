@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-5xl">
        <div class="mb-8 border-l-4 border-white/30 pl-5">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-zinc-300">Tabla modelos</p>
            <h1 class="mt-3 text-3xl font-black text-white sm:text-4xl">Formulario de Modelos</h1>
            <p class="mt-2 text-gray-400">id es automatico. marca_id se selecciona desde marcas.</p>
        </div>

        <div class="rounded-3xl border border-white/10 bg-zinc-950 p-6 shadow-[0_0_45px_rgba(255,255,255,0.10)] sm:p-8">
            <form action="/modelos" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="marca_id" class="mb-2 block text-sm font-bold text-white">marca_id</label>
                        <select id="marca_id" name="marca_id" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white focus:border-white/30 focus:ring-white/30" required>
                            <option value="" selected>Selecciona una marca</option>
                            @foreach($marcas ?? [] as $marca)
                                <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="nombre" class="mb-2 block text-sm font-bold text-white">nombre</label>
                        <input type="text" id="nombre" name="nombre" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white focus:border-white/30 focus:ring-white/30" required>
                    </div>

                    <div class="md:col-span-2">
                        <label for="imagen" class="mb-2 block text-sm font-bold text-white">imagen</label>
                        <input type="file" id="imagen" name="imagen" accept="image/*" class="block w-full rounded-xl border border-white/10 bg-black/80 p-3 text-white focus:border-white/30 focus:ring-white/30" required>
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

