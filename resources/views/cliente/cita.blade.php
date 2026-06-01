@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-12 sm:px-6 lg:px-8 relative overflow-hidden flex items-center justify-center">
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-zinc-800/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="w-full max-w-3xl z-10">
        <div class="mb-10 border-l-4 border-red-500 pl-5">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-red-300">Experiencia de Manejo</p>
            <h1 class="mt-3 text-3xl font-black text-white sm:text-4xl">Agendar Prueba de Manejo</h1>
            <p class="mt-2 text-gray-400">Vive la experiencia de conducir el vehículo de tus sueños antes de tomar una decisión.</p>
        </div>

        <div class="rounded-3xl border border-white/10 bg-zinc-950 p-6 shadow-[0_0_50px_rgba(255,255,255,0.05)] sm:p-8">
            <form action="#" method="POST" class="space-y-6">
                @csrf

                <div class="p-4 rounded-xl border border-white/10 bg-black/60 flex items-center gap-4 mb-6">
                    <div class="h-14 w-24 rounded bg-zinc-900 overflow-hidden flex-shrink-0 flex items-center justify-center">
                        <span class="text-xs text-gray-600 font-bold">Veloce</span>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.1em] text-red-400">Vehículo a probar</p>
                        <p class="font-bold text-white text-lg" id="display-auto-nombre">Audi RS 7 Sportback</p>
                        <input type="hidden" name="vehiculo_nombre" id="input-auto-nombre" value="Audi RS 7 Sportback">
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="nombre" class="mb-2 block text-sm font-bold text-zinc-300">Nombre Completo</label>
                        <input type="text" id="nombre" name="nombre" class="block w-full rounded-xl border border-white/10 bg-black p-3 text-white focus:border-red-500 focus:ring-red-500 transition" required>
                    </div>

                    <div>
                        <label for="telefono" class="mb-2 block text-sm font-bold text-zinc-300">Teléfono de Contacto</label>
                        <input type="tel" id="telefono" name="telefono" class="block w-full rounded-xl border border-white/10 bg-black p-3 text-white focus:border-red-500 focus:ring-red-500 transition" required>
                    </div>

                    <div>
                        <label for="fecha" class="mb-2 block text-sm font-bold text-zinc-300">Fecha Propuesta</label>
                        <input type="date" id="fecha" name="fecha" min="{{ date('Y-m-d') }}" class="block w-full rounded-xl border border-white/10 bg-black p-3 text-white focus:border-red-500 focus:ring-red-500 transition" required>
                    </div>

                    <div>
                        <label for="hora" class="mb-2 block text-sm font-bold text-zinc-300">Hora Sugerida</label>
                        <select id="hora" name="hora" class="block w-full rounded-xl border border-white/10 bg-black p-3 text-white focus:border-red-500 focus:ring-red-500 transition" required>
                            <option value="10:00">10:00 AM</option>
                            <option value="11:30">11:30 AM</option>
                            <option value="13:00">01:00 PM</option>
                            <option value="15:00">03:00 PM</option>
                            <option value="16:30">04:30 PM</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="licencia" class="mb-2 block text-sm font-bold text-zinc-300">Número de Licencia de Conducir (Vigente)</label>
                        <input type="text" id="licencia" name="licencia" placeholder="Ej. A1234567" class="block w-full rounded-xl border border-white/10 bg-black p-3 text-white focus:border-red-500 focus:ring-red-500 transition" required>
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-white/10 pt-6 sm:flex-row sm:justify-end">
                    <a href="/" class="rounded-xl border border-white/15 px-6 py-3 font-bold text-zinc-200 text-center transition hover:border-white/30 hover:text-white">Cancelar</a>
                    <button type="submit" class="neon-red rounded-xl bg-red-600 px-8 py-3 font-black text-white transition hover:bg-red-500">Agendar Cita</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const auto = urlParams.get('auto');
        if (auto) {
            document.getElementById('display-auto-nombre').textContent = decodeURIComponent(auto);
            document.getElementById('input-auto-nombre').value = decodeURIComponent(auto);
        }
    });
</script>
@endsection
