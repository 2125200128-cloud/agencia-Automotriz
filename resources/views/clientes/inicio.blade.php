@extends('plantilla.base')

@section('dinamico')
<section class="vm-page-section">
    <div class="vm-container-2xl">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div class="vm-page-header">
                <p class="vm-header-tag">Clientes</p>
                <h1 class="vm-header-title sm:text-5xl">Clientes registrados</h1>
                <p class="vm-header-desc">Listado real de clientes guardados en la base de datos.</p>
            </div>
            <a href="/cliente/formulario" class="vm-btn-solid uppercase tracking-wide">+ Agregar</a>
        </div>
        @if (session('success'))<div class="mt-6 rounded-xl border border-red-500/40 bg-red-950/30 p-4 font-bold text-red-200">{{ session('success') }}</div>@endif
        <div class="vm-table-card">
            <div class="overflow-x-auto">
                <table class="vm-table">
                    <thead class="vm-table-header"><tr><th class="vm-table-th">Imagen</th><th class="vm-table-th">Cliente</th><th class="vm-table-th">Correo</th><th class="vm-table-th">Telefono</th><th class="vm-table-th">Direccion</th><th class="vm-table-th">Estado</th><th class="vm-table-th text-right">Acciones</th></tr></thead>
                    <tbody>
                        @forelse ($clientes as $cliente)
                            <tr class="vm-table-tr">
                                <td class="vm-table-td">@include('plantilla.imagen-tabla', ['imagen' => $cliente->imagen, 'alt' => $cliente->nombres])</td>
                                <td class="vm-table-td font-bold text-black">{{ $cliente->nombres }} {{ $cliente->apellidos }}</td>
                                <td class="vm-table-td">{{ $cliente->correo }}</td>
                                <td class="vm-table-td">{{ $cliente->telefono ?? 'Sin registro' }}</td>
                                <td class="vm-table-td">{{ $cliente->direccion ?? 'Sin registro' }}</td>
                                <td class="vm-table-td"><span class="rounded-full border border-red-500/50 px-3 py-1 text-xs font-bold text-red-200">{{ $cliente->estado }}</span></td>
                                <td class="vm-table-td text-right"><div class="flex justify-end gap-2"><a href="/cliente/{{ $cliente->id }}" class="vm-btn-outline !px-3 !py-1 text-xs">Ver</a><a href="/cliente/{{ $cliente->id }}/editar" class="vm-btn-solid !px-3 !py-1 text-xs">Editar</a><a href="/cliente/{{ $cliente->id }}/eliminar" class="vm-btn-outline !px-3 !py-1 text-xs">Eliminar</a></div></td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="vm-table-td py-10 text-center">No hay clientes registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
