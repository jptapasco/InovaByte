<?php
namespace App\Livewire\Cajero;

use App\Models\Productos;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardCajero extends Component
{
    public $usuario_actual, $productos, $categoriaSeleccionada, $productosSeleccionados = [];

    public function mount()
    {
        $this->usuario_actual = Auth::user();
        $this->productos = Productos::all();
    }

    public function render()
    {
        if($this->usuario_actual == null){
            return abort('403');
        }else if ($this->usuario_actual->rol != 'cajero') {
            return abort('403');
        }
        return view('livewire.Cajero.Dashboard.dashboard-cajero')->extends('layouts.app');
    }

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
        $producto = Productos::findOrFail($productoId);
        $producto->cantidad_a_llevar = 1;
        $this->productosSeleccionados[] = [
            'producto' => $producto,
            'cantidad_a_llevar' => 1,
        ];
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

    public function facturar()
    {
        $productosSeleccionados = $this->productosSeleccionados;
        session()->put('productos_seleccionados', $productosSeleccionados);
        return redirect()->route('factura');
    }


    public function vistaFacturar()
    {
       
        return redirect()->route('factura');
    }

}

