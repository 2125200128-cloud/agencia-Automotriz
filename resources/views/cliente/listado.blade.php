@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-screen-2xl">
        <div class="border-l-4 border-red-500 pl-5">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-red-300">Administración</p>
            <h1 class="mt-3 text-4xl font-black text-white sm:text-5xl">Buscador de Clientes</h1>
            <p class="mt-3 max-w-2xl text-gray-400">Busca y consulta los clientes registrados en la plataforma.</p>
        </div>

        <div class="mt-8 rounded-xl border border-white/10 bg-zinc-950 p-5">
            <div class="grid gap-4 lg:grid-cols-[1fr_200px_auto]">
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input type="search" id="buscar-cliente" placeholder="Buscar por nombre, correo o teléfono..." class="w-full rounded-lg border border-white/10 bg-black p-3 pl-12 text-white placeholder:text-gray-500 focus:border-red-500 focus:ring-red-500" oninput="filtrarClientes()">
                </div>
                <select id="filtro-estado" class="rounded-lg border border-white/10 bg-black p-3 text-white focus:border-red-500 focus:ring-red-500" onchange="filtrarClientes()">
                    <option value="todos">Todos los estados</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
                <button onclick="filtrarClientes()" class="rounded-lg border border-red-500/60 px-5 py-3 font-bold text-red-200 transition hover:bg-red-500 hover:text-white">Buscar</button>
            </div>
        </div>

        <div class="mt-8 overflow-hidden rounded-xl border border-white/10 bg-zinc-950">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-300">
                    <thead class="bg-black text-xs uppercase tracking-wider text-gray-400">
                        <tr>
                            <th class="px-6 py-4"></th>
                            <th class="px-6 py-4">Cliente</th>
                            <th class="px-6 py-4">Correo</th>
                            <th class="px-6 py-4">Teléfono</th>
                            <th class="px-6 py-4">Dirección</th>
                            <th class="px-6 py-4">Registro</th>
                            <th class="px-6 py-4">Estado</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-clientes" class="divide-y divide-white/5">
                        <tr class="fila-cliente hover:bg-white/5 transition" data-nombre="carlos mendoza" data-email="carlos.m@example.com" data-tel="5512345678" data-estado="activo">
                            <td class="px-6 py-4">
                                <img src="https://ui-avatars.com/api/?name=Carlos+Mendoza&background=0D8ABC&color=fff&rounded=true&size=40" alt="Avatar" class="h-10 w-10 rounded-full shadow-sm">
                            </td>
                            <td class="px-6 py-4 font-bold text-white">Carlos Mendoza</td>
                            <td class="px-6 py-4 text-white">carlos.m@example.com</td>
                            <td class="px-6 py-4">55 1234 5678</td>
                            <td class="px-6 py-4 truncate max-w-[200px]">Av. Insurgentes Sur 123, CDMX</td>
                            <td class="px-6 py-4 text-gray-400">15/05/2026</td>
                            <td class="px-6 py-4"><span class="rounded-full bg-green-500/15 px-3 py-1 text-xs font-bold text-green-300">Activo</span></td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="verPerfil('Carlos Mendoza')" class="rounded-lg bg-zinc-800 px-3 py-1 text-xs font-bold text-zinc-300 transition hover:bg-zinc-700">Ver perfil</button>
                            </td>
                        </tr>
                        <tr class="fila-cliente hover:bg-white/5 transition" data-nombre="ana torres" data-email="ana.torres@example.com" data-tel="3398765432" data-estado="activo">
                            <td class="px-6 py-4">
                                <img src="https://ui-avatars.com/api/?name=Ana+Torres&background=E53E3E&color=fff&rounded=true&size=40" alt="Avatar" class="h-10 w-10 rounded-full shadow-sm">
                            </td>
                            <td class="px-6 py-4 font-bold text-white">Ana Torres</td>
                            <td class="px-6 py-4 text-white">ana.torres@example.com</td>
                            <td class="px-6 py-4">33 9876 5432</td>
                            <td class="px-6 py-4 truncate max-w-[200px]">Paseo Andares 45, Guadalajara</td>
                            <td class="px-6 py-4 text-gray-400">18/05/2026</td>
                            <td class="px-6 py-4"><span class="rounded-full bg-green-500/15 px-3 py-1 text-xs font-bold text-green-300">Activo</span></td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="verPerfil('Ana Torres')" class="rounded-lg bg-zinc-800 px-3 py-1 text-xs font-bold text-zinc-300 transition hover:bg-zinc-700">Ver perfil</button>
                            </td>
                        </tr>
                        <tr class="fila-cliente hover:bg-white/5 transition opacity-70" data-nombre="luis rivera" data-email="l.rivera88@example.com" data-tel="8123456789" data-estado="inactivo">
                            <td class="px-6 py-4">
                                <img src="https://ui-avatars.com/api/?name=Luis+Rivera&background=718096&color=fff&rounded=true&size=40" alt="Avatar" class="h-10 w-10 rounded-full shadow-sm grayscale">
                            </td>
                            <td class="px-6 py-4 font-bold text-white">Luis Rivera</td>
                            <td class="px-6 py-4 text-white">l.rivera88@example.com</td>
                            <td class="px-6 py-4">81 2345 6789</td>
                            <td class="px-6 py-4 truncate max-w-[200px]">San Pedro Garza, Monterrey</td>
                            <td class="px-6 py-4 text-gray-400">02/04/2026</td>
                            <td class="px-6 py-4"><span class="rounded-full bg-zinc-800 px-3 py-1 text-xs font-bold text-zinc-400">Inactivo</span></td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="verPerfil('Luis Rivera')" class="rounded-lg bg-zinc-800 px-3 py-1 text-xs font-bold text-zinc-300 transition hover:bg-zinc-700">Ver perfil</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="sin-resultados" class="hidden p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <p class="mt-4 text-lg font-bold text-gray-400">No se encontraron clientes</p>
                <p class="mt-1 text-sm text-gray-500">Intenta con otro nombre, correo o teléfono.</p>
            </div>
        </div>

        <div id="modal-perfil" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4" onclick="cerrarModal(event)">
            <div class="w-full max-w-lg rounded-2xl border border-white/10 bg-zinc-950 p-6 shadow-[0_0_60px_rgba(0,0,0,0.8)] sm:p-8" onclick="event.stopPropagation()">
                <div class="flex items-start justify-between mb-6">
                    <h3 class="text-xl font-black text-white">Perfil del Cliente</h3>
                    <button onclick="document.getElementById('modal-perfil').classList.add('hidden'); document.getElementById('modal-perfil').classList.remove('flex');" class="rounded-lg bg-zinc-800 px-3 py-1 text-xs font-bold text-zinc-300 transition hover:bg-zinc-700">✕</button>
                </div>

                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-white/10">
                    <img id="modal-avatar" src="" alt="Avatar" class="h-16 w-16 rounded-full shadow-lg">
                    <div>
                        <p id="modal-nombre" class="text-lg font-black text-white"></p>
                        <p id="modal-estado" class="text-sm"></p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-500">Correo</p>
                            <p id="modal-email" class="mt-1 font-bold text-white text-sm"></p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-500">Teléfono</p>
                            <p id="modal-tel" class="mt-1 font-bold text-white text-sm"></p>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-500">Dirección</p>
                        <p id="modal-dir" class="mt-1 font-bold text-white text-sm"></p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-500">Fecha de registro</p>
                            <p id="modal-registro" class="mt-1 font-bold text-white text-sm"></p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-500">Total de compras</p>
                            <p id="modal-compras" class="mt-1 font-bold text-white text-sm"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function filtrarClientes() {
        const busqueda = document.getElementById('buscar-cliente').value.toLowerCase().trim();
        const estadoFiltro = document.getElementById('filtro-estado').value;
        const filas = document.querySelectorAll('.fila-cliente');
        let visibles = 0;

        filas.forEach(fila => {
            const nombre = fila.dataset.nombre;
            const email = fila.dataset.email;
            const tel = fila.dataset.tel;
            const estado = fila.dataset.estado;

            const coincideTexto = !busqueda || nombre.includes(busqueda) || email.includes(busqueda) || tel.includes(busqueda);
            const coincideEstado = estadoFiltro === 'todos' || estado === estadoFiltro;

            if (coincideTexto && coincideEstado) {
                fila.classList.remove('hidden');
                visibles++;
            } else {
                fila.classList.add('hidden');
            }
        });

        document.getElementById('sin-resultados').classList.toggle('hidden', visibles > 0);
    }

    const clientesData = {
        'Carlos Mendoza': { email: 'carlos.m@example.com', tel: '55 1234 5678', dir: 'Av. Insurgentes Sur 123, CDMX', registro: '15/05/2026', compras: '2 pedidos · $2,840,000', estado: 'Activo', avatar: 'https://ui-avatars.com/api/?name=Carlos+Mendoza&background=0D8ABC&color=fff&rounded=true&size=80' },
        'Ana Torres': { email: 'ana.torres@example.com', tel: '33 9876 5432', dir: 'Paseo Andares 45, Guadalajara', registro: '18/05/2026', compras: '1 pedido · $1,850,000', estado: 'Activo', avatar: 'https://ui-avatars.com/api/?name=Ana+Torres&background=E53E3E&color=fff&rounded=true&size=80' },
        'Luis Rivera': { email: 'l.rivera88@example.com', tel: '81 2345 6789', dir: 'San Pedro Garza, Monterrey', registro: '02/04/2026', compras: '0 pedidos · $0', estado: 'Inactivo', avatar: 'https://ui-avatars.com/api/?name=Luis+Rivera&background=718096&color=fff&rounded=true&size=80' }
    };

    function verPerfil(nombre) {
        const c = clientesData[nombre];
        if (!c) return;

        document.getElementById('modal-avatar').src = c.avatar;
        document.getElementById('modal-nombre').textContent = nombre;
        document.getElementById('modal-email').textContent = c.email;
        document.getElementById('modal-tel').textContent = c.tel;
        document.getElementById('modal-dir').textContent = c.dir;
        document.getElementById('modal-registro').textContent = c.registro;
        document.getElementById('modal-compras').textContent = c.compras;

        const estadoEl = document.getElementById('modal-estado');
        if (c.estado === 'Activo') {
            estadoEl.innerHTML = '<span class="rounded-full bg-green-500/15 px-3 py-1 text-xs font-bold text-green-300">Activo</span>';
        } else {
            estadoEl.innerHTML = '<span class="rounded-full bg-zinc-800 px-3 py-1 text-xs font-bold text-zinc-400">Inactivo</span>';
        }

        const modal = document.getElementById('modal-perfil');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function cerrarModal(e) {
        if (e.target === e.currentTarget) {
            e.currentTarget.classList.add('hidden');
            e.currentTarget.classList.remove('flex');
        }
    }
</script>
@endsection
