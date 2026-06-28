<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SetDatabaseAuditUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->supportsSessionVariables()) {
            DB::statement('SET @app_usuario = ?', [$this->currentUserLabel($request)]);
        }

        return $next($request);
    }

    private function currentUserLabel(Request $request): string
    {
        $admin = Auth::guard('admin')->user();

        if ($admin) {
            return sprintf('admin:%s %s', $admin->id, $admin->usuario);
        }

        if ($request->session()->has('cliente_id')) {
            return sprintf(
                'cliente:%s %s',
                $request->session()->get('cliente_id'),
                $request->session()->get('cliente_correo', $request->session()->get('cliente_nombre', 'cliente'))
            );
        }

        return 'visitante';
    }

    private function supportsSessionVariables(): bool
    {
        return in_array(DB::getDriverName(), ['mysql', 'mariadb'], true);
    }
}
