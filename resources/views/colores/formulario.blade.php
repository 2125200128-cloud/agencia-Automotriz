@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-lg">
            <div class="vm-page-header mb-8">
                <p class="vm-header-tag">Tabla colores</p>
                <h1 class="vm-header-title">Nuevo color</h1>
                <p class="vm-header-desc">Registra colores del inventario.</p>
            </div>
            <div class="vm-card-form">
                <form action="/colores" method="POST" enctype="multipart/form-data" class="space-y-6">@csrf<div
                        class="grid gap-6 md:grid-cols-2">
                        <div><label class="vm-input-label" for="nombre">Nombre</label><input class="vm-input-text"
                                id="nombre" name="nombre" value="{{ old('nombre') }}" required></div>
                        <div><label class="vm-input-label" for="imagen">Imagen</label><input class="vm-input-text"
                                type="file" id="imagen" name="imagen" accept="image/*"></div>
                    </div>
                    <div class="flex justify-end gap-3 border-t border-gray-200 pt-6"><a href="/colores"
                            class="vm-btn-secondary">Cancelar</a><button class="vm-btn-primary"
                            type="submit">Guardar</button></div>
                </form>
            </div>
        </div>
    </section>
@endsection
