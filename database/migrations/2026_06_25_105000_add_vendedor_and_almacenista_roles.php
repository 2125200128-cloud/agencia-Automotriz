<?php

use App\Models\Administrador;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('administradores')
            ->whereIn(DB::raw('LOWER(rol)'), ['ventas', 'gerente_ventas', 'vendedor'])
            ->update(['rol' => Administrador::ROL_VENDEDOR, 'estado' => 'activo']);

        DB::table('administradores')
            ->whereIn(DB::raw('LOWER(rol)'), ['inventario', 'administrador_inventario', 'almacenista'])
            ->update(['rol' => Administrador::ROL_ALMACENISTA, 'estado' => 'activo']);

        $this->upsertAdmin('vendedor', [
            'nombres' => 'Admin',
            'apellidos' => 'Vendedor',
            'correo' => 'vendedor@velocemotors.mx',
            'contrasena' => Hash::make('vendedor1'),
            'rol' => Administrador::ROL_VENDEDOR,
        ]);

        $this->upsertAdmin('almacenista', [
            'nombres' => 'Admin',
            'apellidos' => 'Almacenista',
            'correo' => 'almacenista@velocemotors.mx',
            'contrasena' => Hash::make('almacen1'),
            'rol' => Administrador::ROL_ALMACENISTA,
        ]);
    }

    public function down(): void
    {
        DB::table('administradores')->whereIn('usuario', ['vendedor', 'almacenista'])->delete();
    }

    private function upsertAdmin(string $usuario, array $data): void
    {
        $payload = $data + [
            'usuario' => $usuario,
            'imagen' => null,
            'estado' => 'activo',
            'updated_at' => now(),
        ];

        if (DB::table('administradores')->where('usuario', $usuario)->exists()) {
            DB::table('administradores')->where('usuario', $usuario)->update($payload);

            return;
        }

        DB::table('administradores')->insert($payload + ['created_at' => now()]);
    }
};
