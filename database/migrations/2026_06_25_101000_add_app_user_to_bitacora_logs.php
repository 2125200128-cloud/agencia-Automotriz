<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $auditedTables = [
        'administradores' => ['id', 'nombres', 'apellidos', 'correo', 'usuario', 'imagen', 'rol', 'estado', 'created_at', 'updated_at'],
        'clientes' => ['id', 'nombres', 'apellidos', 'correo', 'telefono', 'direccion', 'imagen', 'estado', 'created_at', 'updated_at'],
        'proveedores' => ['id', 'nombre', 'contacto', 'telefono', 'correo', 'direccion', 'imagen', 'estado'],
    ];

    public function up(): void
    {
        if (! Schema::hasColumn('bitacora_logs', 'usuario_app')) {
            Schema::table('bitacora_logs', function (Blueprint $table) {
                $table->string('usuario_app')->nullable()->after('usuario_bd');
            });
        }

        $this->dropAuditTriggers();
        $this->createAuditTriggers();
    }

    public function down(): void
    {
        $this->dropAuditTriggers();
        $this->createLegacyAuditTriggers();

        if (Schema::hasColumn('bitacora_logs', 'usuario_app')) {
            Schema::table('bitacora_logs', function (Blueprint $table) {
                $table->dropColumn('usuario_app');
            });
        }
    }

    private function createAuditTriggers(): void
    {
        if (! $this->supportsMysqlTriggers()) {
            return;
        }

        foreach ($this->auditedTables as $table => $columns) {
            $newJson = $this->jsonObject('NEW', $columns);
            $oldJson = $this->jsonObject('OLD', $columns);

            $this->createTrigger($table, 'before', 'insert', 'NEW.id', 'NULL', $newJson, true);
            $this->createTrigger($table, 'after', 'insert', 'NEW.id', 'NULL', $newJson, true);
            $this->createTrigger($table, 'before', 'update', 'OLD.id', $oldJson, $newJson, true);
            $this->createTrigger($table, 'after', 'update', 'NEW.id', $oldJson, $newJson, true);
            $this->createTrigger($table, 'before', 'delete', 'OLD.id', $oldJson, 'NULL', true);
            $this->createTrigger($table, 'after', 'delete', 'OLD.id', $oldJson, 'NULL', true);
        }
    }

    private function createLegacyAuditTriggers(): void
    {
        if (! $this->supportsMysqlTriggers()) {
            return;
        }

        foreach ($this->auditedTables as $table => $columns) {
            $newJson = $this->jsonObject('NEW', $columns);
            $oldJson = $this->jsonObject('OLD', $columns);

            $this->createTrigger($table, 'before', 'insert', 'NEW.id', 'NULL', $newJson, false);
            $this->createTrigger($table, 'after', 'insert', 'NEW.id', 'NULL', $newJson, false);
            $this->createTrigger($table, 'before', 'update', 'OLD.id', $oldJson, $newJson, false);
            $this->createTrigger($table, 'after', 'update', 'NEW.id', $oldJson, $newJson, false);
            $this->createTrigger($table, 'before', 'delete', 'OLD.id', $oldJson, 'NULL', false);
            $this->createTrigger($table, 'after', 'delete', 'OLD.id', $oldJson, 'NULL', false);
        }
    }

    private function createTrigger(
        string $table,
        string $moment,
        string $event,
        string $recordId,
        string $oldData,
        string $newData,
        bool $withAppUser
    ): void {
        $trigger = "{$table}_{$moment}_{$event}_bitacora";
        $momentSql = strtoupper($moment);
        $eventSql = strtoupper($event);
        $columns = '`tabla`, `evento`, `momento`, `registro_id`, `datos_anteriores`, `datos_nuevos`, `usuario_bd`, `created_at`';
        $values = "'{$table}', '{$eventSql}', '{$momentSql}', {$recordId}, {$oldData}, {$newData}, USER(), CURRENT_TIMESTAMP(6)";

        if ($withAppUser) {
            $columns = '`tabla`, `evento`, `momento`, `registro_id`, `datos_anteriores`, `datos_nuevos`, `usuario_bd`, `usuario_app`, `created_at`';
            $values = "'{$table}', '{$eventSql}', '{$momentSql}', {$recordId}, {$oldData}, {$newData}, USER(), COALESCE(@app_usuario, 'sistema'), CURRENT_TIMESTAMP(6)";
        }

        DB::unprepared("
            CREATE TRIGGER `{$trigger}`
            {$momentSql} {$eventSql} ON `{$table}`
            FOR EACH ROW
            BEGIN
                INSERT INTO `bitacora_logs` ({$columns})
                VALUES ({$values});
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

    private function supportsMysqlTriggers(): bool
    {
        return in_array(DB::getDriverName(), ['mysql', 'mariadb'], true);
    }
};
