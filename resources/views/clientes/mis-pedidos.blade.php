@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-lg">
            <div class="vm-page-header mb-10">
                <p class="vm-header-tag">Mi Cuenta</p>
                <h1 class="vm-header-title">Mis Pedidos</h1>
                <p class="vm-header-desc">Consulta el estado de tus compras y sigue el proceso de entrega.</p>
            </div>
            <div class="vm-card-form">
                <h3 class="text-lg font-bold text-black mb-4">Buscar mi pedido</h3>
                <div class="flex gap-3">
                    <input type="text" id="buscar-folio" placeholder="Ingresa tu número de folio (ej: ORD-1024)"
                        class="vm-input-text flex-1">
                    <button onclick="buscarPedido()" class="vm-btn-solid">Buscar</button>
                </div>
            </div>
            <div id="resultado-pedido" class="mt-8 space-y-6">
                <div class="vm-card-form">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">Folio</p>
                            <h2 class="mt-1 text-2xl font-black text-black">#ORD-1025</h2>
                            <p class="mt-1 text-sm text-gray-400">Fecha de compra: 27/05/2026</p>
                        </div>
                        <span
                            class="self-start rounded-full bg-gray-100 px-4 py-1.5 text-sm font-bold text-gray-700">Pagado</span>
                    </div>
                    <div class="mt-6 vm-card !bg-gray-50">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="font-bold text-black text-lg">Nissan Skyline GT-R R34</p>
                                <p class="text-sm text-gray-400 mt-0.5">Coupé deportivo · 1999 · Blanco</p>
                            </div>
                            <p class="text-xl font-black text-black">$1,850,000 <span
                                    class="text-xs font-normal text-gray-400">MXN</span></p>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-6">Seguimiento del pedido
                        </h3>
                        <div class="relative">
                            <div class="absolute top-5 left-5 right-5 h-0.5 bg-gray-50"></div>
                            <div class="absolute top-5 left-5 h-0.5 bg-gray-800 transition-all duration-500"
                                style="width: 33%;"></div>

                            <div class="relative flex justify-between">
                                <div class="flex flex-col items-center text-center w-1/4">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-black text-white font-bold text-sm ring-4 ring-gray-200">
                                        ✓
                                    </div>
                                    <p class="mt-3 text-xs font-bold text-black">Confirmado</p>
                                    <p class="text-[10px] text-gray-500 mt-0.5">27/05/2026</p>
                                </div>
                                <div class="flex flex-col items-center text-center w-1/4">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-black text-white font-bold text-sm ring-4 ring-gray-200">
                                        ✓
                                    </div>
                                    <p class="mt-3 text-xs font-bold text-black">En proceso</p>
                                    <p class="text-[10px] text-gray-500 mt-0.5">28/05/2026</p>
                                </div>
                                <div class="flex flex-col items-center text-center w-1/4">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-gray-300 bg-gray-100 text-gray-500 font-bold text-sm">
                                        3
                                    </div>
                                    <p class="mt-3 text-xs font-bold text-gray-500">Enviado</p>
                                    <p class="text-[10px] text-gray-600 mt-0.5">—</p>
                                </div>
                                <div class="flex flex-col items-center text-center w-1/4">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-gray-300 bg-gray-100 text-gray-500 font-bold text-sm">
                                        4
                                    </div>
                                    <p class="mt-3 text-xs font-bold text-gray-500">Entregado</p>
                                    <p class="text-[10px] text-gray-600 mt-0.5">—</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 grid gap-4 sm:grid-cols-3 border-t border-gray-200 pt-6">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Método de pago</p>
                            <p class="mt-1 font-bold text-black">Transferencia bancaria</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Referencia de pago</p>
                            <p class="mt-1 font-bold text-black">PAY-78A3F</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Entrega estimada</p>
                            <p class="mt-1 font-bold text-black">05/06/2026</p>
                        </div>
                    </div>
                </div>
                <div class="vm-card flex items-start gap-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gray-100 text-gray-700 text-lg">
                        ?</div>
                    <div>
                        <p class="font-bold text-black">¿Tienes dudas sobre tu pedido?</p>
                        <p class="mt-1 text-sm text-gray-400">Contáctanos al <span class="text-black font-bold">(55)
                                1234-5678</span> o escríbenos a <span
                                class="text-gray-700 font-bold">soporte@velocemotors.mx</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function buscarPedido() {
            const folio = document.getElementById('buscar-folio').value.trim();
            if (!folio) {
                alert('Por favor ingresa un número de folio.');
                return;
            }
            document.getElementById('resultado-pedido').scrollIntoView({
                behavior: 'smooth'
            });
        }
    </script>
@endsection
