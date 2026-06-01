@extends('plantilla.base')

@section('dinamico')
<section class="min-h-screen bg-black px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-screen-2xl">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div class="border-l-4 border-red-500 pl-5">
                <p class="text-sm font-semibold uppercase tracking-[0.35em] text-red-300">Listado</p>
                <h1 class="mt-3 text-4xl font-black text-white sm:text-5xl">{{ $titulo }}</h1>
                <p class="mt-3 max-w-2xl text-gray-400">{{ $descripcion }}</p>
            </div>

            <a href="{{ $urlFormulario }}" class="inline-flex items-center justify-center rounded-xl bg-red-600 px-6 py-3 text-sm font-black uppercase tracking-wide text-white transition hover:bg-red-500">
                + Agregar
            </a>
        </div>

        <div class="mt-8 overflow-hidden rounded-xl border border-white/10 bg-zinc-950">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-300">
                    <thead class="bg-black text-xs uppercase tracking-wider text-gray-400">
                        <tr>
                            @foreach ($columnas as $encabezado)
                                <th class="whitespace-nowrap px-6 py-4">{{ $encabezado }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($registros as $registro)
                            <tr class="transition hover:bg-white/5">
                                @foreach ($columnas as $atributo => $encabezado)
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @php
                                            $valor = data_get($registro, $atributo);
                                            $esImagen = str_contains($atributo, 'imagen');
                                            $imagenPublica = $valor && file_exists(public_path($valor));
                                            $imagenStorage = $valor && Illuminate\Support\Facades\Storage::disk('public')->exists($valor);
                                        @endphp
                                        @if ($esImagen && ($imagenPublica || $imagenStorage))
                                            <img src="{{ $imagenPublica ? asset($valor) : asset('storage/'.$valor) }}" alt="{{ $encabezado }}" class="h-12 w-20 rounded object-cover">
                                        @else
                                            {{ $valor ?? 'Sin registro' }}
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($columnas) }}" class="px-6 py-10 text-center text-gray-400">
                                    No hay registros disponibles.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
