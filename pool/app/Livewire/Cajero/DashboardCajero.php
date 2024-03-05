<?php

namespace App\Livewire\Cajero;

use App\Models\Clientes;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardCajero extends Component
{
    public function render()
    {
        return view('livewire.Cajero.Dashboard.dashboard-cajero')->extends('layouts.app');
    }
}