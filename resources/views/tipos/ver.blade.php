@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-md">
            <div class="vm-card-form space-y-4">
                <p class="vm-header-tag">Detalle tipo</p>
                <h1 class="vm-header-title">{{ $tipo->nombre }}</h1>
                <p><strong>ID:</strong> {{ $tipo->id }}</p>
                <p><strong>Imagen:</strong> {{ $tipo->imagen ?? 'Sin imagen' }}</p>
                <div class="flex gap-3 pt-4"><a href="/tipos" class="vm-btn-secondary">Volver</a><a
                        href="/tipos/{{ $tipo->id }}/editar" class="vm-btn-primary">Editar</a></div>
            </div>
        </div>
    </section>
@endsection
