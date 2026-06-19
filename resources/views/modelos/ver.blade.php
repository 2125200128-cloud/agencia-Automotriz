@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-lg">
            <div class="vm-page-header mb-8">
                <p class="vm-header-tag">Detalle</p>
                <h1 class="vm-header-title">{{ $modelo->nombre }}</h1>
                <p class="vm-header-desc">Registro completo en modo lectura.</p>
            </div>
            <div class="vm-card-form space-y-4">
                <p><strong>ID:</strong> {{ $modelo->id }}</p>
                <p><strong>Marca:</strong> {{ $modelo->marca->nombre ?? 'Sin marca' }}</p>
                <p><strong>Nombre:</strong> {{ $modelo->nombre }}</p>
                <div><strong>Imagen:</strong>
                    @include('plantilla.imagen-tabla', [
                        'imagen' => $modelo->imagen,
                        'alt' => $modelo->nombre,
                    ])
                </div>
                <div class="flex gap-3 pt-4"><a href="/modelos" class="vm-btn-secondary">Volver</a><a
                        href="/modelos/{{ $modelo->id }}/editar" class="vm-btn-primary">Editar</a></div>
            </div>
        </div>
    </section>
@endsection
