@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-lg">
            <div class="vm-page-header mb-8">
                <p class="vm-header-tag">Editar tipo</p>
                <h1 class="vm-header-title">{{ $tipo->nombre }}</h1>
                <p class="vm-header-desc">Actualiza los datos del tipo.</p>
            </div>
            <div class="vm-card-form">
                <form action="/tipos/{{ $tipo->id }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div><label class="vm-input-label" for="nombre">Nombre</label><input class="vm-input-text"
                            id="nombre" name="nombre" value="{{ old('nombre', $tipo->nombre) }}" required></div>
                    <div><label for="imagen" class="vm-input-label">Imagen ilustrativa</label>
                        @include('plantilla.imagen-tabla', [
                            'imagen' => $tipo->imagen,
                            'alt' => $tipo->nombre,
                        ])
                        <input type="file" id="imagen" name="imagen" accept="image/*" class="vm-input-text">
                        <p class="mt-2 text-xs text-gray-400">{{ $tipo->imagen ?? 'Sin imagen actual' }}</p>
                    </div>
                    <div class="flex justify-end gap-3 border-t border-gray-200 pt-6"><a href="/tipos"
                            class="vm-btn-secondary">Cancelar</a><button class="vm-btn-primary"
                            type="submit">Actualizar</button></div>
                </form>
            </div>
        </div>
    </section>
@endsection
