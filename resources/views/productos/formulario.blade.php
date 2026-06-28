@extends('plantilla.base')

@section('dinamico')
<section class="vm-page-section">
    <div class="vm-container-lg">
        <div class="vm-page-header mb-8"><p class="vm-header-tag">Tabla productos</p><h1 class="vm-header-title">Nuevo producto</h1><p class="vm-header-desc">Registra un vehiculo con sus catalogos.</p></div>
        <div class="vm-card-form">
            <form action="/producto" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="md:col-span-2"><label class="vm-input-label" for="nombre">Nombre</label><input class="vm-input-text" id="nombre" name="nombre" value="{{ old('nombre') }}" required></div>
                    <div><label class="vm-input-label" for="numero_serie">Numero de serie</label><input class="vm-input-text" id="numero_serie" name="numero_serie" value="{{ old('numero_serie') }}"></div>
                    <div><label class="vm-input-label" for="anio">Anio</label><input class="vm-input-text" type="number" id="anio" name="anio" value="{{ old('anio') }}"></div>
                    <div class="md:col-span-2"><label class="vm-input-label" for="descripcion">Descripcion</label><textarea class="vm-input-text" id="descripcion" name="descripcion" rows="2">{{ old('descripcion') }}</textarea></div>
                    <div class="md:col-span-2"><label class="vm-input-label" for="detalles">Detalles</label><textarea class="vm-input-text" id="detalles" name="detalles" rows="3">{{ old('detalles') }}</textarea></div>
                    <div><label class="vm-input-label" for="marca_id">Marca</label><select class="vm-input-text" id="marca_id" name="marca_id"><option value="">Selecciona marca</option>@foreach ($marcas as $marca)<option value="{{ $marca->id }}" @selected(old('marca_id') == $marca->id)>{{ $marca->nombre }}</option>@endforeach</select></div>
                    <div><label class="vm-input-label" for="modelo_id">Modelo</label><select class="vm-input-text" id="modelo_id" name="modelo_id"><option value="">Selecciona modelo</option>@foreach ($modelos as $modelo)<option value="{{ $modelo->id }}" @selected(old('modelo_id') == $modelo->id)>{{ $modelo->nombre }}</option>@endforeach</select></div>
                    <div><label class="vm-input-label" for="tipo_id">Tipo</label><select class="vm-input-text" id="tipo_id" name="tipo_id"><option value="">Selecciona tipo</option>@foreach ($tipos as $tipo)<option value="{{ $tipo->id }}" @selected(old('tipo_id') == $tipo->id)>{{ $tipo->nombre }}</option>@endforeach</select></div>
                    <div><label class="vm-input-label" for="color_id">Color</label><select class="vm-input-text" id="color_id" name="color_id"><option value="">Selecciona color</option>@foreach ($colores as $color)<option value="{{ $color->id }}" @selected(old('color_id') == $color->id)>{{ $color->nombre }}</option>@endforeach</select></div>
                    <div class="md:col-span-2"><label class="vm-input-label" for="proveedor_id">Proveedor</label><select class="vm-input-text" id="proveedor_id" name="proveedor_id"><option value="">Selecciona proveedor</option>@foreach ($proveedores as $proveedor)<option value="{{ $proveedor->id }}" @selected(old('proveedor_id') == $proveedor->id)>{{ $proveedor->nombre }}</option>@endforeach</select></div>
                    <div>
                        <label class="vm-input-label" for="precio">Precio</label>
                        <div class="flex gap-2">
                            <input class="vm-input-text" type="number" step="0.01" id="precio" name="precio" value="{{ old('precio') }}" required>
                            <button type="button" id="btn-abrir-val-rapida" class="rounded-xl bg-gray-800 hover:bg-gray-700 px-4 text-xs font-bold text-white transition flex-shrink-0">
                                Valuar
                            </button>
                        </div>
                    </div>
                    <div><label class="vm-input-label" for="existencia">Existencia</label><input class="vm-input-text" type="number" id="existencia" name="existencia" value="{{ old('existencia', 0) }}" required></div>
                    <div><label class="vm-input-label" for="descuento">Descuento</label><input class="vm-input-text" type="number" step="0.01" id="descuento" name="descuento" value="{{ old('descuento', 0) }}"></div>
                    <div><label class="vm-input-label" for="estado">Estado</label><select class="vm-input-text" id="estado" name="estado" required><option value="activo" @selected(old('estado', 'activo') === 'activo')>Activo</option><option value="inactivo" @selected(old('estado') === 'inactivo')>Inactivo</option></select></div>
                    <div><label class="vm-input-label" for="imagen_principal">Imagen principal</label><input class="vm-input-text" type="file" id="imagen_principal" name="imagen_principal" accept="image/*" required></div>
                    <div><label class="vm-input-label" for="imagen_secundaria">Imagen secundaria</label><input class="vm-input-text" type="file" id="imagen_secundaria" name="imagen_secundaria" accept="image/*" required></div>
                    <div><label class="vm-input-label" for="imagen_adicional">Imagen adicional</label><input class="vm-input-text" type="file" id="imagen_adicional" name="imagen_adicional" accept="image/*" required></div>

                    <!-- Widget de Valuación Rápida -->
                    <div id="seccion-val-rapida" class="hidden md:col-span-2 bg-[#e8f1ff]/35 border border-[#1c69d4]/30 rounded-xl p-5 space-y-4">
                        <div class="flex justify-between items-center border-b border-[#1c69d4]/10 pb-2">
                            <h4 class="font-bold text-[#003f7d] text-sm">Valuación Rápida de Usados</h4>
                            <button type="button" id="btn-cerrar-val-rapida" class="text-xs text-gray-400 hover:text-gray-600 font-bold">Cerrar</button>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-4 text-xs">
                            <div>
                                <label class="vm-input-label !text-xs">Kilometraje</label>
                                <input type="number" id="val-rapida-km" placeholder="Ej. 50000" class="vm-input-text !p-2 !text-xs">
                            </div>
                            <div>
                                <label class="vm-input-label !text-xs">Año del Vehículo</label>
                                <input type="number" id="val-rapida-anio" placeholder="Ej. 2019" class="vm-input-text !p-2 !text-xs">
                            </div>
                            <div>
                                <label class="vm-input-label !text-xs">Condición</label>
                                <select id="val-rapida-condicion" class="vm-input-text !p-2 !text-xs">
                                    <option value="excelente">Excelente</option>
                                    <option value="buena" selected>Buena</option>
                                    <option value="regular">Regular</option>
                                    <option value="mala">Mala</option>
                                </select>
                            </div>
                            <div class="flex items-end">
                                <button type="button" id="btn-ejecutar-val-rapida" class="vm-btn-primary !p-2 w-full !text-xs !h-9 flex items-center justify-center">Calcular</button>
                            </div>
                        </div>
                        <div id="val-rapida-resultados" class="hidden bg-white p-3 rounded-lg border border-[#cce0ff] flex justify-between items-center text-xs">
                            <div>
                                <p class="font-bold text-gray-700">Precio Sugerido Venta:</p>
                                <p class="text-lg font-black text-[#1c69d4]" id="val-rapida-precio-res">$0.00</p>
                            </div>
                            <button type="button" id="btn-aplicar-val-rapida" class="rounded-lg bg-green-600 hover:bg-green-700 text-white font-bold px-3 py-1.5 transition">
                                Aplicar este Precio
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-3 border-t border-gray-200 pt-6"><a href="/producto" class="vm-btn-secondary">Cancelar</a><button class="vm-btn-primary" type="submit">Guardar</button></div>
            </form>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnAbrir = document.getElementById('btn-abrir-val-rapida');
        const btnCerrar = document.getElementById('btn-cerrar-val-rapida');
        const seccion = document.getElementById('seccion-val-rapida');

        const btnEjecutar = document.getElementById('btn-ejecutar-val-rapida');
        const resultsDiv = document.getElementById('val-rapida-resultados');
        const precioRes = document.getElementById('val-rapida-precio-res');
        const btnAplicar = document.getElementById('btn-aplicar-val-rapida');

        if(btnAbrir) {
            btnAbrir.addEventListener('click', function() {
                seccion.classList.remove('hidden');

                const anioOriginal = document.getElementById('anio').value;
                if(anioOriginal) {
                    document.getElementById('val-rapida-anio').value = anioOriginal;
                }
            });
        }

        if(btnCerrar) {
            btnCerrar.addEventListener('click', function() {
                seccion.classList.add('hidden');
            });
        }

        let calculatedPrice = 0;

        if(btnEjecutar) {
            btnEjecutar.addEventListener('click', function() {
                const anio = document.getElementById('val-rapida-anio').value;
                const km = document.getElementById('val-rapida-km').value;
                const condicion = document.getElementById('val-rapida-condicion').value;

                const nombreInput = document.getElementById('nombre').value || '';
                const marcaSelect = document.getElementById('marca_id');
                const marcaText = (marcaSelect && marcaSelect.selectedIndex > 0) ? marcaSelect.options[marcaSelect.selectedIndex].text : 'Generico';

                if(!anio || !km) {
                    alert('Por favor ingrese el kilometraje y año del vehículo.');
                    return;
                }

                btnEjecutar.disabled = true;
                btnEjecutar.textContent = 'Calculando...';

                fetch('{{ url("/api/valuar-vehiculo") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        marca: marcaText,
                        modelo: nombreInput || 'Vehiculo',
                        anio: anio,
                        kilometraje: km,
                        condicion: condicion
                    })
                })
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) {
                        throw data;
                    }
                    return data;
                })
                .then(data => {
                    btnEjecutar.disabled = false;
                    btnEjecutar.textContent = 'Calcular';

                    if(data.success) {
                        resultsDiv.classList.remove('hidden');
                        calculatedPrice = data.venta_sugerida;

                        const formatter = new Intl.NumberFormat('es-MX', {
                            style: 'currency',
                            currency: 'MXN',
                            minimumFractionDigits: 0
                        });
                        precioRes.textContent = formatter.format(data.venta_sugerida);
                    } else {
                        alert('Error al calcular valuación.');
                    }
                })
                .catch(error => {
                    btnEjecutar.disabled = false;
                    btnEjecutar.textContent = 'Calcular';
                    console.error('Error:', error);
                    alert('Error en el servicio de valuación.');
                });
            });
        }

        if(btnAplicar) {
            btnAplicar.addEventListener('click', function() {
                if(calculatedPrice > 0) {
                    document.getElementById('precio').value = calculatedPrice;
                    seccion.classList.add('hidden');
                }
            });
        }
    });
</script>
@endsection
