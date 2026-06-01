<nav class="sticky top-0 z-50 border-b border-white/10 bg-black/95 shadow-[0_0_28px_rgba(255,255,255,0.10)] backdrop-blur">
    <div class="mx-auto flex max-w-screen-2xl flex-col gap-4 px-4 py-4 lg:flex-row lg:items-center lg:justify-between">
        <a href="/" class="flex items-center gap-3">
            <span class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-full border border-white/25 bg-zinc-900/80 shadow-[0_0_22px_rgba(255,255,255,0.12)]">
                <img src="{{ asset('imagenes/logoVeloceMotors.png') }}" alt="Logo Veloce Motors" class="h-full w-full object-cover">
            </span>
            <span>
                <span class="block text-xl font-black text-white">Veloce Motors</span>
            </span>
        </a>

        <div class="flex flex-wrap items-center gap-1 text-sm font-semibold">
            <a href="/" class="rounded-lg px-3 py-2 text-gray-200 transition hover:bg-zinc-800 hover:text-white">Inicio</a>
            
            <div class="group relative">
                <a href="/producto" class="inline-flex rounded-lg px-3 py-2 text-gray-200 transition hover:bg-zinc-800 hover:text-white">
                    Productos
                </a>
                <div class="absolute left-0 top-full z-50 hidden w-48 pt-2 group-hover:block">
                    <div class="flex flex-col overflow-hidden rounded-xl border border-white/10 bg-zinc-900 shadow-xl">
                        <a href="/producto" class="px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">Ver Catalogo</a>
                        <a href="/producto/formulario" class="border-t border-white/5 px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">+ Agregar Producto</a>
                    </div>
                </div>
            </div>

            <div class="group relative">
                <a href="/cliente" class="inline-flex rounded-lg px-3 py-2 text-gray-200 transition hover:bg-zinc-800 hover:text-white">
                    Clientes
                </a>
                <div class="absolute left-0 top-full z-50 hidden w-48 pt-2 group-hover:block">
                    <div class="flex flex-col overflow-hidden rounded-xl border border-white/10 bg-zinc-900 shadow-xl">
                        <a href="/cliente" class="px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">Ver Clientes</a>
                        <a href="/cliente/formulario" class="border-t border-white/5 px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">+ Nuevo Cliente</a>
                    </div>
                </div>
            </div>

            <div class="group relative">
                <a href="/pedido" class="inline-flex rounded-lg px-3 py-2 text-gray-200 transition hover:bg-zinc-800 hover:text-white">
                    Pedidos
                </a>
                <div class="absolute left-0 top-full z-50 hidden w-48 pt-2 group-hover:block">
                    <div class="flex flex-col overflow-hidden rounded-xl border border-white/10 bg-zinc-900 shadow-xl">
                        <a href="/pedido" class="px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">Historial de Pedidos</a>
                        <a href="/pagos" class="border-t border-white/5 px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">Historial de Pagos</a>
                        <a href="/productos-pedido" class="border-t border-white/5 px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">Productos por Pedido</a>
                        <a href="/productos-pedido/formulario" class="border-t border-white/5 px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">+ Agregar Producto</a>
                    </div>
                </div>
            </div>

            <div class="group relative">
                <a href="/proveedor" class="inline-flex rounded-lg px-3 py-2 text-gray-200 transition hover:bg-zinc-800 hover:text-white">
                    Proveedores
                </a>
                <div class="absolute left-0 top-full z-50 hidden w-48 pt-2 group-hover:block">
                    <div class="flex flex-col overflow-hidden rounded-xl border border-white/10 bg-zinc-900 shadow-xl">
                        <a href="/proveedor" class="px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">Ver Proveedores</a>
                        <a href="/proveedor/formulario" class="border-t border-white/5 px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">+ Anadir Proveedor</a>
                    </div>
                </div>
            </div>

            <div class="group relative">
                <a href="/catalogos" class="inline-flex rounded-lg px-3 py-2 text-gray-200 transition hover:bg-zinc-800 hover:text-white">
                    Catalogos
                </a>
                <div class="absolute left-0 top-full z-50 hidden w-64 pt-2 group-hover:block">
                    <div class="flex flex-col overflow-hidden rounded-xl border border-white/10 bg-zinc-900 shadow-xl">
                        <a href="/catalogos" class="px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">Ver todos los catalogos</a>
                        <a href="/marcas" class="border-t border-white/5 px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">Marcas</a>
                        <a href="/marcas/formulario" class="border-t border-white/5 px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">+ Agregar marca</a>
                        <a href="/modelos" class="border-t border-white/5 px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">Modelos</a>
                        <a href="/modelos/formulario" class="border-t border-white/5 px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">+ Agregar modelo</a>
                        <a href="/colores" class="border-t border-white/5 px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">Colores</a>
                        <a href="/colores/formulario" class="border-t border-white/5 px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">+ Agregar color</a>
                        <a href="/tipos" class="border-t border-white/5 px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">Tipos</a>
                        <a href="/tipos/formulario" class="border-t border-white/5 px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">+ Agregar tipo</a>
                    </div>
                </div>
            </div>

            <div class="group relative">
                <a href="/administrador" class="inline-flex rounded-lg px-3 py-2 text-gray-200 transition hover:bg-zinc-800 hover:text-white">
                    Admin
                </a>
                <div class="absolute right-0 top-full z-50 hidden w-48 pt-2 group-hover:block">
                    <div class="flex flex-col overflow-hidden rounded-xl border border-white/10 bg-zinc-900 shadow-xl">
                        <a href="/administrador" class="px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">Personal</a>
                        <a href="/administrador/formulario" class="border-t border-white/5 px-4 py-3 text-gray-300 hover:bg-zinc-800 hover:text-white">+ Nuevo Admin</a>
                    </div>
                </div>
            </div>

            <a href="/cliente" class="ml-4 rounded-full bg-white px-5 py-2 text-black transition hover:bg-gray-200">Iniciar sesion</a>
        </div>
    </div>
</nav>
