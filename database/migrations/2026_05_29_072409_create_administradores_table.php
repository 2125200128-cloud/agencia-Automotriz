<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('administradores', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('correo')->unique();
            $table->string('usuario')->unique();
            $table->string('contrasena');
            $table->string('imagen')->nullable();
            $table->string('rol');
            $table->string('estado')->default('activo');
        });
    }
    public function down(): void { Schema::dropIfExists('administradores'); }
};
