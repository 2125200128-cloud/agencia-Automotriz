@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section flex items-center justify-center">
        <div class="w-full max-w-3xl">
            <div class="vm-page-header mb-10">
                <p class="vm-header-tag">Experiencia de Manejo</p>
                <h1 class="vm-header-title">Agendar Prueba de Manejo</h1>
                <p class="vm-header-desc">Vive la experiencia de conducir el vehículo de tus sueños antes de tomar una
                    decisión.</p>
            </div>
            <div class="vm-card-form">
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div class="vm-card flex items-center gap-4 mb-6">
                        <div
                            class="h-14 w-24 rounded bg-gray-100 overflow-hidden flex-shrink-0 flex items-center justify-center">
                            <span class="text-xs text-gray-600 font-bold">Veloce</span>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.1em] text-gray-700">Vehículo a probar</p>
                            <p class="font-bold text-black text-lg" id="display-auto-nombre">Audi RS 7 Sportback</p>
                            <input type="hidden" name="vehiculo_nombre" id="input-auto-nombre" value="Audi RS 7 Sportback">
                        </div>
                    </div>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label for="nombre" class="vm-input-label">Nombre Completo</label>
                            <input type="text" id="nombre" name="nombre" class="vm-input-text" required>
                        </div>
                        <div>
                            <label for="telefono" class="vm-input-label">Teléfono de Contacto</label>
                            <input type="tel" id="telefono" name="telefono" class="vm-input-text" required>
                        </div>
                        <div>
                            <label for="fecha" class="vm-input-label">Fecha Propuesta</label>
                            <input type="date" id="fecha" name="fecha" min="{{ date('Y-m-d') }}"
                                class="vm-input-text" required>
                        </div>
                        <div>
                            <label for="hora" class="vm-input-label">Hora Sugerida</label>
                            <select id="hora" name="hora" class="vm-input-text" required>
                                <option value="10:00">10:00 AM</option>
                                <option value="11:30">11:30 AM</option>
                                <option value="13:00">01:00 PM</option>
                                <option value="15:00">03:00 PM</option>
                                <option value="16:30">04:30 PM</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="licencia" class="vm-input-label">Número de Licencia de Conducir (Vigente)</label>
                            <input type="text" id="licencia" name="licencia" placeholder="Ej. A1234567"
                                class="vm-input-text" required>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 border-t border-gray-200 pt-6 sm:flex-row sm:justify-end">
                        <a href="/" class="vm-btn-secondary text-center">Cancelar</a>
                        <button type="submit" class="vm-btn-primary">Agendar Cita</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const auto = urlParams.get('auto');
            if (auto) {
                document.getElementById('display-auto-nombre').textContent = decodeURIComponent(auto);
                document.getElementById('input-auto-nombre').value = decodeURIComponent(auto);
            }
        });
    </script>
@endsection
