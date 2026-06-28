@extends('plantilla.base')

@section('dinamico')
<section class="vm-page-section">
    <div class="vm-container-lg">
        <div class="vm-page-header mb-8">
            <p class="vm-header-tag">Herramientas de Valuación</p>
            <h1 class="vm-header-title">Valuador de Autos Usados</h1>
            <p class="vm-header-desc">Calcula el precio justo de compra y venta estimado del mercado para vehículos seminuevos.</p>
        </div>

        <div class="grid gap-8 md:grid-cols-3">
            <!-- Formulario de Entrada -->
            <div class="md:col-span-1">
                <div class="vm-card-form h-full">
                    <h3 class="font-bold text-gray-900 text-lg mb-4">Detalles del Vehículo</h3>
                    <form id="form-valuacion" class="space-y-4">
                        @csrf
                        <div>
                            <label for="val-marca" class="vm-input-label">Marca</label>
                            <input type="text" id="val-marca" placeholder="Ej. Audi, Toyota..." class="vm-input-text" required>
                        </div>
                        <div>
                            <label for="val-modelo" class="vm-input-label">Modelo</label>
                            <input type="text" id="val-modelo" placeholder="Ej. A4, Corolla..." class="vm-input-text" required>
                        </div>
                        <div>
                            <label for="val-anio" class="vm-input-label">Año</label>
                            <input type="number" id="val-anio" min="1990" max="{{ date('Y') + 1 }}" placeholder="Ej. 2018" class="vm-input-text" required>
                        </div>
                        <div>
                            <label for="val-km" class="vm-input-label">Kilometraje</label>
                            <input type="number" id="val-km" min="0" placeholder="Ej. 65000" class="vm-input-text" required>
                        </div>
                        <div>
                            <label for="val-condicion" class="vm-input-label">Condición Física</label>
                            <select id="val-condicion" class="vm-input-text" required>
                                <option value="excelente">Excelente (Impecable)</option>
                                <option value="buena" selected>Buena (Detalles mínimos)</option>
                                <option value="regular">Regular (Requiere hojalatería/mantenimiento)</option>
                                <option value="mala">Mala (Fallas mecánicas o estéticas graves)</option>
                            </select>
                        </div>
                        <button type="submit" id="btn-calcular-valuacion" class="vm-btn-primary-full mt-2">
                            Calcular Valuación
                        </button>
                    </form>
                </div>
            </div>

            <!-- Panel de Resultados de Valuación (Dinámico) -->
            <div class="md:col-span-2">
                <div class="vm-card flex flex-col justify-center items-center h-full text-center p-8 min-h-[400px]">
                    <div id="resultado-vacio" class="space-y-3">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-xl">Calculadora de Depreciación</h3>
                        <p class="text-sm text-gray-500 max-w-sm">Ingresa los datos del auto en el formulario y haz clic en "Calcular Valuación" para ver la estimación de precios y márgenes sugeridos.</p>
                    </div>

                    <div id="resultado-cargando" class="hidden">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-[#1c69d4] mx-auto mb-4"></div>
                        <p class="text-gray-900 font-medium">Analizando datos del mercado automotriz...</p>
                        <p class="text-xs text-gray-400">Aplicando curvas de depreciación y kilometraje</p>
                    </div>

                    <div id="resultado-exito" class="hidden w-full space-y-6 text-left">
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="font-black text-gray-900 text-2xl" id="res-titulo">Audi A4 (2018)</h3>
                            <p class="text-xs text-[#1c69d4] font-bold uppercase tracking-wider mt-1" id="res-mensaje"></p>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <!-- Precio para ofrecer al cliente -->
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 flex flex-col justify-between">
                                <div>
                                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Valor de Compra de la Agencia</span>
                                    <span class="text-xs text-gray-400 block mb-2">(Lo que debes ofrecer al cliente por el auto)</span>
                                </div>
                                <span class="font-black text-green-700 text-3xl block" id="res-compra">$0.00</span>
                            </div>

                            <!-- Precio sugerido de venta -->
                            <div class="bg-[#e8f1ff] rounded-xl p-5 border border-[#cce0ff] flex flex-col justify-between">
                                <div>
                                    <span class="text-xs font-semibold text-[#003f7d] uppercase tracking-wider block">Precio de Venta Sugerido</span>
                                    <span class="text-xs text-[#1c69d4]/80 block mb-2">(Precio de lista para reventa al público)</span>
                                </div>
                                <span class="font-black text-[#1c69d4] text-3xl block" id="res-venta">$0.00</span>
                            </div>
                        </div>

                        <!-- Rango de Mercado -->
                        <div class="bg-white rounded-xl p-5 border border-gray-200">
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-3">Rango de Venta en Mercado General</span>
                            <div class="flex justify-between items-center text-xs font-bold text-gray-600 mb-1">
                                <span id="res-rango-bajo">$0.00</span>
                                <span class="text-[#1c69d4]" id="res-rango-medio">$0.00 (Promedio)</span>
                                <span id="res-rango-alto">$0.00</span>
                            </div>
                            <!-- Barra Visual -->
                            <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden flex">
                                <div class="bg-gray-200 h-full w-[25%]"></div>
                                <div class="bg-[#1c69d4]/60 h-full w-[50%]"></div>
                                <div class="bg-gray-200 h-full w-[25%]"></div>
                            </div>
                        </div>

                        <!-- Advertencias y Notas -->
                        <div class="text-xs text-gray-400 space-y-1">
                            <p class="font-bold text-gray-600">Consideraciones administrativas:</p>
                            <p>• Los precios calculados incluyen un margen promedio de ganancia del 22% para gastos operativos y de garantía.</p>
                            <p>• Valuador referencial. Es obligatorio hacer inspección física y mecánica en taller antes de cerrar el trato.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formVal = document.getElementById('form-valuacion');
        const btnVal = document.getElementById('btn-calcular-valuacion');

        const cardVacio = document.getElementById('resultado-vacio');
        const cardCargando = document.getElementById('resultado-cargando');
        const cardExito = document.getElementById('resultado-exito');

        const resTitulo = document.getElementById('res-titulo');
        const resMensaje = document.getElementById('res-mensaje');
        const resCompra = document.getElementById('res-compra');
        const resVenta = document.getElementById('res-venta');
        const resRangoBajo = document.getElementById('res-rango-bajo');
        const resRangoMedio = document.getElementById('res-rango-medio');
        const resRangoAlto = document.getElementById('res-rango-alto');

        if(formVal) {
            formVal.addEventListener('submit', function(e) {
                e.preventDefault();

                const marca = document.getElementById('val-marca').value.trim();
                const modelo = document.getElementById('val-modelo').value.trim();
                const anio = document.getElementById('val-anio').value;
                const km = document.getElementById('val-km').value;
                const condicion = document.getElementById('val-condicion').value;

                cardVacio.classList.add('hidden');
                cardExito.classList.add('hidden');
                cardCargando.classList.remove('hidden');
                btnVal.disabled = true;

                setTimeout(function() {
                    fetch('{{ url("/api/valuar-vehiculo") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            marca: marca,
                            modelo: modelo,
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
                        btnVal.disabled = false;
                        cardCargando.classList.add('hidden');

                        if(data.success) {
                            cardExito.classList.remove('hidden');

                            resTitulo.textContent = `${data.marca} ${data.modelo} (${data.anio})`;
                            resMensaje.textContent = data.message;

                            const formatter = new Intl.NumberFormat('es-MX', {
                                style: 'currency',
                                currency: 'MXN',
                                minimumFractionDigits: 0
                            });

                            resCompra.textContent = formatter.format(data.compra_sugerida);
                            resVenta.textContent = formatter.format(data.venta_sugerida);
                            resRangoBajo.textContent = formatter.format(data.rango_bajo);
                            resRangoMedio.textContent = formatter.format(data.venta_sugerida);
                            resRangoAlto.textContent = formatter.format(data.rango_alto);
                        } else {
                            cardVacio.classList.remove('hidden');
                            alert('Ocurrió un error al procesar la valuación.');
                        }
                    })
                    .catch(error => {
                        btnVal.disabled = false;
                        cardCargando.classList.add('hidden');
                        cardVacio.classList.remove('hidden');
                        console.error('Error de valuación:', error);
                        alert('Error al conectar con la API de Valuación.');
                    });
                }, 1000);
            });
        }
    });
</script>
@endsection
