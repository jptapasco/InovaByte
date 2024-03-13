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
        if ($usuarioActual->rol == 'admin') {
            return redirect('dashboard_admin');
        }

        if ($usuarioActual->rol == 'cajero') {
            return redirect('dashboard_cajero');
        }

        if ($usuarioActual->rol == 'mesera') {
            return redirect('dashboard_mesera');
        }
    }
}