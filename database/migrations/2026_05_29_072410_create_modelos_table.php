<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('modelos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marca_id')->constrained('marcas')->cascadeOnDelete();
            $table->string('nombre');
            $table->string('imagen')->nullable();
        });
    }
    public function down(): void { Schema::dropIfExists('modelos'); }
};
