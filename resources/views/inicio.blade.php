@extends('plantilla.base')

@section('dinamico')
@php
    $admin = Auth::guard('admin')->user();
@endphp
<section class="vm-page-section">
    <div class="vm-container-2xl">
        <div class="vm-page-header mb-8">
            <p class="vm-header-tag">Dashboard</p>
            <h1 class="vm-header-title">Panel administrativo</h1>
            <p class="vm-header-desc">
                Bienvenido, {{ Auth::guard('admin')->user()->nombres ?? 'Administrador' }}. Consulta el estado general de Veloce Motors.
            </p>
        </div>

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
            <article class="vm-card-form">
                <p class="text-xs font-black uppercase tracking-widest text-[#1c69d4]">Inventario</p>
                <h2 class="mt-3 text-4xl font-black text-black">{{ $totalVehiculos ?? 0 }}</h2>
                <p class="mt-2 text-sm text-gray-500">Vehiculos registrados</p>
            </article>

            <article class="vm-card-form">
                <p class="text-xs font-black uppercase tracking-widest text-[#1c69d4]">Catalogos</p>
                <h2 class="mt-3 text-4xl font-black text-black">{{ $categorias->count() ?? 0 }}</h2>
                <p class="mt-2 text-sm text-gray-500">Tipos de vehiculo</p>
            </article>

            <article class="vm-card-form">
                <p class="text-xs font-black uppercase tracking-widest text-[#1c69d4]">Marcas</p>
                <h2 class="mt-3 text-4xl font-black text-black">{{ $marcas->count() ?? 0 }}</h2>
                <p class="mt-2 text-sm text-gray-500">Fabricantes activos</p>
            </article>

            <article class="vm-card-form">
                <p class="text-xs font-black uppercase tracking-widest text-[#1c69d4]">Sesion</p>
                <h2 class="mt-3 text-2xl font-black text-black">{{ $admin?->rolVisible() ?? 'Admin' }}</h2>
                <p class="mt-2 text-sm text-gray-500">Guard admin activo</p>
            </article>
        </div>

        <div class="mt-8 grid gap-6 xl:grid-cols-[1.25fr_0.75fr]">
            <section class="vm-card-form">
                <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-black text-black">Vehiculos recientes</h2>
                        <p class="mt-1 text-sm text-gray-500">Ultimos registros activos del inventario.</p>
                    </div>
                    @if ($admin?->puede('inventario'))
                        <a href="/producto/formulario" class="vm-btn-primary text-center">+ Nuevo vehiculo</a>
                    @endif
                </div>

                <div class="grid gap-4 md:grid-cols-3">
                    @forelse ($vehiculos as $vehiculo)
                        <article class="vm-card">
                            <p class="text-xs font-black uppercase tracking-widest text-[#1c69d4]">{{ $vehiculo->marca->nombre ?? 'Sin marca' }}</p>
                            <h3 class="mt-2 text-xl font-black text-black">{{ $vehiculo->nombre }}</h3>
                            <p class="mt-2 text-sm text-gray-500">{{ $vehiculo->tipo->nombre ?? 'Sin tipo' }}</p>
                            <p class="mt-4 text-lg font-black text-[#003f7d]">${{ number_format((float) $vehiculo->precio, 2) }}</p>
                        </article>
                    @empty
                        <div class="md:col-span-3 rounded-xl border border-gray-200 bg-gray-50 p-8 text-center text-gray-500">
                            No hay vehiculos activos registrados.
                        </div>
                    @endforelse
                </div>
            </section>

            <aside class="vm-card-form">
                <h2 class="text-2xl font-black text-black">Accesos rapidos</h2>
                <div class="mt-5 grid gap-3">
                    @if ($admin?->puede('inventario'))
                        <a href="/producto" class="vm-btn-outline text-center">Inventario</a>
                    @endif
                    @if ($admin?->puede('ventas'))
                        <a href="/pedido" class="vm-btn-outline text-center">Ventas</a>
                    @elseif ($admin?->puede('ventas_registro'))
                        <a href="/pedido/formulario" class="vm-btn-outline text-center">Registrar venta</a>
                    @endif
                    @if ($admin?->puede('pagos'))
                        <a href="/pagos" class="vm-btn-outline text-center">Cobros</a>
                    @endif
                    @if ($admin?->puede('citas'))
                        <a href="/administrador/citas" class="vm-btn-outline text-center">Agenda de pruebas</a>
                    @endif
                    @if ($admin?->puede('administracion'))
                        <a href="/administrador/valuador" class="vm-btn-outline text-center">Valuador</a>
                    @endif
                    @if ($admin?->puede('catalogos'))
                        <a href="/catalogos" class="vm-btn-outline text-center">Catalogos</a>
                    @endif
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
