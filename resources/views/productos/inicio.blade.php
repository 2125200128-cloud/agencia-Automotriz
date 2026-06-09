@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-2xl">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="vm-page-header">
                    <p class="vm-header-tag">Productos</p>
                    <h1 class="vm-header-title sm:text-5xl">Inventario de vehiculos</h1>
                    <p class="vm-header-desc">Productos con sus catalogos relacionados.</p>
                </div>
                <a href="/producto/formulario" class="vm-btn-solid uppercase tracking-wide">+ Agregar</a>
            </div>
            @if (session('success'))
                <div class="mt-6 rounded-xl border border-red-500/40 bg-red-950/30 p-4 font-bold text-red-200">
                    {{ session('success') }}</div>
            @endif
            <div class="vm-table-card">
                <div class="overflow-x-auto">
                    <table class="vm-table">
                        <thead class="vm-table-header">
                            <tr>
                                <th class="vm-table-th">Imagen</th>
                                <th class="vm-table-th">Vehiculo</th>
                                <th class="vm-table-th">Marca</th>
                                <th class="vm-table-th">Modelo</th>
                                <th class="vm-table-th">Tipo</th>
                                <th class="vm-table-th">Color</th>
                                <th class="vm-table-th">Proveedor</th>
                                <th class="vm-table-th">Precio</th>
                                <th class="vm-table-th">Estado</th>
                                <th class="vm-table-th text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($productos as $producto)
                                <tr class="vm-table-tr">
                                    <td class="vm-table-td">@include('plantilla.imagen-tabla', [
                                        'imagen' => $producto->imagen_principal,
                                        'alt' => $producto->nombre,
                                    ])</td>
                                    <td class="vm-table-td font-bold text-black">{{ $producto->nombre }}<p
                                            class="text-xs text-gray-400">
                                            {{ $producto->numero_serie ?? 'Sin numero de serie' }}</p>
                                    </td>
                                    <td class="vm-table-td">{{ $producto->marca->nombre ?? 'Sin marca' }}</td>
                                    <td class="vm-table-td">{{ $producto->modelo->nombre ?? 'Sin modelo' }}</td>
                                    <td class="vm-table-td">{{ $producto->tipo->nombre ?? 'Sin tipo' }}</td>
                                    <td class="vm-table-td">{{ $producto->color->nombre ?? 'Sin color' }}</td>
                                    <td class="vm-table-td">{{ $producto->proveedor->nombre ?? 'Sin proveedor' }}</td>
                                    <td class="vm-table-td">${{ number_format((float) $producto->precio, 2) }}</td>
                                    <td class="vm-table-td"><span
                                            class="rounded-full border border-red-500/50 px-3 py-1 text-xs font-bold text-red-200">{{ $producto->estado }}</span>
                                    </td>
                                    <td class="vm-table-td text-right">
                                        <div class="flex justify-end gap-2"><a href="/producto/{{ $producto->id }}"
                                                class="vm-btn-outline !px-3 !py-1 text-xs">Ver</a><a
                                                href="/producto/{{ $producto->id }}/editar"
                                                class="vm-btn-solid !px-3 !py-1 text-xs">Editar</a><a
                                                href="/producto/{{ $producto->id }}/eliminar"
                                                class="vm-btn-outline !px-3 !py-1 text-xs">Eliminar</a></div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="vm-table-td py-10 text-center">No hay productos registrados.
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
