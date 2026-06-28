@extends('plantilla.base')

@section('dinamico')
<section class="vm-page-section flex items-center justify-center py-12">
    <div class="w-full max-w-4xl">
        <div class="vm-page-header mb-8">
            <p class="vm-header-tag">Experiencia de Manejo</p>
            <h1 class="vm-header-title">Agendar Prueba de Manejo</h1>
            <p class="vm-header-desc">Vive la experiencia de conducir el vehículo de tus sueños antes de tomar una decisión.</p>
        </div>

        @if(session('cita_guardada'))
            <!-- Confirmación de Cita con Botón de Google Calendar -->
            <div class="vm-card-form border-l-4 border-green-500 bg-white p-8 text-center shadow-md">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-green-600 mb-4">
                    <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Cita Agendada Exitosamente</h2>
                <p class="text-gray-600 mb-6">Tu prueba de manejo del <strong class="text-[#1c69d4]">{{ session('cita_auto') }}</strong> está confirmada.</p>

                <div class="max-w-md mx-auto bg-gray-50 rounded-xl p-4 mb-6 border border-gray-100 text-left text-sm space-y-2">
                    <p><strong class="text-gray-700">Cliente:</strong> {{ session('cita_nombre') }}</p>
                    <p><strong class="text-gray-700">Fecha:</strong> {{ date('d/m/Y', strtotime(session('cita_fecha'))) }}</p>
                    <p><strong class="text-gray-700">Hora:</strong> {{ session('cita_hora') }}</p>
                    <p><strong class="text-gray-700">Ubicación:</strong> Veloce Motors HQ (Paseo de la Reforma 250, CDMX)</p>
                </div>

                @php
                    $fecha = date('Ymd', strtotime(session('cita_fecha')));
                    // Convertimos la hora (e.g. 10:00) a formato HHMMSS
                    $horaStr = str_replace(':', '', session('cita_hora')) . '00';
                    // Hora final (+1 hora para el evento en calendario)
                    $horaFinStr = date('His', strtotime(session('cita_hora') . ' +1 hour'));
                    $datesStr = $fecha . 'T' . $horaStr . '/' . $fecha . 'T' . $horaFinStr;

                    $googleCalUrl = "https://calendar.google.com/calendar/render?action=TEMPLATE"
                        . "&text=" . urlencode("Prueba de Manejo: " . session('cita_auto'))
                        . "&dates=" . $datesStr
                        . "&details=" . urlencode("Prueba de manejo agendada para el cliente " . session('cita_nombre') . " en Veloce Motors HQ. Favor de traer su licencia de conducir vigente.")
                        . "&location=" . urlencode("Veloce Motors HQ, Paseo de la Reforma 250, Ciudad de México")
                        . "&sf=true&output=xml";
                @endphp

                <div class="flex flex-col sm:flex-row justify-center gap-3">
                    <a href="{{ $googleCalUrl }}" target="_blank" class="vm-btn-primary inline-flex items-center justify-center gap-2">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm-5-5H7v-2h7v2z"/>
                        </svg>
                        Guardar en Google Calendar
                    </a>
                    <a href="/" class="vm-btn-secondary inline-flex items-center justify-center">Volver al Inicio</a>
                </div>
            </div>
        @else
            <!-- Formulario de Agendamiento -->
            <div class="grid gap-8 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <div class="vm-card-form">
                        <form action="{{ url('/cliente/cita') }}" method="POST" class="space-y-6">
                            @csrf

                            @if ($errors->any())
                                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                                    <ul class="list-disc pl-5">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="vm-card flex items-center gap-4 mb-6">
                                <div class="h-14 w-24 rounded bg-gray-100 overflow-hidden flex-shrink-0 flex items-center justify-center border border-gray-200">
                                    <span class="text-xs text-[#1c69d4] font-bold tracking-wider">VELOCE</span>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.1em] text-gray-400">Vehículo a probar</p>
                                    <p class="font-bold text-gray-900 text-lg" id="display-auto-nombre">Audi RS 7 Sportback</p>
                                    <input type="hidden" name="vehiculo_nombre" id="input-auto-nombre" value="Audi RS 7 Sportback">
                                </div>
                            </div>

                            <div class="grid gap-6 md:grid-cols-2">
                                <div>
                                    <label for="nombre" class="vm-input-label">Nombre Completo</label>
                                    <input type="text" id="nombre" name="nombre" class="vm-input-text" required value="{{ old('nombre') }}">
                                </div>
                                <div>
                                    <label for="telefono" class="vm-input-label">Teléfono de Contacto</label>
                                    <input type="tel" id="telefono" name="telefono" class="vm-input-text" placeholder="Ej. 5512345678" required value="{{ old('telefono') }}">
                                </div>
                                <div>
                                    <label for="fecha" class="vm-input-label">Fecha Propuesta</label>
                                    <input type="date" id="fecha" name="fecha" min="{{ date('Y-m-d') }}" class="vm-input-text" required value="{{ old('fecha') }}">
                                </div>
                                <div>
                                    <label for="hora" class="vm-input-label">Hora Sugerida</label>
                                    <select id="hora" name="hora" class="vm-input-text" required>
                                        <option value="10:00" @selected(old('hora') == '10:00')>10:00 AM</option>
                                        <option value="11:30" @selected(old('hora') == '11:30')>11:30 AM</option>
                                        <option value="13:00" @selected(old('hora') == '13:00')>01:00 PM</option>
                                        <option value="15:00" @selected(old('hora') == '15:00')>03:00 PM</option>
                                        <option value="16:30" @selected(old('hora') == '16:30')>04:30 PM</option>
                                    </select>
                                </div>
                                <div class="md:col-span-2 rounded-2xl border border-[#1c69d4]/25 bg-[#e8f1ff]/40 p-4">
                                    <div class="mb-3 flex items-center justify-between gap-3">
                                        <p class="text-xs font-black uppercase tracking-widest text-[#1c69d4]">API de comprobacion</p>
                                        <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-gray-600 shadow-sm">Validacion en linea</span>
                                    </div>
                                    <label for="licencia" class="vm-input-label">Número de Licencia de Conducir (Vigente)</label>
                                    <div class="flex gap-2">
                                        <input type="text" id="licencia" name="licencia" placeholder="Ej. A1234567" class="vm-input-text" required value="{{ old('licencia') }}">
                                        <button type="button" id="btn-validar-licencia" class="rounded-xl bg-[#1c69d4] hover:bg-[#1556ad] px-5 py-3 text-sm font-black text-white transition flex-shrink-0">
                                            Comprobar
                                        </button>
                                    </div>
                                    <!-- Estatus de Validación AJAX -->
                                    <div id="licencia-status-container" class="mt-3 rounded-xl border border-gray-200 bg-white p-4 text-sm text-gray-700">
                                        <div class="flex items-center gap-2 font-bold mb-1">
                                            <span id="status-icon">•</span>
                                            <span id="status-text">Licencia sin comprobar</span>
                                        </div>
                                        <p id="status-desc" class="text-xs text-gray-500">Ingresa el numero de licencia y presiona Comprobar para ver el resultado.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col gap-3 border-t border-gray-200 pt-6 sm:flex-row sm:justify-end">
                                <a href="/" class="vm-btn-secondary text-center">Cancelar</a>
                                <button type="submit" id="btn-submit-cita" class="vm-btn-primary">Agendar Cita</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tarjeta de Geolocalización de la Sucursal -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="vm-card">
                        <h3 class="font-bold text-gray-900 text-lg mb-3">Punto de Encuentro</h3>
                        <p class="text-sm text-gray-500 mb-4">La prueba de manejo tiene como punto de partida y retorno nuestra sucursal matriz:</p>

                        <!-- Contenedor del Mapa Leaflet -->
                        <div id="leaflet-map" class="h-64 rounded-xl border border-gray-200 bg-gray-100 z-10"></div>
                        <div class="mt-4 text-xs text-gray-400 space-y-1">
                            <p class="font-bold text-gray-600">Veloce Motors HQ</p>
                            <p>Paseo de la Reforma 250, Juárez,</p>
                            <p>Cuauhtémoc, 06600 Ciudad de México</p>
                            <p class="text-[#1c69d4] mt-2 font-semibold">Horario: Lun - Sáb: 9:00 AM - 6:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Leaflet.js Assets (CSS & JS CDN) -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Obtener auto desde URL params
        const urlParams = new URLSearchParams(window.location.search);
        const auto = urlParams.get('auto');
        if (auto) {
            const decodedAuto = decodeURIComponent(auto);
            const disp = document.getElementById('display-auto-nombre');
            const inp = document.getElementById('input-auto-nombre');
            if(disp) disp.textContent = decodedAuto;
            if(inp) inp.value = decodedAuto;
        }

        // 2. Inicializar Mapa Leaflet
        const mapContainer = document.getElementById('leaflet-map');
        if (mapContainer) {
            // Ubicación aproximada de Paseo de la Reforma 250 (Paseo de la Reforma / Torre Reforma)
            const lat = 19.4272;
            const lng = -99.1676;

            // Crear mapa y centrarlo
            const map = L.map('leaflet-map').setView([lat, lng], 15);

            // Agregar capa de OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Agregar un marcador personalizado
            const marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup("<strong>Veloce Motors HQ</strong><br>Salida de Pruebas de Manejo").openPopup();
        }


        // 3. Validación de Licencia AJAX
        const btnValidar = document.getElementById('btn-validar-licencia');
        const inputLicencia = document.getElementById('licencia');
        const inputNombre = document.getElementById('nombre');
        const statusContainer = document.getElementById('licencia-status-container');
        const statusIcon = document.getElementById('status-icon');
        const statusText = document.getElementById('status-text');
        const statusDesc = document.getElementById('status-desc');

        if (btnValidar && inputLicencia) {
            btnValidar.addEventListener('click', function() {
                const licenciaValue = inputLicencia.value.trim();
                const nombreValue = inputNombre ? inputNombre.value.trim() : '';

                if (!licenciaValue) {
                    alert('Por favor ingrese el número de licencia antes de validar.');
                    return;
                }

                btnValidar.disabled = true;
                btnValidar.textContent = 'Validando...';
                statusContainer.className = "mt-3 rounded-xl border border-[#1c69d4]/30 bg-white p-4 text-sm text-[#003f7d]";
                statusIcon.textContent = '...';
                statusText.textContent = 'Consultando API de licencias';
                statusDesc.textContent = 'Estamos verificando el formato y la vigencia registrada.';

                const appBasePath = @json(request()->getBaseUrl());
                const validarLicenciaUrl = `${appBasePath}/cliente/cita/validar`;
                const csrfToken = document.querySelector('input[name="_token"]').value;

                // Llamada Fetch (AJAX)
                fetch(validarLicenciaUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        licencia: licenciaValue,
                        nombre: nombreValue
                    })
                })
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) {
                        throw data;
                    }
                    return data;
                })
                .then(data => {
                    btnValidar.disabled = false;
                    btnValidar.textContent = 'Comprobar';

                    if (data.success) {
                        if (data.status === 'Vigente') {
                            // Estilo de Licencia Válida (Verde)
                            statusContainer.className = "mt-3 p-4 rounded-xl border border-green-200 bg-green-50 text-green-800";
                            statusIcon.innerHTML = `
                                <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            `;
                            statusText.textContent = 'Licencia Vigente';
                            statusDesc.innerHTML = `<strong>Titular:</strong> ${data.titular}<br><strong>Tipo:</strong> ${data.tipo}<br><strong>Vigencia:</strong> ${data.vigencia}<br><span class="text-xs text-green-600 block mt-1">${data.message}</span>`;
                        } else {
                            // Estilo de Licencia Vencida/Invalida (Naranja)
                            statusContainer.className = "mt-3 p-4 rounded-xl border border-orange-200 bg-orange-50 text-orange-800";
                            statusIcon.innerHTML = `
                                <svg class="h-5 w-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            `;
                            statusText.textContent = 'Atención: Licencia Expirada/Inexistente';
                            statusDesc.innerHTML = `<strong>Detalle:</strong> ${data.message}<br><span class="text-xs text-orange-600 block mt-1">Vigencia reportada: ${data.vigencia}. Necesita renovarla antes de su cita.</span>`;
                        }
                    } else {
                        // Error de formato o similar (Rojo)
                        statusContainer.className = "mt-3 p-4 rounded-xl border border-red-200 bg-red-50 text-red-800";
                        statusIcon.innerHTML = `
                            <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        `;
                        statusText.textContent = 'Licencia Inválida';
                        statusDesc.textContent = data.message;
                    }
                })
                .catch(error => {
                    btnValidar.disabled = false;
                    btnValidar.textContent = 'Comprobar';
                    console.error('Error al validar la licencia:', error);
                    alert('Ocurrió un error en el servidor al intentar validar la licencia de conducir.');
                });
            });
        }
    });
</script>
@endsection
