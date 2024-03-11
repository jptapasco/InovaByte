<?php

namespace App\Livewire\Admin;

use App\Models\Facturas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegistroVentasAdmin extends Component
{
    public $usuario_actual, $facturas, $id_factura, $datos_factura;
    public function mount()
    {
        $this->usuario_actual = Auth::user();
    }
    public function render()
    {
        if($this->usuario_actual == null){
            return abort('403');
        }else if ($this->usuario_actual->rol != 'admin') {
            return abort('403');
        }
        $this->facturas = Facturas::select(
            'facturas.*',
            'users.nombres as nombres_vendedor',
            'clientes.documento as documento_cliente'
        )
            ->join('users', 'users.id', 'facturas.id_vendedor')
            ->join('clientes', 'clientes.id', 'facturas.id_cliente')
            ->get();
        
        return view('livewire.Admin.RegistroVentas.registro-ventas-admin')->extends('layouts.app')->section('content');
    }
}