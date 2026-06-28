@extends('plantilla.base')

@section('dinamico')
<section class="vm-page-section"><div class="vm-container-lg"><div class="vm-page-header mb-8"><p class="vm-header-tag">Detalle</p><h1 class="vm-header-title">{{ $marca->nombre }}</h1><p class="vm-header-desc">Registro completo en modo lectura.</p></div><div class="vm-card-form space-y-4"><p><strong>ID:</strong> {{ $marca->id }}</p><p><strong>Nombre:</strong> {{ $marca->nombre }}</p><div><strong>Imagen:</strong><div class="mt-2">@include('plantilla.imagen-tabla', ['imagen' => $marca->imagen, 'alt' => $marca->nombre])</div></div><div class="flex gap-3 pt-4"><a href="/marcas" class="vm-btn-secondary">Volver</a><a href="/marcas/{{ $marca->id }}/editar" class="vm-btn-primary">Editar</a></div></div></div></section>
@endsection
