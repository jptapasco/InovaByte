<?php
namespace App\Livewire\Cajero;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;

class MeserasCajero extends Component
{
    public $usuario_actual,$lista_meseras;

    public function mount()
    {
        $this->usuario_actual = Auth::user();
        $this->lista_meseras = User::where('rol','mesera')->get();
    }

    public function render()
    {
        if($this->usuario_actual == null){
            return abort('403');
        }else if ($this->usuario_actual->rol != 'cajero') {
            return abort('403');
        }
        return view('livewire.Cajero.Meseras.meseras_cajero')->extends('layouts.app');

    }


}

