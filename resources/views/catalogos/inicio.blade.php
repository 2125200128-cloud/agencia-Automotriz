@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-xl">
            <div class="vm-page-header">
                <p class="vm-header-tag">Catalogos</p>
                <h1 class="vm-header-title sm:text-5xl">Tablas del inventario</h1>
                <p class="vm-header-desc">Accesos directos para consultar o registrar marcas, modelos, colores y tipos de
                    vehiculo.</p>
            </div>
            @php
                $catalogos = [
                    [
                        'nombre' => 'Marcas',
                        'descripcion' => 'Fabricantes disponibles para los vehiculos.',
                        'listado' => '/marcas',
                        'formulario' => '/marcas/formulario',
                    ],
                    [
                        'nombre' => 'Modelos',
                        'descripcion' => 'Modelos registrados y relacionados con su marca.',
                        'listado' => '/modelos',
                        'formulario' => '/modelos/formulario',
                    ],
                    [
                        'nombre' => 'Colores',
                        'descripcion' => 'Colores disponibles para el inventario.',
                        'listado' => '/colores',
                        'formulario' => '/colores/formulario',
                    ],
                    [
                        'nombre' => 'Tipos',
                        'descripcion' => 'Categorias de vehiculos registradas.',
                        'listado' => '/tipos',
                        'formulario' => '/tipos/formulario',
                    ],
                ];
            @endphp
            <div class="mt-10 grid gap-6 md:grid-cols-2">
                @foreach ($catalogos as $catalogo)
                    <article class="vm-card-form">
                        <h2 class="text-2xl font-black text-black">{{ $catalogo['nombre'] }}</h2>
                        <p class="mt-2 text-gray-400">{{ $catalogo['descripcion'] }}</p>
                        <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                            <a href="{{ $catalogo['listado'] }}" class="vm-btn-outline text-center flex-1 sm:flex-none">
                                Ver tabla
                            </a>
                            <a href="{{ $catalogo['formulario'] }}" class="vm-btn-solid text-center flex-1 sm:flex-none">
                                + Agregar
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
