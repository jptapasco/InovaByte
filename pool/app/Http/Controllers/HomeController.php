<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $usuarioActual = Auth::user();
        if ($usuarioActual->rol == 'admin' && $usuarioActual->estado == 'activo') {
            return redirect('dashboard_admin');
        }else if($usuarioActual->rol == 'admin'){
            return abort('403');
        }

        if ($usuarioActual->rol == 'cajero' && $usuarioActual->estado == 'activo') {
            return redirect('dashboard_cajero');
        }else if($usuarioActual->rol == 'cajero'){
            return abort('403');
        }

        if ($usuarioActual->rol == 'mesera' && $usuarioActual->estado == 'activo') {
            return redirect('dashboard_mesera');
        }else if($usuarioActual->rol == 'mesera'){
            return abort('403');
        }
    }
}