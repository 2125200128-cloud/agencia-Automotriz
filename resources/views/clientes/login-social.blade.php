@extends('plantilla.base')

@section('dinamico')
<section class="vm-page-section">
    <div class="vm-container-lg">
        <div class="mx-auto max-w-lg">
            <div class="vm-page-header mb-8 text-center">
                <p class="vm-header-tag">Clientes</p>
                <h1 class="vm-header-title">Iniciar sesion</h1>
                <p class="vm-header-desc">Accede con tu cuenta de Google para consultar tus pedidos y citas.</p>
            </div>

            <div class="vm-card-form">
                @if ($errors->any())
                    <div class="mb-5 rounded-xl border border-red-500/40 bg-red-950/30 p-4 text-sm text-red-200">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-5 rounded-xl border border-green-500/30 bg-green-50 p-4 text-sm font-semibold text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('cliente.google.redirect') }}" class="flex w-full items-center justify-center gap-3 rounded-xl border border-gray-200 bg-white px-5 py-4 text-base font-black text-black transition hover:border-[#1c69d4] hover:bg-[#f7fbff]">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full border border-gray-200 text-sm font-black text-[#1c69d4]">G</span>
                    Continuar con Google
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
