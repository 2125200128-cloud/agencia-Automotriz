@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-2xl">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="vm-page-header">
                    <p class="vm-header-tag">Listado</p>
                    <h1 class="vm-header-title sm:text-5xl">{{ $titulo }}</h1>
                    <p class="vm-header-desc">{{ $descripcion }}</p>
                </div>

                <a href="{{ $urlFormulario }}" class="vm-btn-solid uppercase tracking-wide">
                    + Agregar
                </a>
            </div>
            <div class="vm-table-card">
                <div class="overflow-x-auto">
                    <table class="vm-table">
                        <thead class="vm-table-header">
                            <tr>
                                @foreach ($columnas as $encabezado)
                                    <th class="vm-table-th whitespace-nowrap">{{ $encabezado }}</th>
                                @endforeach
                                <th class="vm-table-th whitespace-nowrap text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($registros as $registro)
                                <tr class="vm-table-tr">
                                    @foreach ($columnas as $atributo => $encabezado)
                                        <td class="vm-table-td whitespace-nowrap">
                                            @php
                                                $valor = data_get($registro, $atributo);
                                                $esImagen = str_contains($atributo, 'imagen');
                                                $imagenPublica = $valor && file_exists(public_path($valor));
                                                $imagenStorage =
                                                    $valor &&
                                                    Illuminate\Support\Facades\Storage::disk('public')->exists($valor);
                                            @endphp
                                            @if ($esImagen && ($imagenPublica || $imagenStorage))
                                                <img src="{{ $imagenPublica ? asset($valor) : asset('storage/' . $valor) }}"
                                                    alt="{{ $encabezado }}" class="h-12 w-20 rounded object-cover">
                                            @else
                                                {{ $valor ?? 'Sin registro' }}
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="vm-table-td whitespace-nowrap text-right">
                                        <div class="flex justify-end gap-2">
                                            <button type="button" class="vm-btn-outline !px-3 !py-1 text-xs">Ver</button>
                                            <button type="button" class="vm-btn-solid !px-3 !py-1 text-xs">Editar</button>
                                            <button type="button"
                                                class="vm-btn-outline !px-3 !py-1 text-xs">Eliminar</button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ count($columnas) + 1 }}"
                                        class="vm-table-td py-10 text-center text-gray-400">
                                        No hay registros disponibles.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
