@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-lg">
            <div class="vm-page-header mb-8">
                <p class="vm-header-tag">Editar cliente</p>
                <h1 class="vm-header-title">{{ $cliente->nombres }} {{ $cliente->apellidos }}</h1>
                <p class="vm-header-desc">Formulario cargado con los datos actuales.</p>
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
                <form action="/cliente/{{ $cliente->id }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf @method('PUT')<div class="grid gap-6 md:grid-cols-2">
                        <div><label class="vm-input-label" for="nombres">Nombres</label><input class="vm-input-text"
                                id="nombres" name="nombres" value="{{ old('nombres', $cliente->nombres) }}" required>
                        </div>
                        <div><label class="vm-input-label" for="apellidos">Apellidos</label><input class="vm-input-text"
                                id="apellidos" name="apellidos" value="{{ old('apellidos', $cliente->apellidos) }}"
                                required></div>
                        <div><label class="vm-input-label" for="correo">Correo</label><input class="vm-input-text"
                                type="email" id="correo" name="correo" value="{{ old('correo', $cliente->correo) }}"
                                required></div>
                        <div><label class="vm-input-label" for="telefono">Telefono</label><input class="vm-input-text"
                                id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}"></div>
                        <div><label class="vm-input-label" for="contrasena">Nueva contrasena</label><input
                                class="vm-input-text" type="password" id="contrasena" name="contrasena"></div>
                        <div><label class="vm-input-label" for="imagen">Imagen</label><input class="vm-input-text"
                                type="file" id="imagen" name="imagen" accept="image/*">
                            <p class="mt-2 text-xs text-gray-400">{{ $cliente->imagen ?? 'Sin imagen actual' }}</p>
                        </div>
                        <div><label class="vm-input-label" for="estado">Estado</label><input class="vm-input-text"
                                id="estado" name="estado" value="{{ old('estado', $cliente->estado) }}" required></div>
                        <div class="md:col-span-2"><label class="vm-input-label" for="direccion">Direccion</label>
                            <textarea class="vm-input-text" id="direccion" name="direccion" rows="3">{{ old('direccion', $cliente->direccion) }}</textarea>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 border-t border-gray-200 pt-6"><a href="/cliente"
                            class="vm-btn-secondary">Cancelar</a><button class="vm-btn-primary"
                            type="submit">Actualizar</button></div>
                </form>
            </div>
        </div>
    </section>
@endsection
