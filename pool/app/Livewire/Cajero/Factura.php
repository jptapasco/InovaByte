<?php
namespace App\Livewire\Cajero;

use App\Models\Productos;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Facturas;
use App\Models\FacturaDetalles;
use Carbon\Carbon;

class Factura extends Component
{
    public $usuario_actual, $productosSeleccionados, $dineroRecibido, $total, $vueltoCalculado;

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
        $this->productosSeleccionados = session()->get('productos_seleccionados', []);
        $this->calcularTotal();
        return view('livewire.Cajero.Dashboard.factura')->extends('layouts.app');
    }

    public function calcularTotal()
    {
        $this->total = 0;
        foreach ($this->productosSeleccionados as $item) {
            $subtotal = $item['producto']->precio_venta * $item['cantidad_a_llevar'];
            $this->total += $subtotal;
        }
    }

    public function calcularVuelto()
    {
        if ($this->dineroRecibido >= $this->total) {
            $this->vueltoCalculado = $this->dineroRecibido - $this->total;
        } else {
            $this->addError('dineroRecibido', 'El dinero recibido debe ser igual o mayor al total.');
        }
    }

    public function generarFactura()
    {
        $factura = Facturas::create([
            'id_mesa' => 0,
            'id_cliente' => 1,
            'id_vendedor' => $this->usuario_actual->id,
            'total' => $this->total,
            'hora_inicio' => Carbon::now(),
            'hora_fin' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $idFactura = $factura->id;

        foreach ($this->productosSeleccionados as $item) {
            FacturaDetalles::create([
                'id_factura' => $idFactura,
                'id_producto' => $item['producto']->id,
                'cantidad' => $item['cantidad_a_llevar'],
                'subtotal' => $item['producto']->precio_venta * $item['cantidad_a_llevar'],
            ]);
            $producto = Productos::find($item['producto']->id);
            $producto->cantidad -= $item['cantidad_a_llevar'];
            $producto->save();
        }
   
        session()->forget('productos_seleccionados');
   
    }
}
