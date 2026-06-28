<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrador extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROL_MASTER = 'master';
    public const ROL_BASE = 'base';
    public const ROL_VENDEDOR = 'vendedor';
    public const ROL_ALMACENISTA = 'almacenista';

    public const ROLES = [
        self::ROL_MASTER => 'Master',
        self::ROL_BASE => 'Base',
        self::ROL_VENDEDOR => 'Vendedor',
        self::ROL_ALMACENISTA => 'Almacenista',
    ];

    public const ESTADOS = [
        'activo' => 'Activo',
        'inactivo' => 'Inactivo',
    ];

    protected $table = 'administradores';

    protected $fillable = [
        'nombres', 'apellidos', 'correo', 'usuario', 'contrasena', 'imagen', 'rol', 'estado',
    ];

    protected $hidden = [
        'contrasena',
    ];

    protected function casts(): array
    {
        return [
            'imagen' => 'encrypted',
        ];
    }

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function estaActivo(): bool
    {
        return strtolower(trim((string) $this->estado)) === 'activo';
    }

    public function rolNormalizado(): string
    {
        return strtolower(str_replace([' ', '-'], '_', trim((string) $this->rol)));
    }

    public function rolVisible(): string
    {
        return self::ROLES[$this->rolNormalizado()] ?? $this->rol;
    }

    public function esMaster(): bool
    {
        return $this->rolNormalizado() === self::ROL_MASTER;
    }

    public function esBase(): bool
    {
        return $this->rolNormalizado() === self::ROL_BASE;
    }

    public function esVendedor(): bool
    {
        return $this->rolNormalizado() === self::ROL_VENDEDOR;
    }

    public function esAlmacenista(): bool
    {
        return $this->rolNormalizado() === self::ROL_ALMACENISTA;
    }

    public function puede(string $permiso): bool
    {
        if ($this->esMaster()) {
            return true;
        }

        if ($permiso === self::ROL_MASTER || $permiso === 'eliminar') {
            return false;
        }

        if ($this->esBase()) {
            return true;
        }

        $permisos = [
            self::ROL_VENDEDOR => ['ventas', 'ventas_registro', 'inventario_ver'],
            self::ROL_ALMACENISTA => ['inventario_ver', 'inventario', 'catalogos', 'valuador'],
        ];

        return in_array($permiso, $permisos[$this->rolNormalizado()] ?? [], true);
    }
}
