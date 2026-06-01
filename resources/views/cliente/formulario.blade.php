@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-12 sm:px-6 lg:px-8 relative overflow-hidden flex items-center justify-center">
    <!-- Efecto visual de fondo (Glassmorphism / Glow) -->
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-600/20 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="w-full max-w-6xl z-10">
        <div class="mb-12 text-center">
            <h1 class="text-3xl font-black text-white sm:text-5xl tracking-tight">Acceso a Clientes</h1>
            <p class="mt-4 text-gray-400 max-w-2xl mx-auto">Inicia sesión para ver tus pedidos o crea una cuenta para poder comprar vehículos y acceder a nuestro inventario premium.</p>
        </div>

        <div class="grid gap-8 lg:grid-cols-2 lg:gap-16 items-start">
            
            <!-- Iniciar Sesión -->
            <div class="rounded-3xl border border-white/10 bg-zinc-950/80 p-8 shadow-[0_0_45px_rgba(0,0,0,0.5)] backdrop-blur-sm">
                <h2 class="text-2xl font-bold text-white mb-6">Ya tengo una cuenta</h2>
                
                <form action="#" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="login_email" class="mb-2 block text-sm font-bold text-gray-300">Correo Electrónico</label>
                        <input type="email" id="login_email" name="email" class="block w-full rounded-xl border border-white/10 bg-black p-3 text-white focus:border-blue-500 focus:ring-blue-500 transition" required>
                    </div>
                    
                    <div>
                        <label for="login_password" class="mb-2 block flex justify-between items-center text-sm font-bold text-gray-300">
                            <span>Contraseña</span>
                            <a href="#" class="text-xs font-normal text-blue-400 hover:text-blue-300 transition">¿Olvidaste tu contraseña?</a>
                        </label>
                        <input type="password" id="login_password" name="password" class="block w-full rounded-xl border border-white/10 bg-black p-3 text-white focus:border-blue-500 focus:ring-blue-500 transition" required>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full rounded-xl bg-blue-600 px-6 py-4 font-bold text-white shadow-[0_0_20px_rgba(37,99,235,0.3)] transition hover:bg-blue-500 hover:shadow-[0_0_25px_rgba(37,99,235,0.5)]">
                            Iniciar Sesión
                        </button>
                    </div>
                </form>
            </div>

            <!-- Crear Cuenta -->
            <div class="rounded-3xl border border-white/10 bg-zinc-950/80 p-8 shadow-[0_0_45px_rgba(0,0,0,0.5)] backdrop-blur-sm relative">
                <!-- Highlight Badge -->
                <div class="absolute -top-4 right-8 bg-gradient-to-r from-red-600 to-orange-500 text-white text-xs font-black uppercase tracking-wider px-4 py-1.5 rounded-full shadow-lg">
                    Requerido para comprar
                </div>

                <h2 class="text-2xl font-bold text-white mb-6">Crear cuenta nueva</h2>
                
                <form action="#" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div class="grid gap-5 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label for="nombre" class="mb-2 block text-sm font-bold text-gray-300">Nombre Completo</label>
                            <input type="text" id="nombre" name="nombre" class="block w-full rounded-xl border border-white/10 bg-black p-3 text-white focus:border-blue-500 focus:ring-blue-500 transition" required>
                        </div>
                        
                        <div>
                            <label for="email" class="mb-2 block text-sm font-bold text-gray-300">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="block w-full rounded-xl border border-white/10 bg-black p-3 text-white focus:border-blue-500 focus:ring-blue-500 transition" required>
                        </div>

                        <div>
                            <label for="telefono" class="mb-2 block text-sm font-bold text-gray-300">Teléfono</label>
                            <input type="tel" id="telefono" name="telefono" class="block w-full rounded-xl border border-white/10 bg-black p-3 text-white focus:border-blue-500 focus:ring-blue-500 transition" required>
                        </div>

                        <div class="md:col-span-2">
                            <label for="password" class="mb-2 block text-sm font-bold text-gray-300">Contraseña</label>
                            <input type="password" id="password" name="password" class="block w-full rounded-xl border border-white/10 bg-black p-3 text-white focus:border-blue-500 focus:ring-blue-500 transition" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-bold text-gray-300">Foto de Perfil (Opcional)</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="foto" class="flex flex-col items-center justify-center w-full h-24 border-2 border-white/10 border-dashed rounded-xl cursor-pointer bg-black/50 hover:bg-black transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-6 h-6 mb-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/></svg>
                                        <p class="text-xs text-gray-500">Haz clic para subir (JPG, PNG)</p>
                                    </div>
                                    <input id="foto" name="foto" type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full rounded-xl bg-white px-6 py-4 font-black text-black shadow-[0_0_20px_rgba(255,255,255,0.1)] transition hover:bg-gray-200 hover:shadow-[0_0_30px_rgba(255,255,255,0.2)]">
                            Registrarme
                        </button>
                    </div>
                    <p class="text-xs text-center text-gray-500 mt-4">Al registrarte, aceptas nuestros términos y condiciones de servicio.</p>
                </form>
            </div>
            
        </div>
    </div>
</section>
@endsection
