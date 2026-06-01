@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-12 sm:px-6 lg:px-8 relative overflow-hidden flex items-center justify-center">
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-zinc-800/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="w-full max-w-4xl z-10">
        <div class="mb-10 border-l-4 border-red-500 pl-5">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-red-300">Proceso de Compra</p>
            <h1 class="mt-3 text-3xl font-black text-white sm:text-4xl">Completar Solicitud de Compra</h1>
            <p class="mt-2 text-gray-400">Ingresa tus datos de pago y facturación para asegurar el vehículo.</p>
        </div>

        <div class="grid gap-8 lg:grid-cols-[1fr_350px]">
            <div class="rounded-3xl border border-white/10 bg-zinc-950 p-6 shadow-[0_0_50px_rgba(255,255,255,0.05)] sm:p-8">
                <form action="#" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <h3 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Datos Personales</h3>
                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label for="nombre" class="mb-2 block text-sm font-bold text-zinc-300">Nombre Completo</label>
                                <input type="text" id="nombre" name="nombre" class="block w-full rounded-xl border border-white/10 bg-black p-3 text-white focus:border-red-500 focus:ring-red-500 transition" required>
                            </div>
                            <div>
                                <label for="telefono" class="mb-2 block text-sm font-bold text-zinc-300">Teléfono</label>
                                <input type="tel" id="telefono" name="telefono" class="block w-full rounded-xl border border-white/10 bg-black p-3 text-white focus:border-red-500 focus:ring-red-500 transition" required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Método de Adquisición</h3>
                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label for="metodo" class="mb-2 block text-sm font-bold text-zinc-300">Método de Pago</label>
                                <select id="metodo" name="metodo" class="block w-full rounded-xl border border-white/10 bg-black p-3 text-white focus:border-red-500 focus:ring-red-500 transition" required>
                                    <option value="transferencia">Transferencia Bancaria</option>
                                    <option value="financiamiento">Financiamiento / Crédito</option>
                                    <option value="tarjeta">Tarjeta de Crédito / Débito</option>
                                    <option value="efectivo">Pago de Contado en Agencia</option>
                                </select>
                            </div>
                            <div>
                                <label for="enganche" class="mb-2 block text-sm font-bold text-zinc-300">Enganche / Apartado (Mínimo 10%)</label>
                                <input type="number" id="enganche" name="enganche" class="block w-full rounded-xl border border-white/10 bg-black p-3 text-white focus:border-red-500 focus:ring-red-500 transition" required>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 border-t border-white/10 pt-6 sm:flex-row sm:justify-end">
                        <a href="/" class="rounded-xl border border-white/15 px-6 py-3 font-bold text-zinc-200 text-center transition hover:border-white/30 hover:text-white">Cancelar</a>
                        <button type="submit" class="neon-red rounded-xl bg-red-600 px-8 py-3 font-black text-white transition hover:bg-red-500">Enviar Solicitud</button>
                    </div>
                </form>
            </div>

            <!-- Resumen del Vehículo -->
            <div>
                <div class="sticky top-28 rounded-2xl border border-white/10 bg-zinc-950 p-6 shadow-sm">
                    <h3 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Resumen</h3>
                    <div class="space-y-4">
                        <div class="h-40 w-full rounded-xl bg-zinc-900 overflow-hidden flex items-center justify-center">
                            <span class="text-sm text-gray-500 font-bold">Veloce Premium</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-lg" id="display-compra-auto-nombre">Audi RS 7 Sportback</h4>
                            <p class="text-xs text-gray-400 mt-0.5" id="display-compra-auto-tipo">Sedán deportivo</p>
                        </div>
                        <div class="pt-4 border-t border-white/10 flex justify-between items-end">
                            <span class="text-gray-400 text-sm">Precio Total</span>
                            <span class="font-black text-white text-xl" id="display-compra-auto-precio">$1,890,000 MXN</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const auto = urlParams.get('auto');
        const precio = urlParams.get('precio');
        const tipo = urlParams.get('tipo');
        if (auto) {
            document.getElementById('display-compra-auto-nombre').textContent = decodeURIComponent(auto);
        }
        if (precio) {
            document.getElementById('display-compra-auto-precio').textContent = decodeURIComponent(precio);
        }
        if (tipo) {
            document.getElementById('display-compra-auto-tipo').textContent = decodeURIComponent(tipo);
        }
    });
</script>
@endsection
