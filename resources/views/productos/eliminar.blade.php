@extends('plantilla.base')

@section('dinamico')
    <section class="vm-page-section">
        <div class="vm-container-md">
            <div class="vm-card-form">
                <p class="vm-header-tag">Eliminar producto</p>
                <h1 class="vm-header-title">{{ $producto->nombre }}</h1>
                <p class="mt-4 text-gray-400">Confirma si deseas eliminar este registro.</p>
                <form action="/producto/{{ $producto->id }}" method="POST" class="mt-8 flex justify-end gap-3">@csrf
                    @method('DELETE')<a href="/producto" class="vm-btn-secondary">Cancelar</a><button type="submit"
                        class="vm-btn-primary">Eliminar</button></form>
            </div>
        </div>
    </section>
@endsection
