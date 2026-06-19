@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-lg">
            <div class="vm-page-header mb-8">
                <p class="vm-header-tag">Editar administrador</p>
                <h1 class="vm-header-title">{{ $administrador->nombres }} {{ $administrador->apellidos }}</h1>
                <p class="vm-header-desc">Actualiza los datos actuales guardados en la base de datos.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-500/40 bg-red-950/30 p-4 text-red-200">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="vm-card-form">
                <form action="/administrador/{{ $administrador->id }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-6 md:grid-cols-2">
                        <div><label class="vm-input-label" for="nombres">Nombres</label><input class="vm-input-text"
                                id="nombres" name="nombres" value="{{ old('nombres', $administrador->nombres) }}"
                                required></div>
                        <div><label class="vm-input-label" for="apellidos">Apellidos</label><input class="vm-input-text"
                                id="apellidos" name="apellidos" value="{{ old('apellidos', $administrador->apellidos) }}"
                                required></div>
                        <div><label class="vm-input-label" for="correo">Correo</label><input class="vm-input-text"
                                type="email" id="correo" name="correo"
                                value="{{ old('correo', $administrador->correo) }}" required></div>
                        <div><label class="vm-input-label" for="usuario">Usuario</label><input class="vm-input-text"
                                id="usuario" name="usuario" value="{{ old('usuario', $administrador->usuario) }}"
                                required></div>
                        <div><label class="vm-input-label" for="contrasena">Nueva contrasena</label><input
                                class="vm-input-text" type="password" id="contrasena" name="contrasena"></div>
                        <div><label class="vm-input-label" for="imagen">Imagen</label>
                            @include('plantilla.imagen-tabla', [
                                'imagen' => $administrador->imagen,
                                'alt' => $administrador->nombres,
                            ])
                            <input class="vm-input-text" type="file" id="imagen" name="imagen" accept="image/*"></div>
                        <div><label class="vm-input-label" for="rol">Rol</label><input class="vm-input-text"
                                id="rol" name="rol" value="{{ old('rol', $administrador->rol) }}" required></div>
                        <div><label class="vm-input-label" for="estado">Estado</label><input class="vm-input-text"
                                id="estado" name="estado" value="{{ old('estado', $administrador->estado) }}" required>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 border-t border-gray-200 pt-6">
                        <a href="/administrador" class="vm-btn-secondary">Cancelar</a>
                        <button class="vm-btn-primary" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
