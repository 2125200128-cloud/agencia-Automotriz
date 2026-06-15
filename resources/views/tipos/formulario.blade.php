@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-lg">
            <div class="vm-page-header mb-8">
                <p class="vm-header-tag">Tabla tipos</p>
                <h1 class="vm-header-title">Formulario de Tipos</h1>
                <p class="vm-header-desc">Administra los tipos y categorías de vehículos (ej. sedán, SUV, hatchback).</p>
            </div>
            <div class="vm-card-form">
                <form action="/tipos" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label for="nombre" class="vm-input-label">Nombre del tipo</label>
                            <input type="text" id="nombre" name="nombre" class="vm-input-text" required>
                        </div>
                        <div>
                            <label for="imagen" class="vm-input-label">Imagen ilustrativa</label>
                            <input type="file" id="imagen" name="imagen" accept="image/*" class="vm-input-text"
                                required>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 border-t border-gray-200 pt-6 sm:flex-row sm:justify-end">
                        <button type="reset" class="vm-btn-secondary">Limpiar</button>
                        <button type="submit" class="vm-btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
