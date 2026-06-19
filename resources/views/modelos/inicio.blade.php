@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-2xl">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="vm-page-header">
                    <p class="vm-header-tag">Modelos</p>
                    <h1 class="vm-header-title sm:text-5xl">Modelos de vehiculos</h1>
                    <p class="vm-header-desc">Modelos asociados a su marca.</p>
                </div>
                <a href="/modelos/formulario" class="vm-btn-solid uppercase tracking-wide">+ Agregar</a>
            </div>
            @if (session('success'))
                <div class="mt-6 rounded-xl border border-red-500/40 bg-red-950/30 p-4 font-bold text-red-200">
                    {{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mt-6 rounded-xl border border-red-500/40 bg-red-950/30 p-4 font-bold text-red-200">
                    {{ session('error') }}</div>
            @endif
            <div class="vm-table-card">
                <div class="overflow-x-auto">
                    <table class="vm-table">
                        <thead class="vm-table-header">
                            <tr>
                                <th class="vm-table-th">ID</th>
                                <th class="vm-table-th">Imagen</th>
                                <th class="vm-table-th">Marca</th>
                                <th class="vm-table-th">Nombre</th>
                                <th class="vm-table-th text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($modelos as $modelo)
                                <tr class="vm-table-tr">
                                    <td class="vm-table-td">{{ $modelo->id }}</td>
                                    <td class="vm-table-td">@include('plantilla.imagen-tabla', [
                                        'imagen' => $modelo->imagen,
                                        'alt' => $modelo->nombre,
                                    ])</td>
                                    <td class="vm-table-td">{{ $modelo->marca->nombre ?? 'Sin marca' }}</td>
                                    <td class="vm-table-td font-bold text-black">{{ $modelo->nombre }}</td>
                                    <td class="vm-table-td text-right">
                                        <div class="flex justify-end gap-2"><a href="/modelos/{{ $modelo->id }}"
                                                class="vm-btn-outline !px-3 !py-1 text-xs">Ver</a><a
                                                href="/modelos/{{ $modelo->id }}/editar"
                                                class="vm-btn-solid !px-3 !py-1 text-xs">Editar</a><a
                                                href="/modelos/{{ $modelo->id }}/eliminar"
                                                class="vm-btn-outline !px-3 !py-1 text-xs">Eliminar</a></div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="vm-table-td py-10 text-center">No hay modelos registrados.
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
