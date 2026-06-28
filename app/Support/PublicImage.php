<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PublicImage
{
    public static function storeAsUrl(UploadedFile $file, string $directory, string $name): string
    {
        $path = $file->storeAs($directory, $name, 'public');

        return asset('storage/'.$path);
    }

    public static function delete(?string $value): void
    {
        $path = self::pathFromValue($value);

        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public static function pathFromValue(?string $value): ?string
    {
        if (! $value) {
            return null;
        }

        if (str_starts_with($value, 'http')) {
            $path = parse_url($value, PHP_URL_PATH);
            $marker = '/storage/';

            if (! $path || ! str_contains($path, $marker)) {
                return null;
            }

            return ltrim(substr($path, strpos($path, $marker) + strlen($marker)), '/');
        }

        return str_starts_with($value, 'storage/')
            ? substr($value, strlen('storage/'))
            : ltrim($value, '/');
    }
}
