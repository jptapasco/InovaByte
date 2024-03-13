<?php

namespace App\Livewire\Mesera;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Mesas;
use App\Models\TipoMesas;
use App\Models\Facturas;
use App\Models\FacturaDetalles;
use App\Models\Productos;
use Carbon\Carbon;

class IndexMesera extends Component
{
    public $usuario_actual,$id_factura_d,$factura_detalle,$facturas;

    public function mount()
    {
        $this->usuario_actual = Auth::user();
    }

    public function render()
    {
        $fecha_actual = Carbon::now()->format('Y-m-d');
        $mesas = Mesas::where('id_mesera_asignada', $this->usuario_actual->id)->get();
        $nombres = [];
        $id_factura = [];

        foreach ($mesas as $mesa) {
            $nombre_mesa = TipoMesas::where('id', $mesa->id_tipo_mesas)->value('nombre_mesa');
            $this->facturas = Facturas::where('id_mesa', $mesa->id)
                                ->whereDate('hora_inicio', $fecha_actual)
                                ->get(['id', 'hora_inicio','total']);

            foreach ($this->facturas as $factura) {
                $id_factura[] = [
                    'hora_inicio' => $factura->hora_inicio,
                    'id' => $factura->id,
                    'total' => $factura->total,
                ];
            }
            
            $nombres[] = $nombre_mesa;
        }
        

        return view('livewire.mesera.index-mesera', compact('nombres','id_factura','mesas'));
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
}
