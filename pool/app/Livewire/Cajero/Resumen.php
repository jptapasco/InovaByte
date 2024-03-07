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

        foreach ($id_facturas as $id_factura) {
            $id_mesa = Facturas::find($id_factura)->id_mesa;
            $id_tipo_mesa = Mesas::find($id_mesa)->id_tipo_mesas;
            $nombre_mesa = TipoMesas::find($id_tipo_mesa)->nombre_mesa;

            $facturas_con_mesas[$id_factura] = $nombre_mesa;
        }

        return view('livewire.Cajero.Resumen.resumen', compact('detalles_factura', 'facturas_con_mesas'))->extends('layouts.app');
    }


}
