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
    public $usuario_actual, $mesas;
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
        $this->mesas = Mesas::all();
        return view('livewire.Admin.Mesas.mesas-admin')->extends('layouts.app')->section('content');
    }
    

    public function resetUI()
    {
        $this->resetValidation();
    }
}
