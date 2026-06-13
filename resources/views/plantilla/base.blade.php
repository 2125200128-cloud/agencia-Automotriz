<!DOCTYPE html>
<html lang="es">

<head>
    @include('plantilla.header')
</head>

<body class="min-h-screen bg-[#090909] text-[#9E9EA2]">
    @include('plantilla.navbar')

    <main>
        @yield('dinamico')
    </main>

    <section
        class="w-full border-y border-[#d8dde6] bg-[#f7f8fa] text-[#1c1f24] shadow-sm"
        aria-label="Informacion de ubicacion, clima y tipo de cambio">
        <div class="mx-auto max-w-7xl px-4 py-3 text-xs sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center justify-center gap-2 sm:justify-between">
                <div class="flex flex-wrap items-center justify-center gap-2">
                    <span class="inline-flex items-center gap-2 rounded-md border border-[#0066b1]/20 bg-white px-2.5 py-1 font-medium text-[#1c1f24]">
                        <svg class="h-4 w-4 text-[#0066b1]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z" />
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                        </svg>
                        <span>Ubicacion:</span>
                        <span id="topbar-location" class="font-semibold text-[#0066b1]">Cargando...</span>
                    </span>

                    <span class="inline-flex items-center gap-2 rounded-md border border-[#81c4ff]/30 bg-white px-2.5 py-1 font-medium text-[#1c1f24]">
                        <svg class="h-4 w-4 text-[#0066b1]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 14.8V5a2 2 0 1 0-4 0v9.8a4 4 0 1 0 4 0Z" />
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 17v-5" />
                        </svg>
                        <span>Temp:</span>
                        <span id="topbar-temperature" class="font-semibold text-[#0066b1]">Cargando...</span>
                    </span>

                    <span class="inline-flex items-center gap-2 rounded-md border border-[#81c4ff]/30 bg-white px-2.5 py-1 font-medium text-[#1c1f24]">
                        <svg class="h-4 w-4 text-[#81c4ff]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a7 7 0 0 0 7-7c0-4.7-7-11-7-11s-7 6.3-7 11a7 7 0 0 0 7 7Z" />
                        </svg>
                        <span>Humedad:</span>
                        <span id="topbar-humidity" class="font-semibold text-[#0066b1]">Cargando...</span>
                    </span>
                </div>

                <div class="flex flex-wrap items-center justify-center gap-2">
                    <span class="inline-flex items-center gap-2 rounded-md border border-[#81c4ff]/30 bg-white px-2.5 py-1 font-medium text-[#1c1f24]">
                        <svg class="h-4 w-4 text-[#81c4ff]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16.5A4.5 4.5 0 0 1 7.5 7.6 6 6 0 0 1 19 10a3.5 3.5 0 0 1-.5 7H7Z" />
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M8 20h.01M12 20h.01M16 20h.01" />
                        </svg>
                        <span>Lluvia:</span>
                        <span id="topbar-rain" class="font-semibold text-[#0066b1]">Cargando...</span>
                    </span>

                    <span class="inline-flex items-center gap-2 rounded-md border border-[#e22718]/20 bg-white px-2.5 py-1 font-medium text-[#1c1f24]">
                        <svg class="h-4 w-4 text-[#e22718]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10m0 0-3-3m3 3-3 3M17 17H7m0 0 3 3m-3-3 3-3" />
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 3v18" />
                        </svg>
                        <span>USD/MXN:</span>
                        <span id="topbar-exchange" class="font-semibold text-[#e22718]">Cargando...</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    @include('plantilla.footer')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const unavailable = 'No disponible';
            const fields = {
                location: document.getElementById('topbar-location'),
                temperature: document.getElementById('topbar-temperature'),
                humidity: document.getElementById('topbar-humidity'),
                rain: document.getElementById('topbar-rain'),
                exchange: document.getElementById('topbar-exchange'),
            };

            const setText = (field, value) => {
                if (fields[field]) {
                    fields[field].textContent = value || unavailable;
                }
            };

            const loadTopbarInfo = async () => {
                try {
                    const response = await fetch(@json(route('topbar.info')), {
                        headers: {
                            Accept: 'application/json',
                        },
                    });

                    if (!response.ok) {
                        throw new Error('Informacion no disponible');
                    }

                    const data = await response.json();
                    setText('location', data.location);
                    setText('temperature', data.temperature);
                    setText('humidity', data.humidity);
                    setText('rain', data.rain);
                    setText('exchange', data.exchange);
                } catch (error) {
                    setText('location', unavailable);
                    setText('temperature', unavailable);
                    setText('humidity', unavailable);
                    setText('rain', unavailable);
                    setText('exchange', unavailable);
                }
            };

            loadTopbarInfo();
        });
    </script>
</body>

</html>
