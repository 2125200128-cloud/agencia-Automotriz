@extends('plantilla.base')

@section('dinamico')
@php
    $imagenesCarruselInicio = [
        'imagenes/imagenInicioCarrucel1.jpg',
        'imagenes/imagenInicoCarrucel2.jpg',
        'imagenes/imagenInicioCarrucel3.jpg',
    ];

    $imagenesCategorias = [
        'imagenes/categoriaSedan.jpg',
        'imagenes/categoriaSuv.jpg',
        'imagenes/categoriaCoupe.jpg',
        'imagenes/categoriaPickUp.jpg',
        'imagenes/categoriaHatchback.jpg',
    ];
@endphp

<section class="relative overflow-hidden bg-black">
    <div id="inicio-carrusel" class="absolute inset-0" data-simple-carousel>
        <div class="relative h-full overflow-hidden">
            @foreach ($imagenesCarruselInicio as $index => $imagenCarrusel)
                <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-simple-slide>
                    <img src="{{ asset($imagenCarrusel) }}" alt="Vehículo destacado {{ $index + 1 }}" class="absolute left-1/2 top-1/2 h-full w-full scale-110 -translate-x-1/2 -translate-y-1/2 object-cover opacity-55 blur-md">
                </div>
            @endforeach
        </div>

        <div class="absolute bottom-8 left-1/2 z-20 flex -translate-x-1/2 space-x-3">
            @foreach ($imagenesCarruselInicio as $index => $imagenCarrusel)
                <button type="button" class="h-3 w-3 rounded-full border border-white/40 {{ $index === 0 ? 'bg-white' : 'bg-white/70' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Imagen {{ $index + 1 }}" data-simple-indicator="{{ $index }}"></button>
            @endforeach
        </div>
    </div>

    <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_16%,rgba(255,255,255,0.10),transparent_30%),linear-gradient(90deg,rgba(0,0,0,0.96)_0%,rgba(0,0,0,0.86)_44%,rgba(0,0,0,0.64)_100%)]"></div>
    <div class="absolute inset-0 bg-black/25 backdrop-blur-sm"></div>
    <div class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-black to-transparent"></div>

    <div class="relative mx-auto grid min-h-[calc(100vh-92px)] max-w-screen-2xl gap-10 px-4 py-12 sm:px-6 lg:grid-cols-[0.95fr_1.05fr] lg:items-center lg:px-8">
        <div class="max-w-3xl">
            <span class="inline-flex items-center rounded-full border border-white/25 bg-white/10 px-4 py-2 text-xs font-bold uppercase tracking-[0.28em] text-zinc-200 shadow-[0_0_24px_rgba(255,255,255,0.12)]">
                COMPRA Y VENTA DE AUTOS
            </span>

            <h1 class="mt-6 text-4xl font-black leading-tight text-white drop-shadow-[0_0_28px_rgba(255,255,255,0.22)] sm:text-5xl lg:text-7xl">
               LOS MEJORES AUTOS AL MEJOR PRECIO
            </h1>

            <p class="mt-5 max-w-2xl text-lg font-semibold leading-8 text-gray-100 drop-shadow-[0_0_18px_rgba(0,0,0,0.9)] sm:text-xl">
                Encuentra el precio correcto y el vehículo ideal.
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <a href="/producto" class="inline-flex items-center justify-center rounded-lg bg-white px-7 py-3.5 text-sm font-black uppercase tracking-wide text-black shadow-[0_0_28px_rgba(255,255,255,0.18)] transition hover:bg-zinc-200 focus:outline-none focus:ring-4 focus:ring-white/30">
                    Ver vehículos
                    <svg class="ms-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="relative">
            <div class="absolute -inset-4 rounded-full bg-white/20 blur-3xl"></div>
            <div id="inicio-carrusel-destacado" class="relative z-10 mx-auto aspect-[16/10] w-full max-w-3xl overflow-hidden rounded-2xl border border-white/10 shadow-[0_0_48px_rgba(255,255,255,0.14)]" data-simple-carousel>
                <div class="relative h-full overflow-hidden">
                    @foreach ($imagenesCarruselInicio as $index => $imagenCarrusel)
                        <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-simple-slide>
                            <img src="{{ asset($imagenCarrusel) }}" alt="Auto destacado {{ $index + 1 }}" class="absolute left-1/2 top-1/2 h-full w-full -translate-x-1/2 -translate-y-1/2 object-cover contrast-110 saturate-125">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="relative z-20 mx-auto -mt-6 grid max-w-2xl grid-cols-3 gap-3 rounded-2xl border border-white/15 bg-zinc-950/85 p-3 shadow-[0_0_34px_rgba(255,255,255,0.12)] backdrop-blur">
                <div class="rounded-xl bg-black/80 p-3 text-center">
                    <p class="text-lg font-black text-white">{{ $totalVehiculos }}</p>
                    <p class="text-xs text-gray-400">Vehículos</p>
                </div>
                <div class="rounded-xl bg-black/80 p-3 text-center">
                    <p class="text-lg font-black text-white">24 h</p>
                    <p class="text-xs text-gray-400">Apartado</p>
                </div>
                <div class="rounded-xl bg-black/80 p-3 text-center">
                    <p class="text-lg font-black text-white">5/5</p>
                    <p class="text-xs text-gray-400">Servicio</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carousels = document.querySelectorAll('[data-simple-carousel]');

        carousels.forEach(function (carousel) {
            const slides = carousel.querySelectorAll('[data-simple-slide]');
            const indicators = carousel.querySelectorAll('[data-simple-indicator]');
            let activeIndex = 0;

            if (slides.length <= 1) {
                return;
            }

            function showSlide(nextIndex) {
                slides[activeIndex].classList.remove('opacity-100');
                slides[activeIndex].classList.add('opacity-0');

                if (indicators[activeIndex]) {
                    indicators[activeIndex].classList.remove('bg-white');
                    indicators[activeIndex].classList.add('bg-white/70');
                    indicators[activeIndex].setAttribute('aria-current', 'false');
                }

                activeIndex = nextIndex;

                slides[activeIndex].classList.remove('opacity-0');
                slides[activeIndex].classList.add('opacity-100');

                if (indicators[activeIndex]) {
                    indicators[activeIndex].classList.remove('bg-white/70');
                    indicators[activeIndex].classList.add('bg-white');
                    indicators[activeIndex].setAttribute('aria-current', 'true');
                }
            }

            indicators.forEach(function (indicator, index) {
                indicator.addEventListener('click', function () {
                    showSlide(index);
                });
            });

            setInterval(function () {
                showSlide((activeIndex + 1) % slides.length);
            }, 5000);
        });
    });
</script>

<section class="bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-screen-2xl rounded-2xl border border-white/10 bg-zinc-950 p-5 shadow-[0_0_38px_rgba(255,255,255,0.08)]">
        <form class="grid gap-4 md:grid-cols-2 xl:grid-cols-8">
            <div class="xl:col-span-2">
                <label for="keyword" class="mb-2 block text-sm font-bold text-gray-200">Keyword</label>
                <input type="text" id="keyword" name="keyword" class="block w-full rounded-lg border border-white/10 bg-black p-3 text-sm text-white placeholder-gray-500 focus:border-white/30 focus:ring-white/30" placeholder="Modelo, version o palabra clave">
            </div>

            <div>
                <label for="ubicacion" class="mb-2 block text-sm font-bold text-gray-200">Ubicación</label>
                <input type="text" id="ubicacion" name="ubicacion" class="block w-full rounded-lg border border-white/10 bg-black p-3 text-sm text-white placeholder-gray-500 focus:border-white/30 focus:ring-white/30" placeholder="Ciudad">
            </div>

            <div>
                <label for="categoria" class="mb-2 block text-sm font-bold text-gray-200">Categoria</label>
                <select id="categoria" name="categoria" class="block w-full rounded-lg border border-white/10 bg-black p-3 text-sm text-white focus:border-white/30 focus:ring-white/30">
                    <option selected>Cualquiera</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="marca" class="mb-2 block text-sm font-bold text-gray-200">Marca</label>
                <select id="marca" name="marca" class="block w-full rounded-lg border border-white/10 bg-black p-3 text-sm text-white focus:border-white/30 focus:ring-white/30">
                    <option selected>Todas</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="combustible" class="mb-2 block text-sm font-bold text-gray-200">Combustible</label>
                <select id="combustible" name="combustible" class="block w-full rounded-lg border border-white/10 bg-black p-3 text-sm text-white focus:border-white/30 focus:ring-white/30">
                    <option selected>Cualquiera</option>
                    <option>Gasolina</option>
                    <option>Diesel</option>
                    <option>Híbrido</option>
                    <option>Electrico</option>
                </select>
            </div>

            <div>
                <label for="transmision" class="mb-2 block text-sm font-bold text-gray-200">Transmisión</label>
                <select id="transmision" name="transmision" class="block w-full rounded-lg border border-white/10 bg-black p-3 text-sm text-white focus:border-white/30 focus:ring-white/30">
                    <option selected>Cualquiera</option>
                    <option>Automatica</option>
                    <option>Manual</option>
                </select>
            </div>

            <div>
                <label for="estado" class="mb-2 block text-sm font-bold text-gray-200">Estado</label>
                <select id="estado" name="estado" class="block w-full rounded-lg border border-white/10 bg-black p-3 text-sm text-white focus:border-white/30 focus:ring-white/30">
                    <option selected>Cualquiera</option>
                    <option>Nuevo</option>
                    <option>Seminuevo</option>
                    <option>Usado</option>
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit" class="inline-flex w-full items-center justify-center rounded-lg bg-white px-5 py-3 text-sm font-black uppercase tracking-wide text-black shadow-[0_0_24px_rgba(255,255,255,0.16)] transition hover:bg-zinc-200 focus:outline-none focus:ring-4 focus:ring-white/30">
                    Buscar
                </button>
            </div>
        </form>
    </div>
</section>

<section class="bg-black px-4 py-12 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-screen-2xl">
        <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.28em] text-zinc-300">Explora tu estilo </p>
                <h2 class="mt-2 text-3xl font-black text-white sm:text-4xl">Categorias populares</h2>
            </div>
        </div>

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
            @foreach ($categorias as $categoria)
                <article class="group overflow-hidden rounded-xl border border-white/10 bg-zinc-950 shadow-[0_0_24px_rgba(255,255,255,0.08)] transition hover:-translate-y-1 hover:border-white/30 hover:shadow-[0_0_34px_rgba(255,255,255,0.12)]">
                    <div class="relative aspect-[4/3] overflow-hidden bg-zinc-900">
                        <img src="{{ asset($imagenesCategorias[$loop->index % count($imagenesCategorias)]) }}" alt="{{ $categoria->nombre }}" class="h-full w-full object-cover opacity-75 transition duration-500 group-hover:scale-110 group-hover:opacity-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/25 to-transparent"></div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-black text-white">{{ $categoria->nombre }}</h3>
                        <p class="mt-1 text-sm text-zinc-200">{{ $categoria->productos_count }} vehiculos</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-zinc-950 px-4 py-14 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-screen-2xl">
        <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.28em] text-zinc-300">Inventario seleccionado</p>
                <h2 class="mt-2 text-3xl font-black text-white sm:text-4xl">Vehículos destacados</h2>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($vehiculos as $vehiculo)
                @php
                    $imagenVehiculo = $vehiculo->imagen_principal && Illuminate\Support\Facades\Storage::disk('public')->exists($vehiculo->imagen_principal)
                        ? asset('storage/'.$vehiculo->imagen_principal)
                        : asset($imagenesCarruselInicio[$loop->index % count($imagenesCarruselInicio)]);
                @endphp
                <article class="overflow-hidden rounded-2xl border border-white/10 bg-black shadow-[0_0_30px_rgba(255,255,255,0.08)] transition hover:border-white/30 hover:shadow-[0_0_40px_rgba(255,255,255,0.12)]">
                    <div class="relative aspect-[16/10] overflow-hidden bg-zinc-900">
                        <img src="{{ $imagenVehiculo }}" alt="{{ $vehiculo->nombre }}" class="h-full w-full object-cover">
                        <button type="button" class="absolute right-4 top-4 inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/25 bg-black/80 text-zinc-200 shadow-[0_0_20px_rgba(255,255,255,0.12)] transition hover:bg-white hover:text-black" aria-label="Agregar a favoritos">
                            <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 19">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17.5s-8.5-4.8-8.5-11A4.7 4.7 0 0 1 11 3a4.7 4.7 0 0 1 8.5 3.5c0 6.2-8.5 11-8.5 11Z"/>
                            </svg>
                        </button>
                    </div>

                    <div class="p-5">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-black text-white">{{ $vehiculo->nombre }}</h3>
                                <p class="mt-1 text-sm text-gray-400">{{ $vehiculo->tipo?->nombre ?? 'Sin tipo' }}</p>
                            </div>
                            <span class="rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-bold text-white">{{ ucfirst($vehiculo->estado) }}</span>
                        </div>

                        <p class="mt-5 text-2xl font-black text-white">${{ number_format($vehiculo->precio, 2) }} MXN</p>

                        <div class="mt-5 grid grid-cols-2 gap-3 text-sm">
                            <div class="rounded-lg border border-white/10 bg-zinc-950 p-3">
                                <p class="text-gray-500">Marca</p>
                                <p class="font-bold text-white">{{ $vehiculo->marca?->nombre ?? 'Sin marca' }}</p>
                            </div>
                            <div class="rounded-lg border border-white/10 bg-zinc-950 p-3">
                                <p class="text-gray-500">Existencia</p>
                                <p class="font-bold text-white">{{ $vehiculo->existencia }}</p>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <a href="{{ url('/cliente/cita') . '?' . http_build_query(['auto' => $vehiculo->nombre]) }}" class="inline-flex items-center justify-center rounded-xl border border-white/20 bg-zinc-900/60 py-3 text-center text-xs font-bold text-zinc-300 transition hover:bg-zinc-800 hover:text-white">
                                Prueba de manejo
                            </a>
                            <a href="{{ url('/cliente/compra') . '?' . http_build_query(['auto' => $vehiculo->nombre, 'precio' => '$' . number_format($vehiculo->precio, 2) . ' MXN', 'tipo' => $vehiculo->tipo?->nombre ?? 'Sin tipo']) }}" class="neon-red inline-flex items-center justify-center rounded-xl bg-red-600 py-3 text-center text-xs font-black uppercase text-white transition hover:bg-red-500">
                                Comprar
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-10 text-center">
            <a href="/producto" class="inline-flex items-center justify-center rounded-lg border border-white/25 px-7 py-3 text-sm font-black uppercase tracking-wide text-white shadow-[0_0_22px_rgba(255,255,255,0.08)] transition hover:bg-white hover:text-black hover:shadow-[0_0_34px_rgba(255,255,255,0.18)] focus:outline-none focus:ring-4 focus:ring-white/30">
                Ver todos los vehículos
            </a>
        </div>
    </div>
</section>

<section class="relative overflow-hidden bg-black px-4 py-16 sm:px-6 lg:px-8">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_75%_20%,rgba(255,255,255,0.08),transparent_28%)]"></div>

    <div class="relative mx-auto grid max-w-screen-2xl gap-10 lg:grid-cols-[1fr_0.9fr] lg:items-center">
        <div class="relative">
            <div class="absolute -inset-3 rounded-full bg-white/20 blur-3xl"></div>
            <img src="{{ asset('imagenes/auto-info.png') }}" alt="Vehiculo de agencia" class="relative mx-auto w-full max-w-3xl drop-shadow-[0_0_42px_rgba(255,255,255,0.12)]">
        </div>

        <div>
            <div class="grid max-w-xl grid-cols-3 gap-4">
                <div class="flex aspect-square flex-col items-center justify-center rounded-full border border-white/30 bg-zinc-950 text-center shadow-[0_0_28px_rgba(255,255,255,0.12)]">
                    <p class="text-2xl font-black text-white">98%</p>
                    <p class="text-xs text-gray-400">Clientes</p>
                </div>
                <div class="flex aspect-square flex-col items-center justify-center rounded-full border border-white/30 bg-zinc-950 text-center shadow-[0_0_28px_rgba(255,255,255,0.12)]">
                    <p class="text-2xl font-black text-white">72 h</p>
                    <p class="text-xs text-gray-400">Entrega</p>
                </div>
                <div class="flex aspect-square flex-col items-center justify-center rounded-full border border-white/30 bg-zinc-950 text-center shadow-[0_0_28px_rgba(255,255,255,0.12)]">
                    <p class="text-2xl font-black text-white">0%</p>
                    <p class="text-xs text-gray-400">Complicacion</p>
                </div>
            </div>

            <p class="mt-10 text-sm font-bold uppercase tracking-[0.28em] text-zinc-300">Compra o venta asistida</p>
            <h2 class="mt-3 text-3xl font-black leading-tight text-white sm:text-5xl">
                ¿Quieres comprar o vender un vehículo?
            </h2>
            <p class="mt-5 max-w-2xl text-lg leading-8 text-gray-300">
                Te ayudamos a comparar opciones, validar precios y cerrar una operación clara desde agencia.
            </p>

            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                <div class="rounded-xl border border-white/10 bg-zinc-950 p-5 shadow-[0_0_24px_rgba(255,255,255,0.08)]">
                    <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-lg bg-white text-black shadow-[0_0_22px_rgba(255,255,255,0.12)]">
                        <svg class="h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18M5 21V8l7-5 7 5v13M9 21v-7h6v7M8 10h.01M12 10h.01M16 10h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-white">Vehículos de agencia</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-400">Unidades verificadas, historial claro y asesoría personalizada para elegir con confianza.</p>
                </div>

                <div class="rounded-xl border border-white/10 bg-zinc-950 p-5 shadow-[0_0_24px_rgba(255,255,255,0.08)]">
                    <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-lg bg-white text-black shadow-[0_0_22px_rgba(255,255,255,0.12)]">
                        <svg class="h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17h10M5 17l1.4-5.6A3 3 0 0 1 9.3 9h5.4a3 3 0 0 1 2.9 2.4L19 17M6 17v2m12-2v2M8 13h.01M16 13h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-white">Vehículos seminuevos</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-400">Opciones inspeccionadas con precios competitivos y respaldo durante todo el proceso.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
