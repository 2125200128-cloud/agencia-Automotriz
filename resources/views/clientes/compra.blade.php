@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section flex items-center justify-center">
        <div class="vm-container-lg">
            <div class="vm-page-header mb-10">
                <p class="vm-header-tag">Proceso de Compra</p>
                <h1 class="vm-header-title">Completar Solicitud de Compra</h1>
                <p class="vm-header-desc">Ingresa tus datos de pago y facturación para asegurar el vehículo.</p>
            </div>
            <div class="grid gap-8 lg:grid-cols-[1fr_350px]">
                <div class="vm-card-form">
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <h3 class="text-lg font-bold text-black mb-4 border-b border-gray-200 pb-2">Datos Personales
                            </h3>
                            <div class="grid gap-6 md:grid-cols-2">
                                <div>
                                    <label for="nombre" class="vm-input-label">Nombre Completo</label>
                                    <input type="text" id="nombre" name="nombre" class="vm-input-text" required>
                                </div>
                                <div>
                                    <label for="telefono" class="vm-input-label">Teléfono</label>
                                    <input type="tel" id="telefono" name="telefono" class="vm-input-text" required>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-black mb-4 border-b border-gray-200 pb-2">Método de
                                Adquisición</h3>
                            <div class="grid gap-6 md:grid-cols-2">
                                <div>
                                    <label for="metodo" class="vm-input-label">Método de Pago</label>
                                    <select id="metodo" name="metodo" class="vm-input-text" required>
                                        <option value="transferencia">Transferencia Bancaria</option>
                                        <option value="financiamiento">Financiamiento / Crédito</option>
                                        <option value="tarjeta">Tarjeta de Crédito / Débito</option>
                                        <option value="efectivo">Pago de Contado en Agencia</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="enganche" class="vm-input-label">Enganche / Apartado (Mínimo 10%)</label>
                                    <input type="number" id="enganche" name="enganche" class="vm-input-text" required>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-3 border-t border-gray-200 pt-6 sm:flex-row sm:justify-end">
                            <a href="/" class="vm-btn-secondary text-center">Cancelar</a>
                            <button type="submit" class="vm-btn-primary">Enviar Solicitud</button>
                        </div>
                    </form>
                </div>
                <div>
                    <div class="sticky top-28 vm-card-form">
                        <h3 class="text-lg font-bold text-black mb-4 border-b border-gray-200 pb-2">Resumen</h3>
                        <div class="space-y-4">
                            <div
                                class="h-40 w-full rounded-xl bg-gray-100 overflow-hidden flex items-center justify-center">
                                <span class="text-sm text-gray-500 font-bold">Veloce Premium</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-black text-lg" id="display-compra-auto-nombre">Audi RS 7 Sportback
                                </h4>
                                <p class="text-xs text-gray-400 mt-0.5" id="display-compra-auto-tipo">Sedán deportivo</p>
                            </div>
                            <div class="pt-4 border-t border-gray-200 flex justify-between items-end">
                                <span class="text-gray-400 text-sm">Precio Total</span>
                                <span class="font-black text-black text-xl" id="display-compra-auto-precio">$1,890,000
                                    MXN</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const auto = urlParams.get('auto');
            const precio = urlParams.get('precio');
            const tipo = urlParams.get('tipo');
            if (auto) {
                document.getElementById('display-compra-auto-nombre').textContent = decodeURIComponent(auto);
            }
            if (precio) {
                document.getElementById('display-compra-auto-precio').textContent = decodeURIComponent(precio);
            }
            if (tipo) {
                document.getElementById('display-compra-auto-tipo').textContent = decodeURIComponent(tipo);
            }
        });
    </script>
@endsection
