<?php

namespace App\Livewire\Admin;

use App\Models\Clientes;
use App\Models\FacturaDetalles;
use App\Models\Facturas;
use App\Models\Productos;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegistroVentasAdmin extends Component
{
    public $usuario_actual, $facturas, $id_factura, $datos_factura ,$nombre_cliente_factura, $hora_inicio_factura, $hora_fin_factura, $desde, $hasta;
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

        $desde = $this->desde ? $this->desde:null;
        $hasta = $this->hasta ? $this->hasta:null;

        $this->facturas = Facturas::select(
            'facturas.*',
            'users.nombres as nombres_vendedor',
            'clientes.documento as documento_cliente'
        )
            ->join('users', 'users.id', 'facturas.id_vendedor')
            ->join('clientes', 'clientes.id', 'facturas.id_cliente')
            ->when($desde, function ($query, $desde) {
                return $query->where(
                    function ($query) use ($desde) {
                        $query->where('facturas.created_at', '>=', $desde);
                    }
                );
            })
            ->when($hasta, function ($query, $hasta) {
                return $query->where(
                    function ($query) use ($hasta) {
                        $query->where('facturas.created_at', '<=', $hasta);
                    }
                );
            })
            ->get();
        
        return view('livewire.Admin.RegistroVentas.registro-ventas-admin')->extends('layouts.app')->section('content');
    }
    public function actualizarIdFactura($id, $opc)
    {
        if ($opc == 1) {
            $this->datos_factura = Facturas::find($id);
            $datos_cliente = Clientes::find($this->datos_factura->id_cliente);
            $this->nombre_cliente_factura = $datos_cliente->nombres;
            $this->hora_inicio_factura = $this->datos_factura->hora_inicio;
            $this->hora_fin_factura = $this->datos_factura->hora_fin;
            $this->dispatch('show-modal-ver-horas');
        }else if($opc == 2) {
            $this->datos_factura = Facturas::find($id);
            $detalles_factura = FacturaDetalles::where('id_factura', $id)->get();
            foreach ($detalles_factura as $detalle_factura) {
                $id_producto = $detalle_factura->id_producto;
                $detalles_producto = Productos::where('id', $id_producto)->get();
                dump($detalles_producto);
            }
        }

    }
    public function resetUI()
    {
        $this->resetValidation();
        $this->datos_factura = null;
        $this->nombre_cliente_factura = null;
        $this->hora_inicio_factura = null;
        $this->hora_fin_factura = null;
    }
}