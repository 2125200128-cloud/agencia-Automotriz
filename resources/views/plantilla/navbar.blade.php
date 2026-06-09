@php
    $navLinkClass = function ($active) {
        return 'inline-flex px-3 py-2 transition ' .
            ($active
                ? 'bg-[#1c69d4] text-white rounded-lg shadow-[0_0_16px_rgba(28,105,212,0.28)]'
                : 'text-[#d8e2ef] hover:text-white hover:bg-[#172232] rounded-lg');
    };

    $dropdownLinkClass = function ($active = false) {
        return 'px-4 py-3 transition ' .
            ($active
                ? 'bg-[#1c69d4] text-white rounded-lg'
                : 'text-[#0b1f3a] hover:text-[#003f7d] hover:bg-[#e8f1ff] rounded-lg');
    };

    $inicioActive = request()->routeIs('inicio', 'dashboard') || request()->is('/', 'dashboard');
    $productosActive =
        request()->routeIs('productos.*', 'producto.*', 'productos', 'producto') ||
        request()->is('producto', 'producto/*', 'productos', 'productos/*');
    $clientesActive =
        request()->routeIs('clientes.*', 'cliente.*', 'clientes', 'cliente') ||
        request()->is('cliente', 'cliente/*', 'clientes', 'clientes/*');
    $pedidosActive =
        request()->routeIs('pedidos.*', 'pedido.*', 'pedidos', 'pedido') ||
        request()->is('pedido', 'pedido/*', 'pedidos', 'pedidos/*', 'productos-pedido', 'productos-pedido/*');
    $pagosActive =
        request()->routeIs('pagos.*', 'pago.*', 'pagos', 'pago') || request()->is('pagos', 'pagos/*', 'pago', 'pago/*');
    $proveedoresActive =
        request()->routeIs('proveedores.*', 'proveedor.*', 'proveedores', 'proveedor') ||
        request()->is('proveedor', 'proveedor/*', 'proveedores', 'proveedores/*');
    $catalogosActive =
        request()->routeIs('catalogos.*', 'catalogos', 'marcas.*', 'modelos.*', 'colores.*', 'tipos.*') ||
        request()->is(
            'catalogos',
            'catalogos/*',
            'marcas',
            'marcas/*',
            'modelos',
            'modelos/*',
            'colores',
            'colores/*',
            'tipos',
            'tipos/*',
        );
    $adminActive =
        request()->routeIs('administradores.*', 'administrador.*', 'administradores', 'administrador') ||
        request()->is('administrador', 'administrador/*', 'administradores', 'administradores/*');
@endphp
<nav class="vm-navbar">
    <div class="vm-navbar-container">
        <a href="/" class="flex items-center gap-3">
            <span
                class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-xl border border-[#2f3d4f] bg-black p-1 shadow-[0_0_18px_rgba(28,105,212,0.18)]">
                <img src="{{ asset('imagenes/logoVeloceMotors.png') }}" alt="Logo Veloce Motors"
                    class="h-full w-full object-contain">
            </span>
            <span>
                <span class="block text-xl font-semibold tracking-tight text-[#f8fafc]">Veloce Motors</span>
            </span>
        </a>
        <div class="flex flex-wrap items-center gap-1 text-sm font-medium">
            <a href="/" class="{{ $navLinkClass($inicioActive) }}">Iniciar sesion</a>
            <div class="group relative">
                <a href="/producto" class="{{ $navLinkClass($productosActive) }}">
                    Productos
                </a>
                <div class="absolute left-0 top-full z-50 hidden w-48 pt-2 group-hover:block">
                    <div class="vm-dropdown-menu">
                        <a href="/producto" class="{{ $dropdownLinkClass(request()->is('producto')) }}">Ver Catalogo</a>
                        <a href="/producto/formulario"
                            class="{{ $dropdownLinkClass(request()->is('producto/formulario')) }}">+ Agregar
                            Producto</a>
                    </div>
                </div>
            </div>
            <div class="group relative">
                <a href="/cliente" class="{{ $navLinkClass($clientesActive) }}">
                    Clientes
                </a>
                <div class="absolute left-0 top-full z-50 hidden w-48 pt-2 group-hover:block">
                    <div class="vm-dropdown-menu">
                        <a href="/cliente" class="{{ $dropdownLinkClass(request()->is('cliente')) }}">Ver Clientes</a>
                        <a href="/cliente/formulario"
                            class="{{ $dropdownLinkClass(request()->is('cliente/formulario')) }}">+ Nuevo Cliente</a>
                    </div>
                </div>
            </div>
            <div class="group relative">
                <a href="/pedido" class="{{ $navLinkClass($pedidosActive) }}">
                    Pedidos
                </a>
                <div class="absolute left-0 top-full z-50 hidden w-48 pt-2 group-hover:block">
                    <div class="vm-dropdown-menu">
                        <a href="/pedido" class="{{ $dropdownLinkClass(request()->is('pedido')) }}">Historial de
                            Pedidos</a>
                        <a href="/productos-pedido"
                            class="{{ $dropdownLinkClass(request()->is('productos-pedido')) }}">Productos por
                            Pedido</a>
                        <a href="/productos-pedido/formulario"
                            class="{{ $dropdownLinkClass(request()->is('productos-pedido/formulario')) }}">+ Agregar
                            Producto</a>
                    </div>
                </div>
            </div>
            <a href="/pagos" class="{{ $navLinkClass($pagosActive) }}">Pagos</a>
            <div class="group relative">
                <a href="/proveedor" class="{{ $navLinkClass($proveedoresActive) }}">
                    Proveedores
                </a>
                <div class="absolute left-0 top-full z-50 hidden w-48 pt-2 group-hover:block">
                    <div class="vm-dropdown-menu">
                        <a href="/proveedor" class="{{ $dropdownLinkClass(request()->is('proveedor')) }}">Ver
                            Proveedores</a>
                        <a href="/proveedor/formulario"
                            class="{{ $dropdownLinkClass(request()->is('proveedor/formulario')) }}">+ Anadir
                            Proveedor</a>
                    </div>
                </div>
            </div>
            <div class="group relative">
                <a href="/catalogos" class="{{ $navLinkClass($catalogosActive) }}">
                    Catalogos
                </a>
                <div class="absolute left-0 top-full z-50 hidden w-64 pt-2 group-hover:block">
                    <div class="vm-dropdown-menu">
                        <a href="/catalogos" class="{{ $dropdownLinkClass(request()->is('catalogos')) }}">Ver todos los
                            catalogos</a>
                        <a href="/marcas" class="{{ $dropdownLinkClass(request()->is('marcas')) }}">Marcas</a>
                        <a href="/marcas/formulario"
                            class="{{ $dropdownLinkClass(request()->is('marcas/formulario')) }}">+ Agregar marca</a>
                        <a href="/modelos" class="{{ $dropdownLinkClass(request()->is('modelos')) }}">Modelos</a>
                        <a href="/modelos/formulario"
                            class="{{ $dropdownLinkClass(request()->is('modelos/formulario')) }}">+ Agregar modelo</a>
                        <a href="/colores" class="{{ $dropdownLinkClass(request()->is('colores')) }}">Colores</a>
                        <a href="/colores/formulario"
                            class="{{ $dropdownLinkClass(request()->is('colores/formulario')) }}">+ Agregar color</a>
                        <a href="/tipos" class="{{ $dropdownLinkClass(request()->is('tipos')) }}">Tipos</a>
                        <a href="/tipos/formulario"
                            class="{{ $dropdownLinkClass(request()->is('tipos/formulario')) }}">+ Agregar tipo</a>
                    </div>
                </div>
            </div>
            <div class="group relative">
                <a href="/administrador" class="{{ $navLinkClass($adminActive) }}">
                    Admin
                </a>
                <div class="absolute right-0 top-full z-50 hidden w-48 pt-2 group-hover:block">
                    <div class="vm-dropdown-menu">
                        <a href="/administrador"
                            class="{{ $dropdownLinkClass(request()->is('administrador')) }}">Personal</a>
                        <a href="/administrador/formulario"
                            class="{{ $dropdownLinkClass(request()->is('administrador/formulario')) }}">+ Nuevo
                            Admin</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</nav>
