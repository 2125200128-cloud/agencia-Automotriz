@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-lg">
            <div class="vm-page-header mb-8">
                <p class="vm-header-tag">Detalle</p>
                <h1 class="vm-header-title">{{ $administrador->nombres }} {{ $administrador->apellidos }}</h1>
                <p class="vm-header-desc">Registro completo en modo lectura.</p>
            </div>
            <div class="vm-card-form space-y-4">
                <p><strong>ID:</strong> {{ $administrador->id }}</p>
                <p><strong>Correo:</strong> {{ $administrador->correo }}</p>
                <p><strong>Usuario:</strong> {{ $administrador->usuario }}</p>
                <p><strong>Rol:</strong> {{ $administrador->rol }}</p>
                <p><strong>Estado:</strong> {{ $administrador->estado }}</p>
                <p><strong>Imagen:</strong> {{ $administrador->imagen ?? 'Sin imagen' }}</p>
                <div class="flex gap-3 pt-4"><a href="/administrador" class="vm-btn-secondary">Volver</a><a
                        href="/administrador/{{ $administrador->id }}/editar" class="vm-btn-primary">Editar</a></div>
            </div>
        </div>
    </section>
@endsection
