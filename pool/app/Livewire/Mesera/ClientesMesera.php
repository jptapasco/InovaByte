<?php

namespace App\Livewire\Mesera;

use App\Models\Clientes;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClientesMesera extends Component
{
    public $usuario_actual, $clientes, $id_cliente, $nombre_cliente, $datos_cliente, $nombres_cliente, $telefono_cliente, $documento_cliente, $horas_jugadas_cliente, $horas_regalo_cliente, $search;
    public function mount()
    {
        $this->usuario_actual = Auth::user();
    }
    public function render()
    {
        if($this->usuario_actual == null){
            return abort('403');
        }else if ($this->usuario_actual->rol != 'mesera') {
            return abort('403');
        }
        $strSearch = $this->search == '' ? false : '%' . str_replace(' ', '%', $this->search) . '%';
        $this->clientes = Clientes::when($strSearch, function ($query, $strSearch) {
            return $query->where(
                function ($query) use ($strSearch) {
                    $query->where('nombres', 'like', $strSearch)
                        ->orWhere('telefono', 'like', $strSearch)
                        ->orWhere('documento', 'like', $strSearch)
                        ->orWhere('estado', 'like', $strSearch);
                }
            );
        })->get();
        return view('livewire.Mesera.clientes-mesera')->extends('layouts.app')->section('content');
    }
    public function update()
    {
        $rules = [
            'nombres_cliente' => 'required',
            'telefono_cliente' => 'required|numeric',
            'documento_cliente' => 'required|numeric|unique:clientes,documento',
            'horas_jugadas_cliente' => 'required|numeric',
            'horas_regalo_cliente' => 'required|numeric',
        ];
        $messages = [
            'nombres_cliente.required' => 'Debe ingresar un nombre',
            'telefono_cliente.required' => 'Debe ingresar un teléfono',
            'telefono_cliente.numeric' => 'No se permiten letras o signos',
            'documento_cliente.required' => 'Debe ingresar un documento',
            'documento_cliente.numeric' => 'No se permiten letras o signos',
            'documento_cliente.unique' => 'Documento ya ingresado',
            'horas_jugadas_cliente.required' => 'Debe ingresar una cantidad de horas jugadas',
            'horas_jugadas_cliente.numeric' => 'No se permiten letras o signos',
            'horas_regalo_cliente.required' => 'Debe ingresar una cantidad de horas de regalo',
            'horas_regalo_cliente.numeric' => 'No se permiten letras o signos',
        ];
        $this->validate($rules, $messages);

        $this->datos_cliente->update([
            'nombres' => $this->nombres_cliente,
            'telefono' => $this->telefono_cliente,
            'documento' => $this->documento_cliente,
            'horas_jugadas' => $this->horas_jugadas_cliente,
            'horas_regalo' => $this->horas_regalo_cliente,
        ]);
        $this->resetUI();
        $this->dispatch('hide-modal-editar-cliente');
    }
    public function store()
    {
        $rules = [
            'nombres_cliente' => 'required',
            'telefono_cliente' => 'required|numeric',
            'documento_cliente' => 'required|numeric',
            'horas_jugadas_cliente' => 'required|numeric',
            'horas_regalo_cliente' => 'required|numeric',
        ];
        $messages = [
            'nombres_cliente.required' => 'Debe ingresar un nombre',
            'telefono_cliente.required' => 'Debe ingresar un teléfono',
            'telefono_cliente.numeric' => 'No se permiten letras o signos',
            'documento_cliente.required' => 'Debe ingresar un documento',
            'documento_cliente.numeric' => 'No se permiten letras o signos',
            'horas_jugadas_cliente.required' => 'Debe ingresar una hora',
            'horas_jugadas_cliente.numeric' => 'No se permiten letras o signos',
            'horas_regalo_cliente.required' => 'Debe ingresar una hora',
            'horas_regalo_cliente.numeric' => 'No se permiten letras o signos',
        ];
        $this->validate($rules, $messages);

        $this->datos_cliente = Clientes::create([
            'nombres' => $this->nombres_cliente,
            'telefono' => $this->telefono_cliente,
            'documento' => $this->documento_cliente,
            'ultima_visita' => now(),
            'horas_jugadas' => $this->horas_jugadas_cliente,
            'horas_regalo' => $this->horas_regalo_cliente,
        ]);
        $this->resetUI();
        $this->dispatch('hide-modal-crear-cliente');
    }
    public function eliminarCliente()
    {
        $cliente = Clientes::find($this->id_cliente);
        $cliente->update([
            'estado' => 'inactivo',
        ]);
        $this->clientes = Clientes::all();
        $this->dispatch('hide-modal-eliminar-cliente');
    }
    public function activarCliente()
    {
        $cliente = Clientes::find($this->id_cliente);
        $cliente->update([
            'estado' => 'activo',
        ]);
        $this->clientes = Clientes::all();
        $this->dispatch('hide-modal-activar-cliente');
    }
    public function abrirModalCrear()
    {
        $this->resetUI();
        $this->dispatch('show-modal-crear-cliente');
    }
    public function actualizarIdCliente($id, $opc)
    {
        $this->id_cliente = $id;
        if ($opc == 1) {
            $this->dispatch('show-modal-eliminar-cliente');
        } elseif ($opc == 2) {
            $this->dispatch('show-modal-activar-cliente');
        } else {
            $this->datos_cliente = Clientes::find($id);
            $this->nombres_cliente = $this->datos_cliente->nombres;
            $this->telefono_cliente = $this->datos_cliente->telefono;
            $this->documento_cliente = $this->datos_cliente->documento;
            $this->horas_jugadas_cliente = $this->datos_cliente->horas_jugadas;
            $this->horas_regalo_cliente = $this->datos_cliente->horas_regalo;
            $this->dispatch('show-modal-editar-cliente');
        }
    }

    public function resetUI()
    {
        $this->resetValidation();
        $this->datos_cliente = null;
        $this->nombres_cliente = null;
        $this->telefono_cliente = null;
        $this->documento_cliente = null;
        $this->horas_jugadas_cliente = null;
        $this->horas_regalo_cliente = null;
    }
}
