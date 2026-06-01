@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-12 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-screen-xl">
        <div class="border-l-4 border-red-500 pl-5">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-red-300">Catalogos</p>
            <h1 class="mt-3 text-4xl font-black text-white sm:text-5xl">Tablas del inventario</h1>
            <p class="mt-3 max-w-2xl text-gray-400">Accesos directos para consultar o registrar marcas, modelos, colores y tipos de vehiculo.</p>
        </div>

        @php
            $catalogos = [
                ['nombre' => 'Marcas', 'descripcion' => 'Fabricantes disponibles para los vehiculos.', 'listado' => '/marcas', 'formulario' => '/marcas/formulario'],
                ['nombre' => 'Modelos', 'descripcion' => 'Modelos registrados y relacionados con su marca.', 'listado' => '/modelos', 'formulario' => '/modelos/formulario'],
                ['nombre' => 'Colores', 'descripcion' => 'Colores disponibles para el inventario.', 'listado' => '/colores', 'formulario' => '/colores/formulario'],
                ['nombre' => 'Tipos', 'descripcion' => 'Categorias de vehiculos registradas.', 'listado' => '/tipos', 'formulario' => '/tipos/formulario'],
            ];
        @endphp

        <div class="mt-10 grid gap-6 md:grid-cols-2">
            @foreach ($catalogos as $catalogo)
                <article class="rounded-2xl border border-white/10 bg-zinc-950 p-6 shadow-[0_0_30px_rgba(255,255,255,0.06)]">
                    <h2 class="text-2xl font-black text-white">{{ $catalogo['nombre'] }}</h2>
                    <p class="mt-2 text-gray-400">{{ $catalogo['descripcion'] }}</p>

                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ $catalogo['listado'] }}" class="rounded-lg border border-white/20 px-5 py-3 text-center text-sm font-bold text-white transition hover:bg-white hover:text-black">
                            Ver tabla
                        </a>
                        <a href="{{ $catalogo['formulario'] }}" class="rounded-lg bg-red-600 px-5 py-3 text-center text-sm font-black text-white transition hover:bg-red-500">
                            + Agregar
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection
