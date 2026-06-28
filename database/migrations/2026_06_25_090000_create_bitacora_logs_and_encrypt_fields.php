<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $auditedTables = [
        'administradores' => ['id', 'nombres', 'apellidos', 'correo', 'usuario', 'imagen', 'rol', 'estado', 'created_at', 'updated_at'],
        'clientes' => ['id', 'nombres', 'apellidos', 'correo', 'telefono', 'direccion', 'imagen', 'estado', 'created_at', 'updated_at'],
        'proveedores' => ['id', 'nombre', 'contacto', 'telefono', 'correo', 'direccion', 'imagen', 'estado'],
    ];

    private array $encryptedFields = [
        'administradores' => 'imagen',
        'clientes' => 'direccion',
        'proveedores' => 'direccion',
    ];

    public function up(): void
    {
        Schema::create('bitacora_logs', function (Blueprint $table) {
            $table->id();
            $table->string('tabla', 80);
            $table->string('evento', 20);
            $table->string('momento', 10);
            $table->unsignedBigInteger('registro_id')->nullable();
            $table->json('datos_anteriores')->nullable();
            $table->json('datos_nuevos')->nullable();
            $table->string('usuario_bd')->nullable();
            $table->timestamp('created_at', 6)->useCurrent();
        });

        $this->resizeEncryptedColumns();
        $this->encryptExistingValues();
        $this->createAuditTriggers();
    }

    public function down(): void
    {
        $this->dropAuditTriggers();
        $this->decryptExistingValues();
        Schema::dropIfExists('bitacora_logs');
    }

    private function createAuditTriggers(): void
    {
        if (! $this->supportsMysqlTriggers()) {
            return;
        }

        foreach ($this->auditedTables as $table => $columns) {
            $newJson = $this->jsonObject('NEW', $columns);
            $oldJson = $this->jsonObject('OLD', $columns);

            $this->createTrigger($table, 'before', 'insert', 'NEW.id', 'NULL', $newJson);
            $this->createTrigger($table, 'after', 'insert', 'NEW.id', 'NULL', $newJson);
            $this->createTrigger($table, 'before', 'update', 'OLD.id', $oldJson, $newJson);
            $this->createTrigger($table, 'after', 'update', 'NEW.id', $oldJson, $newJson);
            $this->createTrigger($table, 'before', 'delete', 'OLD.id', $oldJson, 'NULL');
            $this->createTrigger($table, 'after', 'delete', 'OLD.id', $oldJson, 'NULL');
        }
    }

    private function createTrigger(string $table, string $moment, string $event, string $recordId, string $oldData, string $newData): void
    {
        $trigger = "{$table}_{$moment}_{$event}_bitacora";
        $momentSql = strtoupper($moment);
        $eventSql = strtoupper($event);

        DB::unprepared("
            CREATE TRIGGER `{$trigger}`
            {$momentSql} {$eventSql} ON `{$table}`
            FOR EACH ROW
            BEGIN
                INSERT INTO `bitacora_logs`
                    (`tabla`, `evento`, `momento`, `registro_id`, `datos_anteriores`, `datos_nuevos`, `usuario_bd`, `created_at`)
                VALUES
                    ('{$table}', '{$eventSql}', '{$momentSql}', {$recordId}, {$oldData}, {$newData}, USER(), CURRENT_TIMESTAMP(6));
            END
        ");
    }

    private function dropAuditTriggers(): void
    {
        if (! $this->supportsMysqlTriggers()) {
            return;
        }

        foreach (array_keys($this->auditedTables) as $table) {
            foreach (['before', 'after'] as $moment) {
                foreach (['insert', 'update', 'delete'] as $event) {
                    DB::unprepared("DROP TRIGGER IF EXISTS `{$table}_{$moment}_{$event}_bitacora`");
                }
            }
        }
    }

    private function jsonObject(string $rowAlias, array $columns): string
    {
        $pairs = collect($columns)
            ->map(fn (string $column) => "'{$column}', {$rowAlias}.`{$column}`")
            ->implode(', ');

        return "JSON_OBJECT({$pairs})";
    }

    private function resizeEncryptedColumns(): void
    {
        if (! $this->supportsMysqlTriggers()) {
            return;
        }

        DB::statement('ALTER TABLE `administradores` MODIFY `imagen` TEXT NULL');
        DB::statement('ALTER TABLE `clientes` MODIFY `direccion` TEXT NULL');
        DB::statement('ALTER TABLE `proveedores` MODIFY `direccion` TEXT NULL');
    }

    private function encryptExistingValues(): void
    {
        foreach ($this->encryptedFields as $table => $field) {
            DB::table($table)
                ->whereNotNull($field)
                ->orderBy('id')
                ->each(function (object $record) use ($table, $field) {
                    if ($this->canDecrypt($record->{$field})) {
                        return;
                    }

                    DB::table($table)
                        ->where('id', $record->id)
                        ->update([$field => Crypt::encryptString($record->{$field})]);
                });
        }
    }

    private function decryptExistingValues(): void
    {
        foreach ($this->encryptedFields as $table => $field) {
            DB::table($table)
                ->whereNotNull($field)
                ->orderBy('id')
                ->each(function (object $record) use ($table, $field) {
                    if (! $this->canDecrypt($record->{$field})) {
                        return;
                    }

                    DB::table($table)
                        ->where('id', $record->id)
                        ->update([$field => Crypt::decryptString($record->{$field})]);
                });
        }
    }

    private function canDecrypt(?string $value): bool
    {
        if ($value === null || $value === '') {
            return false;
        }

        try {
            Crypt::decryptString($value);

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    private function supportsMysqlTriggers(): bool
    {
        return in_array(DB::getDriverName(), ['mysql', 'mariadb'], true);
    }
};
