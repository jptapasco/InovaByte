<?php

namespace App\Livewire\Admin;

use App\Models\Mesas;
use App\Models\User;
use App\Models\UsuarioObservaciones;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UsuariosAdmin extends Component
{
    public $usuario_actual, $usuarios, $id_usuario, $nombres_usuario, $observaciones_usuario, $datos_usuario, $rol_usuario, $email_usuario, $contrasena_usuario, $telefono_usuario, $documento_usuario, $observacion, $search;
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
        $strSearch = $this->search == '' ? false : '%' . str_replace(' ', '%', $this->search) . '%';
        $this->usuarios = User::when($strSearch, function ($query, $strSearch) {
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
        return view('livewire.Admin.Usuarios.usuarios-admin')->extends('layouts.app')->section('content');
    }
    public function store()
    {
        $rules = [
            'rol_usuario' => [Rule::notIn(0)],
            'nombres_usuario' => 'required',
            'email_usuario' => 'required|email',
            'telefono_usuario' => 'required|numeric',
            'documento_usuario' => 'required|numeric',
            'contrasena_usuario' => 'required',
        ];
        $messages = [
            'rol_usuario.not_in' => 'Debe seleccionar un rol',
            'nombres_usuario.required' => 'Debe ingresar un nombre',
            'email_usuario.required' => 'Debe ingresar un correo',
            'email_usuario.email' => 'Debe ingresar un correo válido',
            'telefono_usuario.required' => 'Debe ingresar un teléfono',
            'telefono_usuario.numeric' => 'No se permiten letras o signos',
            'documento_usuario.required' => 'Debe ingresar un documento',
            'documento_usuario.numeric' => 'No se permiten letras o signos',
            'contrasena_usuario.required' => 'Debe ingresar una contraseña',
        ];
        $this->validate($rules, $messages);

        $this->datos_usuario = User::create([
            'rol' => $this->rol_usuario,
            'nombres' => $this->nombres_usuario,
            'email' => $this->email_usuario,
            'telefono' => $this->telefono_usuario,
            'documento' => $this->documento_usuario,
            'password' => Hash::make($this->contrasena_usuario),
        ]);
        $this->resetUI();
        $this->dispatch('hide-modal-crear-usuario');
    }
    public function update()
    {
        $rules = [
            'nombres_usuario' => 'required',
            'email_usuario' => 'required|email',
            'telefono_usuario' => 'required|numeric',
            'documento_usuario' => 'required|numeric',
        ];
        $messages = [
            'nombres_usuario.required' => 'Debe ingresar un nombre',
            'email_usuario.required' => 'Debe ingresar un correo',
            'email_usuario.email' => 'Debe ingresar un correo válido',
            'telefono_usuario.required' => 'Debe ingresar un teléfono',
            'telefono_usuario.numeric' => 'No se permiten letras o signos',
            'documento_usuario.required' => 'Debe ingresar un documento',
            'documento_usuario.numeric' => 'No se permiten letras o signos',
        ];
        $this->validate($rules, $messages);

        $this->datos_usuario->update([
            'rol' => $this->rol_usuario,
            'nombres' => $this->nombres_usuario,
            'email' => $this->email_usuario,
            'telefono' => $this->telefono_usuario,
            'documento' => $this->documento_usuario,
        ]);
        $this->resetUI();
        $this->dispatch('hide-modal-editar-usuario');
    }
    public function eliminarUsuario()
    {
        $usuario = User::find($this->id_usuario);
        $usuario->update([
            'estado' => 'inactivo',
        ]);
        $asignaciones = Mesas::where('id_mesera_asignada', $this->id_usuario)->get();
        foreach ($asignaciones as $asignacion) {
            $asignacion->update([
                'id_mesera_asignada' => null,
            ]);
        }
        $this->dispatch('hide-modal-eliminar-usuario');
    }
    public function activarUsuario()
    {
        $usuario = User::find($this->id_usuario);
        $usuario->update([
            'estado' => 'activo',
        ]);
        $this->dispatch('hide-modal-activar-usuario');
    }
    public function abrirModalObservacion()
    {
        $this->dispatch('show-modal-add-obs');
    }
    public function abrirModalCrear()
    {
        $this->resetUI();
        $this->dispatch('show-modal-crear-usuario');
    }
    public function cargarObservaciones($id)
    {
        $this->id_usuario = $id;
        $this->nombres_usuario = User::find($id)->nombres;
        $this->observaciones_usuario = UsuarioObservaciones::where('id_usuario', $id)->orderBy('created_at', 'desc')->get();
        $this->dispatch('show-modal-observaciones-usuario');
    }
    public function deleteObservacion($id)
    {
        $detalle = UsuarioObservaciones::find($id);
        $detalle->delete();
        $this->observaciones_usuario = UsuarioObservaciones::where('id_usuario', $this->id_usuario)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function addObservacion()
    {
        UsuarioObservaciones::create([
            'id_usuario' => $this->id_usuario,
            'observacion' => $this->observacion,
        ]);
        $this->observaciones_usuario = UsuarioObservaciones::where('id_usuario', $this->id_usuario)
            ->orderBy('created_at', 'desc')
            ->get();
        $this->dispatch('close-modal-add-obs');
    }
    public function actualizarIdUsuario($id, $opc)
    {
        $this->id_usuario = $id;
        if ($opc == 1) {
            $this->dispatch('show-modal-eliminar-usuario');
        } elseif ($opc == 2) {
            $this->dispatch('show-modal-activar-usuario');
        } else {
            $this->datos_usuario = User::find($id);
            $this->rol_usuario = $this->datos_usuario->rol;
            $this->nombres_usuario = $this->datos_usuario->nombres;
            $this->email_usuario = $this->datos_usuario->email;
            $this->telefono_usuario = $this->datos_usuario->telefono;
            $this->documento_usuario = $this->datos_usuario->documento;
            $this->dispatch('show-modal-editar-usuario');
        }
    }

    public function resetUI()
    {
        $this->resetValidation();
        $this->datos_usuario = null;
        $this->rol_usuario = null;
        $this->nombres_usuario = null;
        $this->email_usuario = null;
        $this->telefono_usuario = null;
        $this->documento_usuario = null;
    }
}
