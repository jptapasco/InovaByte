<?php
namespace App\Livewire\Cajero;

use App\Models\Productos;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Factura extends Component
{
    public $usuario_actual,$productosSeleccionados;

    public function mount()
    {
        $this->usuario_actual = Auth::user();
    }

    public function render()
    {
        if ($this->usuario_actual->rol != 'cajero') {
            return abort('403');
        }
        $this->productosSeleccionados = session()->get('productos_seleccionados', []);
        return view('livewire.Cajero.Dashboard.factura')->extends('layouts.app');
    }
}

