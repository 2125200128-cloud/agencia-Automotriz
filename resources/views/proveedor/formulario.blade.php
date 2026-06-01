@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-8 border-l-4 border-white/30 pl-5 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.35em] text-zinc-300">Nuevo Proveedor</p>
                <h1 class="mt-3 text-3xl font-black text-white sm:text-4xl">Agregar Proveedor</h1>
                <p class="mt-2 text-gray-400">Registra un nuevo contacto comercial o importador en el sistema.</p>
            </div>
            <a href="/proveedor" class="text-sm font-semibold text-zinc-400 hover:text-white transition">Cancelar</a>
        </div>

        <div class="rounded-3xl border border-white/10 bg-zinc-950 p-6 shadow-[0_0_45px_rgba(255,255,255,0.10)] sm:p-8">
            <form action="/proveedor" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-8">
                    <div>
                        <h3 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Información de la Empresa</h3>
                        <div class="grid gap-6 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <label for="nombre_empresa" class="mb-2 block text-sm font-bold text-zinc-300">Nombre de la Empresa</label>
                                <input type="text" id="nombre_empresa" name="nombre_empresa" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition" required>
                            </div>
                            <div>
                                <label for="telefono" class="mb-2 block text-sm font-bold text-zinc-300">Teléfono</label>
                                <input type="tel" id="telefono" name="telefono" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition" required>
                            </div>
                            <div>
                                <label for="email" class="mb-2 block text-sm font-bold text-zinc-300">Correo Electrónico</label>
                                <input type="email" id="email" name="email" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition" required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Representante Legal</h3>
                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label for="nombre_representante" class="mb-2 block text-sm font-bold text-zinc-300">Nombre Completo</label>
                                <input type="text" id="nombre_representante" name="nombre_representante" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition" required>
                            </div>
                            <div>
                                <label for="cargo_representante" class="mb-2 block text-sm font-bold text-zinc-300">Cargo</label>
                                <input type="text" id="cargo_representante" name="cargo_representante" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-white/10 flex items-center justify-end gap-4">
                    <button type="reset" class="px-5 py-2.5 text-sm font-bold text-zinc-400 hover:text-white transition">Limpiar campos</button>
                    <button type="submit" class="rounded-xl bg-white px-8 py-3 font-black text-black transition hover:bg-zinc-200 hover:shadow-[0_0_30px_rgba(255,255,255,0.22)]">Guardar Proveedor</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
