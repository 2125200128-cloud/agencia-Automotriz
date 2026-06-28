<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminPermission
{
    public function handle(Request $request, Closure $next, string ...$permisos): Response
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            abort(403);
        }

        if (in_array('master', $permisos, true) && !$admin->esMaster()) {
            abort(403, 'Solo un administrador master puede acceder a esta seccion.');
        }

        foreach ($permisos as $permiso) {
            if ($admin->puede($permiso)) {
                return $next($request);
            }
        }

        abort(403, 'No tienes permiso para acceder a esta seccion.');
    }
}
