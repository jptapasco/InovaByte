<?php

namespace App\Livewire\Mesera;
use App\Models\Mesas;
use App\Models\TipoMesas;
use App\Models\Clientes;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MesasAsignadas extends Component
{

    public $user, $mesas, $clientes, $asignar_cliente, $mesa_db;

    public function mount()
    {
        $this->user = Auth::user();
        $this->mesas = Mesas::where('id_mesera_asignada', $this->user->id)->get();
        $this->clientes = Clientes::all();
    }

    public function render()
    {
        return view('livewire.mesera.mesas-asignadas');
    }

    public function tipoMesa($id)
    {
        $busqueda = Mesas::findOrFail($id);
        $tipo_mesa =TipoMesas::FindOrFail($busqueda->id_tipo_mesas);
        $nombre_mesa = $tipo_mesa->nombre_mesa;

        return $nombre_mesa;
    }

    // Filtrar mesas
    public function obtenerMesas()
    {
        $this->mesas = Mesas::where('id_mesera_asignada', $this->user->id)->get();
    }

    public function mesasLibres()
    {
        $this->mesas = Mesas::where('id_mesera_asignada', $this->user->id)->whereNull('id_cliente_asignado')->get();
    }

    public function mesasOcupadas()
    {
        $this->mesas = Mesas::where('id_mesera_asignada', $this->user->id)->whereNotNull('id_cliente_asignado')->get();
    }

    //Funciones mesas
    public function iniciarMesa($id)
    {
        $this->mesa_db = $id;
        $this->clientes = Clientes::where('estado', 'activo')->get();
        $this->asignar_cliente = 0;
        $this->dispatch('show-start-modal');
    }

    public function asignarMesa($id)
    {
        $mesa_a_asignar = Mesas::find($id);
        $mesa_a_asignar->id_cliente_asignado = $this->asignar_cliente;
        $mesa_a_asignar->save();
        $this->dispatch('close-start-modal');
        $this->resetUI();
        $this->obtenerMesas();
    }

    public function cerrarMesa($id)
    {

    }

    // Pedidos

    public function verPedido($id)
    {

    }

    public function agregarPedido($id)
    {

    }

    public function editarPedido($id)
    {

    }

    public function eliminarPedido($id)
    {

    }

    public function resetUI()
    {
        $this->resetValidation();
    }

}
