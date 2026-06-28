@extends('plantilla.base')

@section('dinamico')
<section class="vm-page-section">
    <div class="vm-container-lg">
        <div class="vm-page-header mb-8"><p class="vm-header-tag">Tabla proveedores</p><h1 class="vm-header-title">Nuevo proveedor</h1><p class="vm-header-desc">Registra un nuevo proveedor comercial.</p></div>
        <div class="vm-card-form">
            <form action="/proveedor" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="md:col-span-2"><label class="vm-input-label" for="nombre">Nombre</label><input class="vm-input-text" id="nombre" name="nombre" value="{{ old('nombre') }}" required></div>
                    <div><label class="vm-input-label" for="contacto">Contacto</label><input class="vm-input-text" id="contacto" name="contacto" value="{{ old('contacto') }}"></div>
                    <div><label class="vm-input-label" for="telefono">Telefono</label><input class="vm-input-text" id="telefono" name="telefono" value="{{ old('telefono') }}"></div>
                    <div><label class="vm-input-label" for="correo">Correo</label><input class="vm-input-text" type="email" id="correo" name="correo" value="{{ old('correo') }}"></div>
                    <div><label class="vm-input-label" for="estado">Estado</label><select class="vm-input-text" id="estado" name="estado" required><option value="activo" @selected(old('estado', 'activo') === 'activo')>Activo</option><option value="inactivo" @selected(old('estado') === 'inactivo')>Inactivo</option></select></div>
                    <div class="md:col-span-2"><label class="vm-input-label" for="imagen">Imagen</label><input class="vm-input-text" type="file" id="imagen" name="imagen" accept="image/*" required></div>
                    <div class="md:col-span-2"><label class="vm-input-label" for="direccion">Direccion</label><textarea class="vm-input-text" id="direccion" name="direccion" rows="3">{{ old('direccion') }}</textarea></div>
                </div>
                <div class="flex justify-end gap-3 border-t border-gray-200 pt-6"><a href="/proveedor" class="vm-btn-secondary">Cancelar</a><button class="vm-btn-primary" type="submit">Guardar</button></div>
            </form>
        </div>
    </div>
</section>
@endsection
