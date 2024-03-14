<?php

namespace App\Traits;

use App\Models\FacturaDetalles;
use App\Models\Productos;

trait ConsultaProductos
{
    public function actualizarProductos()
    {
        if ($this->categoriaSeleccionada == "Elije la categoria") {
            $this->productos = Productos::all();
        } else {
            $this->productos = Productos::where('categoria', $this->categoriaSeleccionada)->get();
        }
    }

    public function agregarProducto($productoId)
    {
        $productoExistenteIndex = null;

        foreach ($this->productosSeleccionados as $index => $item) {
            if ($item['producto']->id == $productoId) {
                $productoExistenteIndex = $index;
                break;
            }
        }

        if ($productoExistenteIndex !== null) {
            $this->aumentarCantidad($productoExistenteIndex);
        } else {
            $producto = Productos::findOrFail($productoId);
            $producto->cantidad_a_llevar = 1;
            $this->productosSeleccionados[] = [
                'producto' => $producto,
                'cantidad_a_llevar' => 1,
            ];
        }
    }

    public function aumentarCantidad($index)
    {
        $this->productosSeleccionados[$index]['cantidad_a_llevar']++;
        $this->validarCantidad($index);
    }

    public function disminuirCantidad($index)
    {
        if ($this->productosSeleccionados[$index]['cantidad_a_llevar'] > 1) {
            $this->productosSeleccionados[$index]['cantidad_a_llevar']--;
            $this->validarCantidad($index);
        }
    }

    private function validarCantidad($index)
    {
        $producto = $this->productosSeleccionados[$index]['producto'];
        $cantidad_a_llevar = $this->productosSeleccionados[$index]['cantidad_a_llevar'];

        if ($cantidad_a_llevar > $producto->cantidad) {
            $this->productosSeleccionados[$index]['cantidad_a_llevar'] = $producto->cantidad;
        } elseif ($cantidad_a_llevar < 1) {
            $this->productosSeleccionados[$index]['cantidad_a_llevar'] = 1;
        }
    }

    public function eliminarFila($index)
    {
        unset($this->productosSeleccionados[$index]);
    }

    public function facturar()
    {
        $productosSeleccionados = $this->productosSeleccionados;
        session()->put('productos_seleccionados', $productosSeleccionados);
        return redirect()->route('factura');
    }

    public function sumarAFactura()
    {
        $total = 0;
        foreach ($this->productosSeleccionados as $item) {
            $productoNuevo = FacturaDetalles::where('id_producto', $item['producto']->id)->where('id_factura', $this->factura->id)->first();
            if ($productoNuevo) {
                $productoNuevo->update([
                    'cantidad' => $productoNuevo->cantidad +  $item['cantidad_a_llevar'],
                    'subtotal' => $productoNuevo->subtotal +   $item['producto']->precio_venta * $item['cantidad_a_llevar'],

                ]);
            } else {

                FacturaDetalles::create([
                    'id_factura' => $this->factura->id,
                    'id_producto' => $item['producto']->id,
                    'cantidad' => $item['cantidad_a_llevar'],
                    'subtotal' => $item['producto']->precio_venta * $item['cantidad_a_llevar'],

                ]);
            }
            $total += $item['producto']->precio_venta * $item['cantidad_a_llevar'];
            $producto = Productos::find($item['producto']->id);
            $producto->cantidad -= $item['cantidad_a_llevar'];
            $producto->save();
        }
        $this->factura->update([
            'total' => $this->factura->total + $total,
        ]);
        session()->forget('productos_seleccionados');
        $this->dispatch('close-modal-chistoso');
    }

}
