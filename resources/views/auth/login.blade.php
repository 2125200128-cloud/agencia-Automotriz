<!DOCTYPE html>
<html lang="es">
<head>
    @include('plantilla.header')
</head>
<body class="min-h-screen bg-[#090909] text-[#9E9EA2]">
    <main>
        <section class="vm-page-section flex items-center justify-center">
            <div class="w-full max-w-md">
                <div class="mb-8 text-center">
                    <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center overflow-hidden rounded-full border border-[#2f3d4f] bg-[#0f141b] shadow-[0_0_18px_rgba(28,105,212,0.18)]">
                        <img src="{{ asset('imagenes/logovelocemotor.png') }}" alt="Logo Veloce Motors" class="h-full w-full object-cover">
                    </div>
                    <p class="vm-header-tag">Acceso administrativo</p>
                    <h1 class="vm-header-title">Veloce Motors</h1>
                    <p class="vm-header-desc">Ingresa con tu usuario administrativo activo.</p>
                </div>

                <div class="vm-card-form">
                    @if($errors->any())
                        <div class="mb-5 rounded-xl border border-red-500/40 bg-red-950/30 p-4 text-sm text-red-200">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="usuario" class="vm-input-label">Usuario</label>
                            <input type="text" id="usuario" name="usuario" class="vm-input-text" value="{{ old('usuario') }}" required autofocus>
                        </div>

                        <div>
                            <label for="contrasena" class="vm-input-label">Contrasena</label>
                            <input type="password" id="contrasena" name="contrasena" class="vm-input-text" required>
                        </div>

                        <button type="submit" class="vm-btn-primary-full">
                            Iniciar sesion
                        </button>
                    </form>

                    <div class="my-6 flex items-center gap-3">
                        <div class="h-px flex-1 bg-gray-200"></div>
                        <span class="text-xs font-black uppercase tracking-widest text-gray-400">Clientes</span>
                        <div class="h-px flex-1 bg-gray-200"></div>
                    </div>

                    <a href="{{ route('cliente.login') }}" class="flex w-full items-center justify-center gap-3 rounded-xl border border-gray-200 bg-white px-5 py-4 text-base font-black text-black transition hover:border-[#1c69d4] hover:bg-[#f7fbff]">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full border border-gray-200 text-sm font-black text-[#1c69d4]">G</span>
                        Acceso clientes con Google
                    </a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
