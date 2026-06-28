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
            ->whereIn(DB::raw('LOWER(rol)'), ['admin', 'administrador', 'superadmin', 'gerente', 'master'])
            ->update(['rol' => Administrador::ROL_MASTER]);

        DB::table('administradores')
            ->whereNotIn(DB::raw('LOWER(rol)'), [Administrador::ROL_MASTER])
            ->update(['rol' => Administrador::ROL_BASE]);

        if (! DB::table('administradores')->where('rol', Administrador::ROL_MASTER)->exists()) {
            DB::table('administradores')
                ->where('id', DB::table('administradores')->min('id'))
                ->update(['rol' => Administrador::ROL_MASTER, 'estado' => 'activo']);
        }

        if (! DB::table('administradores')->where('rol', Administrador::ROL_BASE)->exists()) {
            DB::table('administradores')->insert([
                'nombres' => 'Admin',
                'apellidos' => 'Base',
                'correo' => 'base@velocemotors.mx',
                'usuario' => 'base',
                'contrasena' => Hash::make('base1'),
                'imagen' => null,
                'rol' => Administrador::ROL_BASE,
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('administradores')
            ->where('rol', Administrador::ROL_MASTER)
            ->update(['rol' => 'admin']);

        DB::table('administradores')
            ->where('rol', Administrador::ROL_BASE)
            ->update(['rol' => 'vendedor']);
    }
};
