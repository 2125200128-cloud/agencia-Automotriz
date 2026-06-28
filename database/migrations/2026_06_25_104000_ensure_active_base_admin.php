<?php

use App\Models\Administrador;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        $base = [
            'nombres' => 'Admin',
            'apellidos' => 'Base',
            'correo' => 'base@velocemotors.mx',
            'usuario' => 'base',
            'contrasena' => Hash::make('base1'),
            'imagen' => null,
            'rol' => Administrador::ROL_BASE,
            'estado' => 'activo',
            'updated_at' => now(),
        ];

        if (DB::table('administradores')->where('usuario', 'base')->exists()) {
            DB::table('administradores')->where('usuario', 'base')->update($base);

            return;
        }

        DB::table('administradores')->insert($base + [
            'created_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('administradores')->where('usuario', 'base')->delete();
    }
};
