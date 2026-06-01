@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8 border-l-4 border-white/30 pl-5 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.35em] text-zinc-300">Nuevo Vehículo</p>
                <h1 class="mt-3 text-3xl font-black text-white sm:text-4xl">Agregar Vehículo</h1>
                <p class="mt-2 text-gray-400">Registra un nuevo automóvil en el inventario o catálogo.</p>
            </div>
            <a href="/producto" class="text-sm font-semibold text-zinc-400 hover:text-white transition">Cancelar</a>
        </div>

        <div class="rounded-3xl border border-white/10 bg-zinc-950 p-6 shadow-[0_0_45px_rgba(255,255,255,0.10)] sm:p-8">
            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <div class="space-y-8">
                    <!-- Información Principal -->
                    <div>
                        <h3 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Información Principal</h3>
                        <div class="grid gap-6 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <label for="nombre" class="mb-2 block text-sm font-bold text-zinc-300">Nombre Público (Título)</label>
                                <input type="text" id="nombre" name="nombre" placeholder="Ej. Nissan Skyline GT-R R34 V-Spec" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition" required>
                            </div>

                            <div>
                                <label for="numero_serie" class="mb-2 block text-sm font-bold text-zinc-300">Número de Serie (VIN)</label>
                                <input type="text" id="numero_serie" name="numero_serie" placeholder="Ej. JNR340001" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition">
                            </div>

                            <div>
                                <label for="anio" class="mb-2 block text-sm font-bold text-zinc-300">Año de Fabricación</label>
                                <input type="number" id="anio" name="anio" min="1950" max="{{ date('Y') + 1 }}" placeholder="Ej. 1999" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition">
                            </div>

                            <div class="md:col-span-2">
                                <label for="descripcion" class="mb-2 block text-sm font-bold text-zinc-300">Descripción Corta</label>
                                <textarea id="descripcion" name="descripcion" rows="2" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition"></textarea>
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="detalles" class="mb-2 block text-sm font-bold text-zinc-300">Detalles Técnicos y Equipamiento</label>
                                <textarea id="detalles" name="detalles" rows="4" placeholder="Especificaciones del motor, transmisión, extras..." class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Clasificación y Relaciones -->
                    <div>
                        <h3 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Clasificación y Proveedor</h3>
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            <div>
                                <label for="marca_id" class="mb-2 block text-sm font-bold text-zinc-300">Marca</label>
                                <select id="marca_id" name="marca_id" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition">
                                    <option value="">Selecciona marca</option>
                                </select>
                            </div>
                            <div>
                                <label for="modelo_id" class="mb-2 block text-sm font-bold text-zinc-300">Modelo</label>
                                <select id="modelo_id" name="modelo_id" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition">
                                    <option value="">Selecciona modelo</option>
                                </select>
                            </div>
                            <div>
                                <label for="tipo_id" class="mb-2 block text-sm font-bold text-zinc-300">Tipo de Vehículo</label>
                                <select id="tipo_id" name="tipo_id" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition">
                                    <option value="">Selecciona tipo</option>
                                </select>
                            </div>
                            <div>
                                <label for="color_id" class="mb-2 block text-sm font-bold text-zinc-300">Color Exterior</label>
                                <select id="color_id" name="color_id" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition">
                                    <option value="">Selecciona color</option>
                                </select>
                            </div>
                            <div class="lg:col-span-2">
                                <label for="proveedor_id" class="mb-2 block text-sm font-bold text-zinc-300">Proveedor</label>
                                <select id="proveedor_id" name="proveedor_id" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition">
                                    <option value="">Selecciona proveedor</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Precios y Estado -->
                    <div>
                        <h3 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Comercial</h3>
                        <div class="grid gap-6 md:grid-cols-3">
                            <div>
                                <label for="precio" class="mb-2 block text-sm font-bold text-zinc-300">Precio Venta (MXN)</label>
                                <input type="number" step="0.01" id="precio" name="precio" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition" required>
                            </div>
                            <div>
                                <label for="existencia" class="mb-2 block text-sm font-bold text-zinc-300">Stock / Existencia</label>
                                <select id="existencia" name="existencia" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition" required>
                                    <option value="1" selected>1 (Disponible)</option>
                                    <option value="0">0 (Vendido / Agotado)</option>
                                </select>
                            </div>
                            <div>
                                <label for="estado" class="mb-2 block text-sm font-bold text-zinc-300">Estado Publicación</label>
                                <select id="estado" name="estado" class="block w-full rounded-xl border border-white/10 bg-black/85 p-3 text-white focus:border-white/30 focus:ring-white/30 transition">
                                    <option value="activo" selected>Activo (Público)</option>
                                    <option value="inactivo">Inactivo (Oculto)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Galería de Imágenes -->
                    <div>
                        <h3 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Galería de Imágenes</h3>
                        <div class="grid gap-6 md:grid-cols-3">
                            <div>
                                <label class="mb-2 block text-sm font-bold text-zinc-300">Imagen Principal</label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="imagen_uno" class="flex flex-col items-center justify-center w-full h-32 border-2 border-white/10 border-dashed rounded-xl cursor-pointer bg-black/50 hover:bg-black transition">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-2 text-zinc-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/></svg>
                                            <p class="text-xs text-zinc-400">Subir foto (.jpg, .png)</p>
                                        </div>
                                        <input id="imagen_uno" name="imagen_uno" type="file" class="hidden" accept="image/*" />
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-bold text-zinc-300">Imagen 2</label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="imagen_dos" class="flex flex-col items-center justify-center w-full h-32 border-2 border-white/10 border-dashed rounded-xl cursor-pointer bg-black/50 hover:bg-black transition">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-2 text-zinc-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/></svg>
                                        </div>
                                        <input id="imagen_dos" name="imagen_dos" type="file" class="hidden" accept="image/*" />
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-bold text-zinc-300">Imagen 3</label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="imagen_tres" class="flex flex-col items-center justify-center w-full h-32 border-2 border-white/10 border-dashed rounded-xl cursor-pointer bg-black/50 hover:bg-black transition">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-2 text-zinc-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/></svg>
                                        </div>
                                        <input id="imagen_tres" name="imagen_tres" type="file" class="hidden" accept="image/*" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-white/10 flex items-center justify-end gap-4">
                    <button type="reset" class="px-5 py-2.5 text-sm font-bold text-zinc-400 hover:text-white transition">Limpiar campos</button>
                    <button type="submit" class="rounded-xl bg-white px-8 py-3 font-black text-black transition hover:bg-zinc-200 hover:shadow-[0_0_30px_rgba(255,255,255,0.22)]">Guardar Vehículo</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
