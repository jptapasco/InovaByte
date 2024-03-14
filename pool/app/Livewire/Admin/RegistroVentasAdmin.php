<?php

namespace App\Livewire\Admin;

use App\Models\Clientes;
use App\Models\FacturaDetalles;
use App\Models\Facturas;
use App\Models\Productos;
use App\Traits\ConsultaFacturas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class RegistroVentasAdmin extends Component
{
    use ConsultaFacturas;

    public $usuario_actual, $facturas, $id_factura, $datos_factura, $detalles_productos, $detalles_factura_detalles ,$nombre_cliente_factura, $hora_inicio_factura, $hora_fin_factura, $desde, $hasta, $cantidades_productos, $subtotales_productos, $id_tipo_mesa;
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

        $this->consultarFacturas();

        return view('livewire.Admin.RegistroVentas.registro-ventas-admin')->extends('layouts.app')->section('content');
    }
    
    public function resetUI()
    {
        $this->resetValidation();
        $this->datos_factura = null;
        $this->nombre_cliente_factura = null;
        $this->hora_inicio_factura = null;
        $this->hora_fin_factura = null;
    }
}