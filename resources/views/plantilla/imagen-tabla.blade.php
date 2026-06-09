@php
    $imagenUrl = null;
    if (!empty($imagen)) {
        $imagenUrl = str_starts_with($imagen, 'http')
            ? $imagen
            : (file_exists(public_path($imagen)) ? asset($imagen) : asset('storage/'.$imagen));
    }
@endphp

@if ($imagenUrl)
    <img src="{{ $imagenUrl }}" alt="{{ $alt ?? 'Imagen' }}" class="h-16 w-24 rounded-lg border border-gray-200 object-cover shadow-sm">
@else
    <div class="flex h-16 w-24 items-center justify-center rounded-lg border border-gray-200 bg-gray-100 text-xs font-bold text-gray-500">Sin imagen</div>
@endif
