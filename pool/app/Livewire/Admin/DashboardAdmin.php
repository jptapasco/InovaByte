<?php

namespace App\Livewire\Admin;

use App\Models\EmpleadoObservaciones;
use App\Models\PlataCajeros;
use App\Models\User;
use App\Models\UsuarioObservaciones;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardAdmin extends Component
{
    public $usuario_actual, $fondos_dia_anterior, $fondos_dia, $empleados, $nombres_empleados, $detalles_empleados, $id_empleado, $observacion, $search;
    public function mount()
    {
        $this->usuario_actual = Auth::user();
    }
    public function render()
    {
        $this->fondos_dia = PlataCajeros::where('estado', 'activo')->first();
        $this->fondos_dia_anterior = PlataCajeros::find(PlataCajeros::max('id'));
        if($this->usuario_actual == null){
            return abort('403');
        }else if ($this->usuario_actual->rol != 'admin') {
            return abort('403');
        }
        $strSearch = $this->search == '' ? false : '%' . str_replace(' ', '%', $this->search) . '%';
        $this->empleados = User::where('rol', '!=', 'admin')->when($strSearch, function ($query, $strSearch) {
            return $query->where(
                function ($query) use ($strSearch) {
                    $query  ->where('nombres', 'like', $strSearch)
                            ->orWhere('email', 'like', $strSearch)
                            ->orWhere('telefono', 'like', $strSearch)
                            ->orWhere('documento', 'like', $strSearch)
                            ->orWhere('rol', 'like', $strSearch)
                            ->orWhere('estado', 'like', $strSearch);
                }
            );
        })->get();
        return view('livewire.Admin.Dashboard.dashboard-admin')->extends('layouts.app')->section('content');
    }
    public function abrirDia()
    {
        $this->fondos_dia = PlataCajeros::create([
            'estado' => 'activo',
            'dinero_inicio_dia' => $this->fondos_dia_anterior->dinero_fin_dia,
            'dinero_fin_dia' => $this->fondos_dia_anterior->dinero_fin_dia,
        ]);
    }
    public function cerrarDia()
    {
        $this->fondos_dia->update([
            'estado' => 'finalizado',
        ]);
        $this->fondos_dia_anterior = $this->fondos_dia;
        $this->fondos_dia = null;
    }
    public function cargarObservacionesEmpleado($id)
    {
        $this->id_empleado = $id;
        $this->nombres_empleados = User::find($id)->nombres;
        $this->detalles_empleados = UsuarioObservaciones::where('id_usuario', $id)->orderBy('created_at', 'desc')->get();
        $this->dispatch('show-modal');
    }
    public function deleteObservacion($id)
    {
        $detalle = UsuarioObservaciones::find($id);
        $detalle->delete();
        $this->detalles_empleados = UsuarioObservaciones::where('id_usuario', $this->id_empleado)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function abrirModalObservacion()
    {
        $this->dispatch('show-modal-add-obs');
    }
    public function addObservacion()
    {
        UsuarioObservaciones::create([
            'id_usuario' => $this->id_empleado,
            'observacion' => $this->observacion,
        ]);
        $this->detalles_empleados = UsuarioObservaciones::where('id_usuario', $this->id_empleado)
            ->orderBy('created_at', 'desc')
            ->get();
        $this->dispatch('close-modal-add-obs');

    }
    public function resetUI()
    {
        $this->resetValidation();
    }
}
