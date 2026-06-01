<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->cascadeOnDelete();
            $table->string('metodo_pago');
            $table->decimal('monto', 10, 2);
            $table->date('fecha_pago');
            $table->string('estado')->default('completado');
        });
    }
    public function down(): void { Schema::dropIfExists('pagos'); }
};
