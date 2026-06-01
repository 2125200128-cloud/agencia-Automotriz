<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('modelos', 'modelos_vehiculos');
    }

    public function down(): void
    {
        Schema::rename('modelos_vehiculos', 'modelos');
    }
};
