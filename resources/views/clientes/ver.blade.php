@extends('plantilla.base')

@section('dinamico')
<section class="vm-page-section"><div class="vm-container-lg"><div class="vm-page-header mb-8"><p class="vm-header-tag">Detalle</p><h1 class="vm-header-title">{{ $cliente->nombres }} {{ $cliente->apellidos }}</h1><p class="vm-header-desc">Registro completo en modo lectura.</p></div><div class="vm-card-form space-y-4"><p><strong>ID:</strong> {{ $cliente->id }}</p><p><strong>Correo:</strong> {{ $cliente->correo }}</p><p><strong>Telefono:</strong> {{ $cliente->telefono ?? 'Sin registro' }}</p><p><strong>Direccion:</strong> {{ $cliente->direccion ?? 'Sin registro' }}</p><p><strong>Imagen:</strong> {{ $cliente->imagen ?? 'Sin imagen' }}</p><p><strong>Estado:</strong> {{ $cliente->estado }}</p><div class="flex gap-3 pt-4"><a href="/cliente" class="vm-btn-secondary">Volver</a><a href="/cliente/{{ $cliente->id }}/editar" class="vm-btn-primary">Editar</a></div></div></div></section>
@endsection
