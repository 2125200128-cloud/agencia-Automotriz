@extends('plantilla.base')

@section('dinamico')
<section class="vm-page-section">
    <div class="vm-container-lg">
        <div class="vm-page-header mb-8"><p class="vm-header-tag">Editar producto</p><h1 class="vm-header-title">{{ $producto->nombre }}</h1><p class="vm-header-desc">Los selects muestran seleccionada la opcion guardada.</p></div>
        @if ($errors->any())<div class="mb-6 rounded-xl border border-red-500/40 bg-red-950/30 p-4 text-red-200"><ul class="list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        <div class="vm-card-form">
            <form action="/producto/{{ $producto->id }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="md:col-span-2"><label class="vm-input-label" for="nombre">Nombre</label><input class="vm-input-text" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required></div>
                    <div><label class="vm-input-label" for="numero_serie">Numero de serie</label><input class="vm-input-text" id="numero_serie" name="numero_serie" value="{{ old('numero_serie', $producto->numero_serie) }}"></div>
                    <div><label class="vm-input-label" for="anio">Anio</label><input class="vm-input-text" type="number" id="anio" name="anio" value="{{ old('anio', $producto->anio) }}"></div>
                    <div class="md:col-span-2"><label class="vm-input-label" for="descripcion">Descripcion</label><textarea class="vm-input-text" id="descripcion" name="descripcion" rows="2">{{ old('descripcion', $producto->descripcion) }}</textarea></div>
                    <div class="md:col-span-2"><label class="vm-input-label" for="detalles">Detalles</label><textarea class="vm-input-text" id="detalles" name="detalles" rows="3">{{ old('detalles', $producto->detalles) }}</textarea></div>
                    <div><label class="vm-input-label" for="marca_id">Marca</label><select class="vm-input-text" id="marca_id" name="marca_id"><option value="">Selecciona marca</option>@foreach ($marcas as $marca)<option value="{{ $marca->id }}" @selected(old('marca_id', $producto->marca_id) == $marca->id)>{{ $marca->nombre }}</option>@endforeach</select></div>
                    <div><label class="vm-input-label" for="modelo_id">Modelo</label><select class="vm-input-text" id="modelo_id" name="modelo_id"><option value="">Selecciona modelo</option>@foreach ($modelos as $modelo)<option value="{{ $modelo->id }}" @selected(old('modelo_id', $producto->modelo_id) == $modelo->id)>{{ $modelo->nombre }}</option>@endforeach</select></div>
                    <div><label class="vm-input-label" for="tipo_id">Tipo</label><select class="vm-input-text" id="tipo_id" name="tipo_id"><option value="">Selecciona tipo</option>@foreach ($tipos as $tipo)<option value="{{ $tipo->id }}" @selected(old('tipo_id', $producto->tipo_id) == $tipo->id)>{{ $tipo->nombre }}</option>@endforeach</select></div>
                    <div><label class="vm-input-label" for="color_id">Color</label><select class="vm-input-text" id="color_id" name="color_id"><option value="">Selecciona color</option>@foreach ($colores as $color)<option value="{{ $color->id }}" @selected(old('color_id', $producto->color_id) == $color->id)>{{ $color->nombre }}</option>@endforeach</select></div>
                    <div class="md:col-span-2"><label class="vm-input-label" for="proveedor_id">Proveedor</label><select class="vm-input-text" id="proveedor_id" name="proveedor_id"><option value="">Selecciona proveedor</option>@foreach ($proveedores as $proveedor)<option value="{{ $proveedor->id }}" @selected(old('proveedor_id', $producto->proveedor_id) == $proveedor->id)>{{ $proveedor->nombre }}</option>@endforeach</select></div>
                    <div><label class="vm-input-label" for="precio">Precio</label><input class="vm-input-text" type="number" step="0.01" id="precio" name="precio" value="{{ old('precio', $producto->precio) }}" required></div>
                    <div><label class="vm-input-label" for="existencia">Existencia</label><input class="vm-input-text" type="number" id="existencia" name="existencia" value="{{ old('existencia', $producto->existencia) }}" required></div>
                    <div><label class="vm-input-label" for="descuento">Descuento</label><input class="vm-input-text" type="number" step="0.01" id="descuento" name="descuento" value="{{ old('descuento', $producto->descuento) }}"></div>
                    <div><label class="vm-input-label" for="estado">Estado</label><select class="vm-input-text" id="estado" name="estado" required><option value="activo" @selected(old('estado', $producto->estado) === 'activo')>Activo</option><option value="inactivo" @selected(old('estado', $producto->estado) === 'inactivo')>Inactivo</option></select></div>
                    <div><label class="vm-input-label" for="imagen_principal">Imagen principal</label>@include('plantilla.imagen-tabla', ['imagen' => $producto->imagen_principal, 'alt' => $producto->nombre])<input class="vm-input-text mt-3" type="file" id="imagen_principal" name="imagen_principal" accept="image/*"></div>
                    <div><label class="vm-input-label" for="imagen_secundaria">Imagen secundaria</label>@include('plantilla.imagen-tabla', ['imagen' => $producto->imagen_secundaria, 'alt' => $producto->nombre])<input class="vm-input-text mt-3" type="file" id="imagen_secundaria" name="imagen_secundaria" accept="image/*"></div>
                    <div><label class="vm-input-label" for="imagen_adicional">Imagen adicional</label>@include('plantilla.imagen-tabla', ['imagen' => $producto->imagen_adicional, 'alt' => $producto->nombre])<input class="vm-input-text mt-3" type="file" id="imagen_adicional" name="imagen_adicional" accept="image/*"></div>
                </div>
                <div class="flex justify-end gap-3 border-t border-gray-200 pt-6"><a href="/producto" class="vm-btn-secondary">Cancelar</a><button class="vm-btn-primary" type="submit">Actualizar</button></div>
            </form>
        </div>
    </div>
</section>
@endsection
