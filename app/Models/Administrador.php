<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrador extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROL_ADMIN = 'admin';
    public const ROL_ADMINISTRADOR_INVENTARIO = 'administrador_inventario';
    public const ROL_GERENTE_VENTAS = 'gerente_ventas';
    public const ROL_VENDEDOR = 'vendedor';

    public const ROLES = [
        self::ROL_ADMIN => 'Admin',
        self::ROL_ADMINISTRADOR_INVENTARIO => 'Administrador de inventario',
        self::ROL_GERENTE_VENTAS => 'Gerente de ventas',
        self::ROL_VENDEDOR => 'Vendedor',
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

    public function puede(string $permiso): bool
    {
        $rol = $this->rolNormalizado();

        if (in_array($rol, [self::ROL_ADMIN, 'administrador', 'superadmin', 'gerente'], true)) {
            return true;
        }

        $permisos = [
            self::ROL_ADMINISTRADOR_INVENTARIO => ['inventario', 'catalogos'],
            self::ROL_GERENTE_VENTAS => ['ventas', 'pagos'],
            self::ROL_VENDEDOR => ['citas', 'ventas_registro'],
            'inventario' => ['inventario', 'catalogos'],
            'ventas' => ['ventas', 'pagos'],
        ];

        return in_array($permiso, $permisos[$rol] ?? [], true);
    }
}
