@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-12 sm:px-6 lg:px-8 relative overflow-hidden">
    <div class="absolute top-1/4 left-1/3 w-96 h-96 bg-red-600/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="mx-auto max-w-4xl relative z-10">
        <div class="mb-10 border-l-4 border-red-500 pl-5">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-red-300">Mi Cuenta</p>
            <h1 class="mt-3 text-3xl font-black text-white sm:text-4xl">Mis Pedidos</h1>
            <p class="mt-2 text-gray-400">Consulta el estado de tus compras y sigue el proceso de entrega.</p>
        </div>

        <div class="rounded-2xl border border-white/10 bg-zinc-950 p-6 sm:p-8">
            <h3 class="text-lg font-bold text-white mb-4">Buscar mi pedido</h3>
            <div class="flex gap-3">
                <input type="text" id="buscar-folio" placeholder="Ingresa tu número de folio (ej: ORD-1024)" class="flex-1 rounded-xl border border-white/10 bg-black p-3 text-white placeholder:text-gray-500 focus:border-red-500 focus:ring-red-500">
                <button onclick="buscarPedido()" class="rounded-xl bg-red-600 px-6 py-3 font-bold text-white transition hover:bg-red-500">Buscar</button>
            </div>
        </div>

        <div id="resultado-pedido" class="mt-8 space-y-6">

            <div class="rounded-2xl border border-white/10 bg-zinc-950 p-6 sm:p-8">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">Folio</p>
                        <h2 class="mt-1 text-2xl font-black text-white">#ORD-1025</h2>
                        <p class="mt-1 text-sm text-gray-400">Fecha de compra: 27/05/2026</p>
                    </div>
                    <span class="self-start rounded-full bg-green-500/15 px-4 py-1.5 text-sm font-bold text-green-300">Pagado</span>
                </div>

                <div class="mt-6 rounded-xl border border-white/10 bg-black/50 p-5">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="font-bold text-white text-lg">Nissan Skyline GT-R R34</p>
                            <p class="text-sm text-gray-400 mt-0.5">Coupé deportivo · 1999 · Blanco</p>
                        </div>
                        <p class="text-xl font-black text-white">$1,850,000 <span class="text-xs font-normal text-gray-400">MXN</span></p>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-6">Seguimiento del pedido</h3>
                    <div class="relative">
                        <div class="absolute top-5 left-5 right-5 h-0.5 bg-white/10"></div>
                        <div class="absolute top-5 left-5 h-0.5 bg-red-500 transition-all duration-500" style="width: 33%;"></div>

                        <div class="relative flex justify-between">
                            <div class="flex flex-col items-center text-center w-1/4">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-red-600 text-white font-bold text-sm ring-4 ring-red-600/20">
                                    ✓
                                </div>
                                <p class="mt-3 text-xs font-bold text-white">Confirmado</p>
                                <p class="text-[10px] text-gray-500 mt-0.5">27/05/2026</p>
                            </div>
                            <div class="flex flex-col items-center text-center w-1/4">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-red-600 text-white font-bold text-sm ring-4 ring-red-600/20">
                                    ✓
                                </div>
                                <p class="mt-3 text-xs font-bold text-white">En proceso</p>
                                <p class="text-[10px] text-gray-500 mt-0.5">28/05/2026</p>
                            </div>
                            <div class="flex flex-col items-center text-center w-1/4">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-white/20 bg-zinc-900 text-gray-500 font-bold text-sm">
                                    3
                                </div>
                                <p class="mt-3 text-xs font-bold text-gray-500">Enviado</p>
                                <p class="text-[10px] text-gray-600 mt-0.5">—</p>
                            </div>
                            <div class="flex flex-col items-center text-center w-1/4">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-white/20 bg-zinc-900 text-gray-500 font-bold text-sm">
                                    4
                                </div>
                                <p class="mt-3 text-xs font-bold text-gray-500">Entregado</p>
                                <p class="text-[10px] text-gray-600 mt-0.5">—</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-3 border-t border-white/10 pt-6">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Método de pago</p>
                        <p class="mt-1 font-bold text-white">Transferencia bancaria</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Referencia de pago</p>
                        <p class="mt-1 font-bold text-white">PAY-78A3F</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Entrega estimada</p>
                        <p class="mt-1 font-bold text-white">05/06/2026</p>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-white/10 bg-zinc-950 p-5 flex items-start gap-4">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-600/15 text-red-400 text-lg">?</div>
                <div>
                    <p class="font-bold text-white">¿Tienes dudas sobre tu pedido?</p>
                    <p class="mt-1 text-sm text-gray-400">Contáctanos al <span class="text-white font-bold">(55) 1234-5678</span> o escríbenos a <span class="text-red-300 font-bold">soporte@velocemotors.mx</span></p>
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
        document.getElementById('resultado-pedido').scrollIntoView({ behavior: 'smooth' });
    }
</script>
@endsection
