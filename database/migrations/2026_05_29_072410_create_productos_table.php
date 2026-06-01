<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->string('numero_serie')->nullable();
            $table->integer('anio')->nullable();
            $table->text('detalles')->nullable();
            $table->decimal('precio', 10, 2);
            $table->foreignId('marca_id')->nullable()->constrained('marcas')->nullOnDelete();
            $table->foreignId('modelo_id')->nullable()->constrained('modelos')->nullOnDelete();
            $table->foreignId('tipo_id')->nullable()->constrained('tipos')->nullOnDelete();
            $table->foreignId('color_id')->nullable()->constrained('colores')->nullOnDelete();
            $table->foreignId('proveedor_id')->nullable()->constrained('proveedores')->nullOnDelete();
            $table->integer('existencia')->default(0);
            $table->decimal('descuento', 5, 2)->default(0);
            $table->string('imagen_uno')->nullable();
            $table->string('imagen_dos')->nullable();
            $table->string('imagen_tres')->nullable();
            $table->string('estado')->default('activo');
        });
    }
    public function down(): void { Schema::dropIfExists('productos'); }
};
