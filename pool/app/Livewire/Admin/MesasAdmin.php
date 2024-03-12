<?php

namespace App\Livewire\Admin;

use App\Models\Mesas;
use App\Models\UsuarioObservaciones;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class MesasAdmin extends Component
{
    public $usuario_actual, $mesas, $datos_mesa, $id_mesa, $tipo_mesa, $numero_mesa;
    public function mount()
    {
        $this->usuario_actual = Auth::user();
    }
    public function render()
    {
        if($this->usuario_actual == null){
            return abort('403');
        }else if ($this->usuario_actual->rol != 'admin') {
            return abort('403');
        }
        $this->mesas = Mesas::select(
            'mesas.*',
            'tipo_mesas.nombre_mesa as nombre_mesa',
            'users.nombres as nombre_mesera'
        )
            ->join('tipo_mesas', 'tipo_mesas.id', 'mesas.id_tipo_mesas')
            ->leftJoin('users', 'users.id', 'mesas.id_mesera_asignada')
            ->get();
        return view('livewire.Admin.Mesas.mesas-admin')->extends('layouts.app')->section('content');
    }
    public function store()
    {
        $rules = [
            'tipo_mesa' => [Rule::notIn(0)],
            'numero_mesa' => 'required|numeric',

        ];
        $messages = [
            'tipo_mesa.not_in' => 'Debe seleccionar un tipo de mesa',
            'numero_mesa.required' => 'Debe ingresar un numero',
            'numero_mesa.numeric' => 'No se permiten letras o signos',
        ];
        $this->validate($rules, $messages);

        $this->datos_mesa = Mesas::create([
            'id_tipo_mesas' => $this->tipo_mesa,
            'numero' => $this->numero_mesa,
        ]);
        $this->resetUI();
        $this->dispatch('hide-modal-crear-mesa');
    }
    public function update()
    {
        $rules = [
            'tipo_mesa' => [Rule::notIn(0)],
            'numero_mesa' => 'required|numeric',

        ];
        $messages = [
            'tipo_mesa.not_in' => 'Debe seleccionar un tipo de mesa',
            'numero_mesa.required' => 'Debe ingresar un numero',
            'numero_mesa.numeric' => 'No se permiten letras o signos',
        ];
        $this->validate($rules, $messages);

        $this->datos_mesa->update([
            'id_tipo_mesas' => $this->tipo_mesa,
            'numero' => $this->numero_mesa,
        ]);
        $this->resetUI();
        $this->dispatch('hide-modal-editar-mesa');
    }
    public function abrirModalCrear()
    {
        $this->resetUI();
        $this->dispatch('show-modal-crear-mesa');
    }
    public function eliminarMesa()
    {
        $mesa = Mesas::find($this->id_mesa);
        $mesa->update([
            'estado' => 'inactivo',
        ]);
        $this->dispatch('hide-modal-eliminar-mesa');
    }
    public function activarMesa()
    {
        $mesa = Mesas::find($this->id_mesa);
        $mesa->update([
            'estado' => 'activo',
        ]);
        $this->dispatch('hide-modal-activar-mesa');
    }
    public function actualizarIdMesa($id, $opc)
    {
        $this->id_mesa = $id;
        if ($opc == 1) {
            $this->dispatch('show-modal-eliminar-mesa');
        } elseif ($opc == 2) {
            $this->dispatch('show-modal-activar-mesa');
        } else {
            $this->datos_mesa = Mesas::find($id);
            $this->tipo_mesa = $this->datos_mesa->id_tipo_mesas;
            $this->numero_mesa = $this->datos_mesa->numero;
            $this->dispatch('show-modal-editar-mesa');
        }
    }
    
    public function resetUI()
    {
        $this->resetValidation();
    }
}
