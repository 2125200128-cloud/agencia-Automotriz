@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-lg">
            <div class="vm-page-header mb-8">
                <p class="vm-header-tag">Detalle</p>
                <h1 class="vm-header-title">{{ $producto->nombre }}</h1>
                <p class="vm-header-desc">Registro completo en modo lectura.</p>
            </div>
            <div class="vm-card-form grid gap-4 md:grid-cols-2">@php $imagenes = collect([$producto->imagen_principal, $producto->imagen_secundaria, $producto->imagen_adicional])->filter(); @endphp @if ($imagenes->isNotEmpty())
                    <div class="md:col-span-2 grid gap-4 md:grid-cols-3">
                        @foreach ($imagenes as $imagen)
                            @php $imagenUrl = str_starts_with($imagen, 'http') ? $imagen : (file_exists(public_path($imagen)) ? asset($imagen) : asset('storage/'.$imagen)); @endphp
                            <img src="{{ $imagenUrl }}" alt="{{ $producto->nombre }}"
                                class="h-48 w-full rounded-xl border border-gray-200 object-cover shadow-sm">
                        @endforeach
                    </div>
                @endif
                <p><strong>ID:</strong> {{ $producto->id }}</p>
                <p><strong>Numero de serie:</strong> {{ $producto->numero_serie ?? 'Sin registro' }}</p>
                <p><strong>Anio:</strong> {{ $producto->anio ?? 'Sin registro' }}</p>
                <p><strong>Precio:</strong> ${{ number_format((float) $producto->precio, 2) }}</p>
                <p><strong>Marca:</strong> {{ $producto->marca->nombre ?? 'Sin marca' }}</p>
                <p><strong>Modelo:</strong> {{ $producto->modelo->nombre ?? 'Sin modelo' }}</p>
                <p><strong>Tipo:</strong> {{ $producto->tipo->nombre ?? 'Sin tipo' }}</p>
                <p><strong>Color:</strong> {{ $producto->color->nombre ?? 'Sin color' }}</p>
                <p><strong>Proveedor:</strong> {{ $producto->proveedor->nombre ?? 'Sin proveedor' }}</p>
                <p><strong>Existencia:</strong> {{ $producto->existencia }}</p>
                <p><strong>Descuento:</strong> {{ $producto->descuento }}</p>
                <p><strong>Estado:</strong> {{ $producto->estado }}</p>
                <p class="md:col-span-2"><strong>Descripcion:</strong> {{ $producto->descripcion ?? 'Sin registro' }}</p>
                <p class="md:col-span-2"><strong>Detalles:</strong> {{ $producto->detalles ?? 'Sin registro' }}</p>
                <div class="md:col-span-2 flex gap-3 pt-4"><a href="/producto" class="vm-btn-secondary">Volver</a><a
                        href="/producto/{{ $producto->id }}/editar" class="vm-btn-primary">Editar</a></div>
            </div>
        </div>
    </section>
@endsection
