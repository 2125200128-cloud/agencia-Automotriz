@extends('plantilla.base')

@section('dinamico')
<section class="vm-page-section"><div class="vm-container-lg"><div class="vm-page-header mb-8"><p class="vm-header-tag">Detalle</p><h1 class="vm-header-title">{{ $proveedor->nombre }}</h1><p class="vm-header-desc">Registro completo en modo lectura.</p></div><div class="vm-card-form space-y-4"><p><strong>ID:</strong> {{ $proveedor->id }}</p><p><strong>Contacto:</strong> {{ $proveedor->contacto ?? 'Sin registro' }}</p><p><strong>Telefono:</strong> {{ $proveedor->telefono ?? 'Sin registro' }}</p><p><strong>Correo:</strong> {{ $proveedor->correo ?? 'Sin registro' }}</p><p><strong>Direccion:</strong> {{ $proveedor->direccion ?? 'Sin registro' }}</p><p><strong>Estado:</strong> {{ $proveedor->estado }}</p><div class="flex gap-3 pt-4"><a href="/proveedor" class="vm-btn-secondary">Volver</a><a href="/proveedor/{{ $proveedor->id }}/editar" class="vm-btn-primary">Editar</a></div></div></div></section>
@endsection
