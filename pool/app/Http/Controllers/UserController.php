<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Mesas;
use App\Models\Clientes;

class UserController extends Controller
{

    public function mesera_index()
    {
        $user = Auth::user();

        return view('mesera.index', compact('user'));
    }

    public function mesera_mesas()
    {
        $user = Auth::user();
        $mesas = Mesas::where('id_mesera_asignada', $user->id);
        return view('mesera.mesas', compact('user', 'mesas'));
    }

    public function mesera_clientes()
    {
        $user = Auth::user();
        $clientes = Clientes::all();
        return view('mesera.clientes', compact('clientes', 'user'));
    }
}
