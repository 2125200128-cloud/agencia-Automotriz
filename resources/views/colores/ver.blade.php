@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-lg">
            <div class="vm-page-header mb-8">
                <p class="vm-header-tag">Detalle</p>
                <h1 class="vm-header-title">{{ $color->nombre }}</h1>
                <p class="vm-header-desc">Registro completo en modo lectura.</p>
            </div>
            <div class="vm-card-form space-y-4">
                <p><strong>ID:</strong> {{ $color->id }}</p>
                <p><strong>Nombre:</strong> {{ $color->nombre }}</p>
                <p><strong>Imagen:</strong> {{ $color->imagen ?? 'Sin imagen' }}</p>
                <div class="flex gap-3 pt-4"><a href="/colores" class="vm-btn-secondary">Volver</a><a
                        href="/colores/{{ $color->id }}/editar" class="vm-btn-primary">Editar</a></div>
            </div>
        </div>
    </section>
@endsection
