<?php
namespace App\Livewire\Cajero;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
use App\Models\Mesas;
use App\Models\TipoMesas;

class MeserasCajero extends Component
{
    public $usuario_actual, $lista_meseras,$nombres_mesas, $opcionSeleccionada,$id_usuario,$detalles_mesera,$nombres_mesera,$id_tipo_mesas,$tipo_mesas;

    public function mount()
    {
        $this->usuario_actual = Auth::user();
        $this->lista_meseras = User::where('rol', 'mesera')->get();
        $this->opcionSeleccionada = 'todas';
    }

    public function render()
    {
        if ($this->usuario_actual == null) {
            return abort('403');
        } else if ($this->usuario_actual->rol != 'cajero') {
            return abort('403');
        }

        $mesas_asignadas = [];

        foreach ($this->lista_meseras as $mesera) {
            $mesas_asignadas[$mesera->id] = Mesas::where('id_mesera_asignada', $mesera->id)->count();
        }

        return view('livewire.Cajero.Meseras.meseras_cajero', compact('mesas_asignadas'))->extends('layouts.app');
    }

    public function actualizarMesera()
    {

    }

    public function actualizarIdUsuario($id, $opc)
    {
        $this->id_usuario = $id;
        if ($opc == 1) {
            $this->dispatch('show-modal-eliminar-usuario');
        } elseif ($opc == 2) {
            $this->dispatch('show-modal-activar-usuario');
        }
    }

    public function eliminarUsuario()
    {
        $usuario = User::find($this->id_usuario);
        $usuario->update([
            'estado' => 'inactivo',
        ]);
        $this->usuarios = User::all();
        $this->dispatch('hide-modal-eliminar-usuario');
        return redirect()->route('meseras_cajero');     
    }

    public function activarUsuario()
    {
        $usuario = User::find($this->id_usuario);
        $usuario->update([
            'estado' => 'activo',
        ]);
        $this->usuarios = User::all();
        $this->dispatch('hide-modal-activar-usuario');
        return redirect()->route('meseras_cajero');
    }

    public function cargarMesasMesera($id)
    {
        $this->id_mesera = $id;
        $this->nombres_mesera = User::find($id)->nombres;

        $this->id_tipo_mesas = Mesas::select('id_tipo_mesas')
            ->where('id_mesera_asignada', $id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->pluck('id_tipo_mesas');

        $this->nombres_mesas = TipoMesas::whereIn('id', $this->id_tipo_mesas)->pluck('nombre_mesa');
        
        $this->dispatch('show-modal');
    }



    public function abrirModalMesasMesera()
    {
        $this->dispatch('show-modal-add-obs');
    }
}
