<?php

namespace App\Livewire\Mesera;

use App\Models\Clientes;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Mesas;
use App\Models\TipoMesas;
use App\Models\Facturas;
use App\Models\FacturaDetalles;
use App\Models\Productos;
use App\Traits\ConsultaFacturas;
use Carbon\Carbon;

class IndexMesera extends Component
{
    use ConsultaFacturas;

    public $hora, $usuario_actual, $id_factura_d, $factura_detalle, $facturas, $desde, $hasta, $datos_factura, $nombre_cliente_factura, $hora_inicio_factura, $hora_fin_factura, $detalles_productos, $cantidades_productos, $subtotales_productos;

    public function mount()
    {
        $this->usuario_actual = Auth::user();
    }

    public function render()
    {        if($this->usuario_actual == null){
        return abort('403');
    }else if ($this->usuario_actual->rol != 'mesera') {
        return abort('403');
    }
        $this->consultarFacturas(1);       

        return view('livewire.mesera.index-mesera')->extends('layouts.app')->section('content');
    }
    public function cargarDetalleFactura($id)
    {
        $this->id_factura_d = [$id];
        $this->factura_detalle = FacturaDetalles::whereIn('id_factura', $this->id_factura_d)->get();

        foreach ($this->factura_detalle as $detalle) {
            $producto = Productos::find($detalle->id_producto);
            $detalle->nombre_producto = $producto ? $producto->nombre : 'Producto no encontrado';
        }

        $this->dispatch('show-modal');
    }


    public function abrirModalDetalleFactura()
    {
        $this->dispatch('show-modal-add-obs');
    }
    public function resetUI()
    {
        
    }
}
