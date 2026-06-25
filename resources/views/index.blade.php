@extends('plantilla.base')

@section('dinamico')
<section class="vm-page-section">
    <div class="vm-container-2xl">
        <div class="grid gap-8 lg:grid-cols-[0.95fr_1.05fr] lg:items-center">
            <div>
                <div class="mb-6 flex h-24 w-24 items-center justify-center overflow-hidden rounded-full border border-[#2f3d4f] bg-[#0f141b] shadow-[0_0_18px_rgba(28,105,212,0.18)]">
                    <img src="{{ asset('imagenes/logovelocemotor.png') }}" alt="Logo Veloce Motors" class="h-full w-full object-cover">
                </div>
                <p class="vm-header-tag">Veloce Motors</p>
                <h1 class="vm-header-title">Encuentra el auto que va contigo</h1>
                <p class="vm-header-desc mt-4">
                    Vehiculos seleccionados, atencion personalizada y seguimiento digital para comprar con confianza desde el primer vistazo.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('cliente.login') }}" class="flex items-center justify-center gap-3 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-black text-black transition hover:border-[#1c69d4] hover:bg-[#f7fbff]">
                        <span class="flex h-6 w-6 items-center justify-center rounded-full border border-gray-200 text-xs font-black text-[#1c69d4]">G</span>
                        Iniciar con Google
                    </a>
                    <a href="{{ route('cliente.cita') }}" class="vm-btn-primary text-center">Agendar prueba</a>
                </div>
            </div>

            <div class="grid gap-5">
                <article class="vm-card-form border-l-4 border-l-[#1c69d4]">
                    <p class="text-xs font-black uppercase tracking-widest text-[#1c69d4]">Experiencia Veloce</p>
                    <h2 class="mt-2 text-3xl font-black text-black">Compra clara, rapida y acompanada</h2>
                    <p class="mt-3 text-sm leading-6 text-gray-500">Consulta autos disponibles, agenda una prueba de manejo y da seguimiento a tus pedidos con tu cuenta de Google.</p>
                </article>
                <div class="grid gap-4 sm:grid-cols-3">
                    <article class="vm-card">
                        <p class="text-sm font-black text-black">Pruebas de manejo</p>
                        <p class="mt-2 text-sm text-gray-500">Agenda una cita y conoce el vehiculo antes de decidir.</p>
                    </article>
                    <article class="vm-card">
                        <p class="text-sm font-black text-black">Pedidos en linea</p>
                        <p class="mt-2 text-sm text-gray-500">Revisa tu compra y seguimiento desde tu cuenta.</p>
                    </article>
                    <article class="vm-card">
                        <p class="text-sm font-black text-black">Atencion directa</p>
                        <p class="mt-2 text-sm text-gray-500">Un equipo listo para resolver dudas y cotizaciones.</p>
                    </article>
                </div>
            </div>
        </div>

        <div class="mt-12">
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="vm-header-tag">Inventario publico</p>
                    <h2 class="text-3xl font-black text-black">Vehiculos disponibles</h2>
                </div>
                <a href="{{ route('cliente.login') }}" class="vm-btn-outline text-center">Guardar mi sesion con Google</a>
            </div>

            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($vehiculos as $vehiculo)
                    @php
                        $imagen = $vehiculo->imagen_principal;
                        $imagenUrl = $imagen
                            ? (str_starts_with($imagen, 'http') ? $imagen : (file_exists(public_path($imagen)) ? asset($imagen) : asset('storage/'.$imagen)))
                            : asset('imagenes/logovelocemotor.png');
                    @endphp
                    <article class="vm-card overflow-hidden !p-0">
                        <img src="{{ $imagenUrl }}" alt="{{ $vehiculo->nombre }}" class="h-52 w-full object-cover">
                        <div class="p-5">
                            <p class="text-xs font-black uppercase tracking-widest text-[#1c69d4]">{{ $vehiculo->marca->nombre ?? 'Sin marca' }}</p>
                            <h3 class="mt-2 text-2xl font-black text-black">{{ $vehiculo->nombre }}</h3>
                            <p class="mt-2 text-sm text-gray-500">
                                {{ $vehiculo->modelo->nombre ?? 'Sin modelo' }} / {{ $vehiculo->tipo->nombre ?? 'Sin tipo' }} / {{ $vehiculo->anio ?? 'Anio no registrado' }}
                            </p>
                            <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                <p class="text-xl font-black text-[#003f7d]">${{ number_format((float) $vehiculo->precio, 2) }}</p>
                                <a href="{{ route('cliente.cita') }}" class="vm-btn-primary text-center !px-4 !py-2 text-sm">Prueba</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="md:col-span-2 xl:col-span-3 rounded-xl border border-gray-200 bg-white p-10 text-center text-gray-500">
                        No hay vehiculos activos en el catalogo.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
