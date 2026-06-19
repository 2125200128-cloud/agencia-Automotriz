@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-md">
            <div class="vm-card-form space-y-4">
                <p class="vm-header-tag">Detalle tipo</p>
                <h1 class="vm-header-title">{{ $tipo->nombre }}</h1>
                <p><strong>ID:</strong> {{ $tipo->id }}</p>
                <div><strong>Imagen:</strong>
                    @include('plantilla.imagen-tabla', [
                        'imagen' => $tipo->imagen,
                        'alt' => $tipo->nombre,
                    ])
                </div>
                <div class="flex gap-3 pt-4"><a href="/tipos" class="vm-btn-secondary">Volver</a><a
                        href="/tipos/{{ $tipo->id }}/editar" class="vm-btn-primary">Editar</a></div>
            </div>
        </div>
    </section>
@endsection
