@php
    $navLinkClass = function ($active) {
        return 'inline-flex px-3 py-2 transition ' . ($active
            ? 'bg-[#1c69d4] text-white rounded-lg shadow-[0_0_16px_rgba(28,105,212,0.28)]'
            : 'text-[#d8e2ef] hover:text-white hover:bg-[#172232] rounded-lg');
    };

    $dropdownLinkClass = function ($active = false) {
        return 'px-4 py-3 transition ' . ($active
            ? 'bg-[#1c69d4] text-white rounded-lg'
            : 'text-[#0b1f3a] hover:text-[#003f7d] hover:bg-[#e8f1ff] rounded-lg');
    };

    $inicioActive = request()->routeIs('inicio', 'dashboard') || request()->is('/', 'dashboard');
    $productosActive = request()->routeIs('productos.*', 'producto.*', 'productos', 'producto') || request()->is('producto', 'producto/*', 'productos', 'productos/*');
    $clientesActive = request()->routeIs('clientes.*', 'cliente.*', 'clientes', 'cliente') || request()->is('cliente', 'cliente/*', 'clientes', 'clientes/*');
    $pedidosActive = request()->routeIs('pedidos.*', 'pedido.*', 'pedidos', 'pedido') || request()->is('pedido', 'pedido/*', 'pedidos', 'pedidos/*', 'productos-pedido', 'productos-pedido/*');
    $pagosActive = request()->routeIs('pagos.*', 'pago.*', 'pagos', 'pago') || request()->is('pagos', 'pagos/*', 'pago', 'pago/*');
    $proveedoresActive = request()->routeIs('proveedores.*', 'proveedor.*', 'proveedores', 'proveedor') || request()->is('proveedor', 'proveedor/*', 'proveedores', 'proveedores/*');
    $catalogosActive = request()->routeIs('catalogos.*', 'catalogos', 'marcas.*', 'modelos.*', 'colores.*', 'tipos.*') || request()->is('catalogos', 'catalogos/*', 'marcas', 'marcas/*', 'modelos', 'modelos/*', 'colores', 'colores/*', 'tipos', 'tipos/*');
    $adminActive = request()->routeIs('administradores.*', 'administrador.*', 'administradores', 'administrador') || request()->is('administrador', 'administrador/*', 'administradores', 'administradores/*');
    $admin = Auth::guard('admin')->user();
    $puedeInventario = ($admin?->puede('inventario') ?? false) || ($admin?->puede('inventario_ver') ?? false);
    $puedeGestionarInventario = $admin?->puede('inventario') ?? false;
    $puedeCatalogos = $admin?->puede('catalogos') ?? false;
    $puedeVentas = $admin?->puede('ventas') ?? false;
    $puedeRegistrarVentas = $admin?->puede('ventas_registro') ?? false;
    $puedePagos = $admin?->puede('pagos') ?? false;
    $puedeCitas = $admin?->puede('citas') ?? false;
    $puedeValuador = $admin?->puede('valuador') ?? false;
    $puedeAdministracion = $admin?->puede('administracion') ?? false;
@endphp
<nav class="vm-navbar">
    <div class="vm-navbar-container">
        <a href="{{ Auth::guard('admin')->check() ? url('/dashboard') : url('/') }}" class="flex items-center gap-3">
            <span class="flex h-11 w-11 items-center justify-center overflow-hidden rounded-full border border-[#2f3d4f] bg-[#0f141b] shadow-[0_0_18px_rgba(28,105,212,0.18)]">
                <img src="{{ asset('imagenes/logovelocemotor.png') }}" alt="Logo Veloce Motors" class="h-full w-full object-cover">
            </span>
            <span>
                <span class="block text-xl font-semibold tracking-tight text-[#f8fafc]">Veloce Motors</span>
            </span>
        </a>
        <div class="flex flex-wrap items-center gap-1 text-sm font-medium">
            @auth('admin')
                <a href="{{ url('/dashboard') }}" class="{{ $navLinkClass($inicioActive) }}">Dashboard</a>
            @else
                <a href="{{ url('/') }}" class="{{ $navLinkClass(request()->routeIs('inicio')) }}">Inicio</a>
            @endauth
            @if ($puedeInventario)
                <div class="group relative">
                    <a href="/producto" class="{{ $navLinkClass($productosActive) }}">
                        Inventario
                    </a>
                    <div class="absolute left-0 top-full z-50 hidden w-48 pt-2 group-hover:block">
                        <div class="vm-dropdown-menu">
                            <a href="/producto" class="{{ $dropdownLinkClass(request()->is('producto')) }}">Ver inventario</a>
                            @if ($puedeGestionarInventario)
                                <a href="/producto/formulario" class="{{ $dropdownLinkClass(request()->is('producto/formulario')) }}">+ Nuevo vehiculo</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            @if ($puedeAdministracion)
                <div class="group relative">
                    <a href="/cliente" class="{{ $navLinkClass($clientesActive) }}">
                        Usuarios
                    </a>
                    <div class="absolute left-0 top-full z-50 hidden w-48 pt-2 group-hover:block">
                        <div class="vm-dropdown-menu">
                            <a href="/cliente" class="{{ $dropdownLinkClass(request()->is('cliente')) }}">Ver usuarios</a>
                            <a href="/cliente/formulario" class="{{ $dropdownLinkClass(request()->is('cliente/formulario')) }}">+ Nuevo usuario</a>
                        </div>
                    </div>
                </div>
            @endif
            @if ($puedeVentas || $puedeRegistrarVentas)
                <div class="group relative">
                    <a href="{{ $puedeVentas ? '/pedido' : '/pedido/formulario' }}" class="{{ $navLinkClass($pedidosActive) }}">
                        Ventas
                    </a>
                    <div class="absolute left-0 top-full z-50 hidden w-48 pt-2 group-hover:block">
                        <div class="vm-dropdown-menu">
                            @if ($puedeVentas)
                                <a href="/pedido" class="{{ $dropdownLinkClass(request()->is('pedido')) }}">Historial de ventas</a>
                                <a href="/productos-pedido" class="{{ $dropdownLinkClass(request()->is('productos-pedido')) }}">Detalle de ventas</a>
                            @endif
                            @if ($puedeRegistrarVentas)
                                <a href="/pedido/formulario" class="{{ $dropdownLinkClass(request()->is('pedido/formulario')) }}">+ Registrar venta</a>
                                <a href="/productos-pedido/formulario" class="{{ $dropdownLinkClass(request()->is('productos-pedido/formulario')) }}">+ Agregar detalle</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            @if ($puedePagos)
                <a href="/pagos" class="{{ $navLinkClass($pagosActive) }}">Cobros</a>
            @endif
            @if ($puedeCitas)
                <a href="{{ url('/administrador/citas') }}" class="{{ $navLinkClass(request()->is('administrador/citas')) }}">Agenda de pruebas</a>
            @endif
            @if ($puedeValuador)
                <a href="{{ url('/administrador/valuador') }}" class="{{ $navLinkClass(request()->is('administrador/valuador')) }}">Valuador</a>
            @endif
            @if ($puedeAdministracion)
                <div class="group relative">
                    <a href="/proveedor" class="{{ $navLinkClass($proveedoresActive) }}">
                        Socios
                    </a>
                    <div class="absolute left-0 top-full z-50 hidden w-48 pt-2 group-hover:block">
                        <div class="vm-dropdown-menu">
                            <a href="/proveedor" class="{{ $dropdownLinkClass(request()->is('proveedor')) }}">Ver socios</a>
                            <a href="/proveedor/formulario" class="{{ $dropdownLinkClass(request()->is('proveedor/formulario')) }}">+ Nuevo socio</a>
                        </div>
                    </div>
                </div>
            @endif
            @if ($puedeCatalogos)
                <div class="group relative">
                    <a href="/catalogos" class="{{ $navLinkClass($catalogosActive) }}">
                        Catalogos
                    </a>
                    <div class="absolute left-0 top-full z-50 hidden w-64 pt-2 group-hover:block">
                        <div class="vm-dropdown-menu">
                            <a href="/catalogos" class="{{ $dropdownLinkClass(request()->is('catalogos')) }}">Panel de catalogos</a>
                            <a href="/marcas" class="{{ $dropdownLinkClass(request()->is('marcas')) }}">Marcas</a>
                            <a href="/marcas/formulario" class="{{ $dropdownLinkClass(request()->is('marcas/formulario')) }}">+ Agregar marca</a>
                            <a href="/modelos" class="{{ $dropdownLinkClass(request()->is('modelos')) }}">Modelos</a>
                            <a href="/modelos/formulario" class="{{ $dropdownLinkClass(request()->is('modelos/formulario')) }}">+ Agregar modelo</a>
                            <a href="/colores" class="{{ $dropdownLinkClass(request()->is('colores')) }}">Colores</a>
                            <a href="/colores/formulario" class="{{ $dropdownLinkClass(request()->is('colores/formulario')) }}">+ Agregar color</a>
                            <a href="/tipos" class="{{ $dropdownLinkClass(request()->is('tipos')) }}">Tipos</a>
                            <a href="/tipos/formulario" class="{{ $dropdownLinkClass(request()->is('tipos/formulario')) }}">+ Agregar tipo</a>
                        </div>
                    </div>
                </div>
            @endif
            @if ($puedeAdministracion)
                <div class="group relative">
                    <a href="/administrador" class="{{ $navLinkClass($adminActive) }}">
                        Administracion
                    </a>
                    <div class="absolute right-0 top-full z-50 hidden w-56 pt-2 group-hover:block">
                        <div class="vm-dropdown-menu">
                            <a href="/administrador" class="{{ $dropdownLinkClass(request()->is('administrador')) }}">Equipo</a>
                            <a href="/administrador/formulario" class="{{ $dropdownLinkClass(request()->is('administrador/formulario')) }}">+ Nuevo integrante</a>
                        </div>
                    </div>
                </div>
            @endif
            @auth('admin')
                <form action="{{ route('logout') }}" method="POST" class="inline-flex">
                    @csrf
                    <button type="submit" class="inline-flex px-3 py-2 transition text-[#d8e2ef] hover:text-white hover:bg-[#172232] rounded-lg">
                        Cerrar sesion
                    </button>
                </form>
            @else
                <a href="{{ route('cliente.login') }}" class="{{ $navLinkClass(request()->routeIs('cliente.login', 'cliente.google.redirect', 'cliente.google.callback')) }}">
                    Google clientes
                </a>
            @endauth

        </div>
    </div>
</nav>
