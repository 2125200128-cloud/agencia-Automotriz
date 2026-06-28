<?php

use App\Models\Administrador;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private array $imageColumns = [
        'marcas' => ['imagen'],
        'tipos' => ['imagen'],
        'colores' => ['imagen'],
        'modelos_vehiculos' => ['imagen'],
        'clientes' => ['imagen', 'google_avatar'],
        'proveedores' => ['imagen'],
        'productos' => ['imagen_principal', 'imagen_secundaria', 'imagen_adicional'],
    ];

    public function up(): void
    {
        foreach ($this->imageColumns as $table => $columns) {
            foreach ($columns as $column) {
                if (! $this->columnExists($table, $column)) {
                    continue;
                }

                DB::table($table)
                    ->whereNotNull($column)
                    ->where($column, '!=', '')
                    ->where($column, 'not like', 'http%')
                    ->orderBy('id')
                    ->select(['id', $column])
                    ->each(function (object $record) use ($table, $column) {
                        DB::table($table)
                            ->where('id', $record->id)
                            ->update([$column => $this->urlFor($record->{$column})]);
                    });
            }
        }

        Administrador::query()
            ->whereNotNull('imagen')
            ->orderBy('id')
            ->get()
            ->each(function (Administrador $administrador) {
                if ($administrador->imagen && ! str_starts_with($administrador->imagen, 'http')) {
                    $administrador->imagen = $this->urlFor($administrador->imagen);
                    $administrador->save();
                }
            });
    }

    public function down(): void
    {
        foreach ($this->imageColumns as $table => $columns) {
            foreach ($columns as $column) {
                if (! $this->columnExists($table, $column)) {
                    continue;
                }

                DB::table($table)
                    ->where($column, 'like', '%/storage/%')
                    ->orderBy('id')
                    ->select(['id', $column])
                    ->each(function (object $record) use ($table, $column) {
                        DB::table($table)
                            ->where('id', $record->id)
                            ->update([$column => $this->pathFromUrl($record->{$column})]);
                    });
            }
        }

        Administrador::query()
            ->whereNotNull('imagen')
            ->orderBy('id')
            ->get()
            ->each(function (Administrador $administrador) {
                if ($administrador->imagen && str_contains($administrador->imagen, '/storage/')) {
                    $administrador->imagen = $this->pathFromUrl($administrador->imagen);
                    $administrador->save();
                }
            });
    }

    private function urlFor(string $path): string
    {
        $path = str_starts_with($path, 'storage/')
            ? substr($path, strlen('storage/'))
            : ltrim($path, '/');

        return rtrim((string) config('app.url'), '/').'/storage/'.$path;
    }

    private function pathFromUrl(string $url): string
    {
        $path = parse_url($url, PHP_URL_PATH) ?: $url;
        $marker = '/storage/';

        return str_contains($path, $marker)
            ? substr($path, strpos($path, $marker) + strlen($marker))
            : $url;
    }

    private function columnExists(string $table, string $column): bool
    {
        return DB::getSchemaBuilder()->hasColumn($table, $column);
    }
};
