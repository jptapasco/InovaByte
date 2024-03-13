<?php
namespace App\Livewire\Cajero;

use App\Models\Productos;
use App\Traits\ConsultaProductos;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardCajero extends Component
{
    use ConsultaProductos;
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
}