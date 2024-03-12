<?php
namespace App\Livewire\Cajero;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Models\Mesas;
use App\Models\User;
use Livewire\Component;

class MesasCajero extends Component
{
    public $usuario_actual, $mesas, $meseras, $meserasSeleccionadas = [];

    public function mount()
    {
        $this->usuario_actual = Auth::user();
        $this->mesas = Mesas::all();
        $this->meseras = User::where('rol', 'mesera')->get();
    }

    public function render()
    {
        if($this->usuario_actual == null){
            return abort('403');
        }else if ($this->usuario_actual->rol != 'cajero') {
            return abort('403');
        }
        return view('livewire.Cajero.Mesas.mesas-cajero')->extends('layouts.app');
    }

    public function obtenerMesas()
    {
        $this->mesas = Mesas::all();
    }
    public function obtenerMesasDisponibles()
    {
        $this->mesas = Mesas::whereNull('id_mesera_asignada')->get();
    }
    public function obtenerMesasOcupadas()
    {
        $this->mesas = Mesas::whereNotNull('id_mesera_asignada')->get();
    }

    public function modalConfirmarMesera($opc)
    {
        if ($opc == 1) {
            $this->dispatch('show-modal-asignar-mesera');
        }elseif ($opc == 2) {
            $this->dispatch('show-modal-cambiar-mesera');
        }
    }

    public function asignarMesera($id)
    {
        if (isset($this->meserasSeleccionadas[$id])) {
            try {
                $meseraId = $this->meserasSeleccionadas[$id];
                if ($meseraId != "") {
                    $mesa = Mesas::find($id);
                    $mesa->id_mesera_asignada = $meseraId;
                    $mesa->save();
                    $this->redirectRoute('mesas_cajero');
                }
            } catch (ModelNotFoundException $exception ) {
                session()->flash('error', 'La mesera no fue encontrada.');
                redirect()->route('mesas_cajero');
            }
        } else {
            session()->flash('error', 'El ID de la mesa no es válido.');
            redirect()->route('mesas_cajero');
        }
    }    

    public function habilitarMesa($id)
    {
        try {
            $mesa = Mesas::findOrFail($id);
            $mesa->load('tipoMesa');
            $mesa->id_mesera_asignada = null;
            $mesa->save();
            $this->redirectRoute('mesas_cajero');
        } catch (ModelNotFoundException $exception ) {
            session()->flash('error', 'La mesa no fue encontrada.');
            redirect()->route('mesas_cajero');
        }
    }
}

