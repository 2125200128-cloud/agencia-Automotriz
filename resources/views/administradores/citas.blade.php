@extends('plantilla.base')

@section('dinamico')
<section class="vm-page-section">
    <div class="vm-container-2xl">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div class="vm-page-header">
                <p class="vm-header-tag">Control de Operaciones</p>
                <h1 class="vm-header-title sm:text-5xl">Citas de Pruebas de Manejo</h1>
                <p class="vm-header-desc">Registro global de agendamientos y auditoría automática de licencias de conducir.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="mt-6 rounded-xl border border-red-500/40 bg-red-950/30 p-4 font-bold text-red-200">{{ session('success') }}</div>
        @endif

        <div class="vm-table-card">
            <div class="overflow-x-auto">
                <table class="vm-table">
                    <thead class="vm-table-header">
                        <tr>
                            <th class="vm-table-th">Vehículo</th>
                            <th class="vm-table-th">Cliente</th>
                            <th class="vm-table-th">Teléfono</th>
                            <th class="vm-table-th">Fecha de Cita</th>
                            <th class="vm-table-th">Hora</th>
                            <th class="vm-table-th">Licencia</th>
                            <th class="vm-table-th">Validación de Datos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($citas as $cita)
                            <tr class="vm-table-tr">
                                <td class="vm-table-td font-bold text-[#1c69d4]">{{ $cita->vehiculo_nombre }}</td>
                                <td class="vm-table-td font-bold text-black">{{ $cita->nombre }}</td>
                                <td class="vm-table-td">{{ $cita->telefono }}</td>
                                <td class="vm-table-td">{{ date('d/m/Y', strtotime($cita->fecha)) }}</td>
                                <td class="vm-table-td font-semibold text-gray-900">{{ $cita->hora }}</td>
                                <td class="vm-table-td font-mono text-xs uppercase">{{ $cita->licencia }}</td>
                                <td class="vm-table-td">
                                    @if ($cita->licencia_status === 'Vigente')
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-800 border border-green-200">
                                            <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                            Vigente (Aprobado)
                                        </span>
                                    @elseif (str_contains(strtolower($cita->licencia_status), 'vencida') || str_contains(strtolower($cita->licencia_status), 'invalida'))
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-800 border border-red-200">
                                            <span class="h-2 w-2 rounded-full bg-red-500"></span>
                                            Expirada / Sin Vigencia
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-yellow-100 px-3 py-1 text-xs font-bold text-yellow-800 border border-yellow-200">
                                            <span class="h-2 w-2 rounded-full bg-yellow-500"></span>
                                            {{ $cita->licencia_status }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="vm-table-td py-10 text-center text-gray-500">No hay citas de pruebas de manejo registradas en el sistema.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
