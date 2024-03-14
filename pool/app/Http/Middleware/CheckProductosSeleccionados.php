<?php

namespace App\Http\Middleware;

use Closure;

class CheckProductosSeleccionados
{
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('productos_seleccionados')) {
            return redirect()->back()->with('error', 'Debe seleccionar productos antes de facturar.');
        }

        return $next($request);
    }
}
