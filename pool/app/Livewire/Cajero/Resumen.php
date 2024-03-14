<?php

namespace App\Livewire\Cajero;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Mesas;
use App\Models\Facturas;
use App\Models\TipoMesas;
use App\Models\FacturaDetalles;
use App\Models\Productos;
use Carbon\Carbon;

class Resumen extends Component
{
    public $usuario_actual;

    public function mount()
    {
        $this->usuario_actual = Auth::user();
    }

    public function render()
    {
        if($this->usuario_actual == null){
            return abort('403');
        } else if ($this->usuario_actual->rol != 'cajero') {
            return abort('403');
        }
        
        $fecha_actual = Carbon::now()->format('Y-m-d');
        $detalles_factura = FacturaDetalles::whereDate('created_at', $fecha_actual)->get();
        $id_facturas = $detalles_factura->pluck('id_factura');

        $facturas_con_mesas = [];
        $nombres=[];

        foreach ($id_facturas as $id_factura) {
            $id_mesa = Facturas::find($id_factura)->id_mesa;
            $id_tipo_mesa = Mesas::find($id_mesa) ? Mesas::find($id_mesa)->id_tipo_mesas : 0;
            $nombre_mesa = $id_tipo_mesa != 0 ? TipoMesas::find($id_tipo_mesa)->nombre_mesa : 'Cajero';
            $nombres[$id_factura] = $nombre_mesa;
            $numero_mesa =  $id_tipo_mesa != 0 ? Mesas::find($id_tipo_mesa)->numero : 0;
            $facturas_con_mesas[$id_factura] = $numero_mesa;
        }

        $productos_nombres = [];
        foreach ($detalles_factura as $detalle) {
            $producto = Productos::find($detalle->id_producto);
            if ($producto) {
                $productos_nombres[$detalle->id_producto] = $producto->nombre;
            } else {
                $productos_nombres[$detalle->id_producto] = 'Producto no encontrado';
            }
        }

        return view('livewire.Cajero.Resumen.resumen', compact('detalles_factura','nombres', 'facturas_con_mesas', 'productos_nombres'))->extends('layouts.app');
    }
}
