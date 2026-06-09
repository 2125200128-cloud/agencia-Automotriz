@extends('plantilla.base')

@section('dinamico')
<section class="vm-page-section">
    <div class="vm-container-lg">
        <div class="vm-page-header mb-8"><p class="vm-header-tag">Editar proveedor</p><h1 class="vm-header-title">{{ $proveedor->nombre }}</h1><p class="vm-header-desc">Formulario cargado con los datos actuales.</p></div>
        @if ($errors->any())<div class="mb-6 rounded-xl border border-red-500/40 bg-red-950/30 p-4 text-red-200"><ul class="list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        <div class="vm-card-form">
            <form action="/proveedor/{{ $proveedor->id }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="md:col-span-2"><label class="vm-input-label" for="nombre">Nombre</label><input class="vm-input-text" id="nombre" name="nombre" value="{{ old('nombre', $proveedor->nombre) }}" required></div>
                    <div><label class="vm-input-label" for="contacto">Contacto</label><input class="vm-input-text" id="contacto" name="contacto" value="{{ old('contacto', $proveedor->contacto) }}"></div>
                    <div><label class="vm-input-label" for="telefono">Telefono</label><input class="vm-input-text" id="telefono" name="telefono" value="{{ old('telefono', $proveedor->telefono) }}"></div>
                    <div><label class="vm-input-label" for="correo">Correo</label><input class="vm-input-text" type="email" id="correo" name="correo" value="{{ old('correo', $proveedor->correo) }}"></div>
                    <div><label class="vm-input-label" for="estado">Estado</label><input class="vm-input-text" id="estado" name="estado" value="{{ old('estado', $proveedor->estado) }}" required></div>
                    <div class="md:col-span-2"><label class="vm-input-label" for="direccion">Direccion</label><textarea class="vm-input-text" id="direccion" name="direccion" rows="3">{{ old('direccion', $proveedor->direccion) }}</textarea></div>
                </div>
                <div class="flex justify-end gap-3 border-t border-gray-200 pt-6"><a href="/proveedor" class="vm-btn-secondary">Cancelar</a><button class="vm-btn-primary" type="submit">Actualizar</button></div>
            </form>
        </div>
    </div>
</section>
@endsection
