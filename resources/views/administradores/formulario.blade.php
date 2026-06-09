@extends('plantilla.base')

@section('dinamico')
<section class="vm-page-section">
    <div class="vm-container-lg">
        <div class="vm-page-header mb-8">
            <p class="vm-header-tag">Tabla administradores</p>
            <h1 class="vm-header-title">Nuevo administrador</h1>
            <p class="vm-header-desc">Registra personal del equipo y asigna su rol de acceso.</p>
        </div>

        <div class="vm-card-form">
            <form action="/administrador" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid gap-6 md:grid-cols-2">
                    <div><label class="vm-input-label" for="nombres">Nombres</label><input class="vm-input-text" id="nombres" name="nombres" value="{{ old('nombres') }}" required></div>
                    <div><label class="vm-input-label" for="apellidos">Apellidos</label><input class="vm-input-text" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required></div>
                    <div><label class="vm-input-label" for="correo">Correo</label><input class="vm-input-text" type="email" id="correo" name="correo" value="{{ old('correo') }}" required></div>
                    <div><label class="vm-input-label" for="usuario">Usuario</label><input class="vm-input-text" id="usuario" name="usuario" value="{{ old('usuario') }}" required></div>
                    <div><label class="vm-input-label" for="contrasena">Contrasena</label><input class="vm-input-text" type="password" id="contrasena" name="contrasena" required></div>
                    <div><label class="vm-input-label" for="imagen">Imagen</label><input class="vm-input-text" type="file" id="imagen" name="imagen" accept="image/*"></div>
                    <div><label class="vm-input-label" for="rol">Rol</label><input class="vm-input-text" id="rol" name="rol" value="{{ old('rol', 'vendedor') }}" required></div>
                    <div><label class="vm-input-label" for="estado">Estado</label><input class="vm-input-text" id="estado" name="estado" value="{{ old('estado', 'activo') }}" required></div>
                </div>
                <div class="flex justify-end gap-3 border-t border-gray-200 pt-6">
                    <a href="/administrador" class="vm-btn-secondary">Cancelar</a>
                    <button class="vm-btn-primary" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
