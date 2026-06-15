@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-lg">
            <div class="vm-page-header mb-8">
                <p class="vm-header-tag">Tabla marcas</p>
                <h1 class="vm-header-title">Nueva marca</h1>
                <p class="vm-header-desc">Registra fabricantes de vehiculos.</p>
            </div>
            <div class="vm-card-form">
                <form action="/marcas" method="POST" enctype="multipart/form-data" class="space-y-6">@csrf<div
                        class="grid gap-6 md:grid-cols-2">
                        <div><label class="vm-input-label" for="nombre">Nombre</label><input class="vm-input-text"
                                id="nombre" name="nombre" value="{{ old('nombre') }}" required></div>
                        <div><label class="vm-input-label" for="imagen">Imagen</label><input class="vm-input-text"
                                type="file" id="imagen" name="imagen" accept="image/*"></div>
                    </div>
                    <div class="flex justify-end gap-3 border-t border-gray-200 pt-6"><a href="/marcas"
                            class="vm-btn-secondary">Cancelar</a><button class="vm-btn-primary"
                            type="submit">Guardar</button></div>
                </form>
            </div>
        </div>
    </section>
@endsection
