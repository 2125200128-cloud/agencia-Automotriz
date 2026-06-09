@extends('plantilla.base')

@section('dinamico')
<section class="vm-page-section">
    <div class="mx-auto grid min-h-[calc(100vh-180px)] max-w-screen-xl gap-10 lg:grid-cols-[0.85fr_1.15fr] lg:items-center">
        <div>
            <span class="vm-badge">
                Veloce Motors
            </span>
            <h1 class="mt-6 text-4xl font-black leading-tight text-black sm:text-5xl lg:text-6xl">
                Iniciar sesion
            </h1>
            <p class="mt-5 max-w-xl text-lg leading-8 text-gray-700">
                Accede para consultar tus pedidos, registrar compras y dar seguimiento a tus solicitudes dentro de Veloce Motors.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="/producto" class="vm-btn-outline">
                    Ver catalogo
                </a>
                <a href="/cliente/mis-pedidos" class="vm-btn-solid">
                    Mis pedidos
                </a>
            </div>
        </div>
        <div class="grid gap-6">
            <div class="vm-card-form">
                <div class="mb-6">
                    <h2 class="text-2xl font-black text-black">Ya tengo una cuenta</h2>
                    <p class="mt-2 text-sm leading-6 text-gray-500">Ingresa tus datos para continuar.</p>
                </div>

                <form action="#" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="login_email" class="vm-input-label">Correo electronico</label>
                        <input type="email" id="login_email" name="email" class="vm-input-text" required>
                    </div>

                    <div>
                        <div class="mb-2 flex items-center justify-between gap-4">
                            <label for="login_password" class="vm-input-label !mb-0">Contrasena</label>
                            <a href="#" class="text-xs font-medium text-gray-500 transition hover:text-black">Olvide mi contrasena</a>
                        </div>
                        <input type="password" id="login_password" name="password" class="vm-input-text" required>
                    </div>

                    <button type="submit" class="vm-btn-primary-full">
                        Iniciar sesion
                    </button>
                </form>
            </div>
            <div class="vm-card-form-muted">
                <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-black text-black">Crear cuenta</h2>
                        <p class="mt-2 text-sm leading-6 text-gray-500">Registrate para poder comprar vehiculos y consultar tus movimientos.</p>
                    </div>
                    <span class="inline-flex self-start rounded-full border border-black bg-white px-3 py-1 text-xs font-bold uppercase tracking-wider text-black">
                        Nuevo cliente
                    </span>
                </div>

                <form action="/cliente" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div class="grid gap-5 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label for="nombre" class="vm-input-label">Nombre completo</label>
                            <input type="text" id="nombre" name="nombre" class="vm-input-text" required>
                        </div>

                        <div>
                            <label for="email" class="vm-input-label">Correo electronico</label>
                            <input type="email" id="email" name="email" class="vm-input-text" required>
                        </div>

                        <div>
                            <label for="telefono" class="vm-input-label">Telefono</label>
                            <input type="tel" id="telefono" name="telefono" class="vm-input-text" required>
                        </div>

                        <div class="md:col-span-2">
                            <label for="password" class="vm-input-label">Contrasena</label>
                            <input type="password" id="password" name="password" class="vm-input-text" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="vm-input-label">Foto de perfil opcional</label>
                            <label for="foto" class="vm-file-upload-label">
                                <span class="vm-file-upload-text">Haz clic para subir JPG o PNG</span>
                                <input id="foto" name="foto" type="file" class="hidden" accept="image/*">
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="vm-btn-primary-full">
                        Registrarme
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
