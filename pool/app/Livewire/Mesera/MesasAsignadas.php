<?php

namespace App\Livewire\Mesera;
use App\Models\Mesas;
use App\Models\TipoMesas;
use App\Models\Clientes;
use App\Models\FacturaDetalles;
use App\Models\Facturas;
use App\Models\Productos;
use App\Traits\ConsultaFacturas;
use App\Traits\ConsultaProductos;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MesasAsignadas extends Component
{
    use ConsultaProductos;
    use ConsultaFacturas;
    public $usuario_actual, $mesas, $id_mesa, $clientes, $asignar_cliente, $mesa_db, $factura, $productos, $diferencia_horas, $productosSeleccionados = [], $categoriaSeleccionada, $detalles_productos, $detalles_factura;

    public function mount()
    {
        $this->usuario_actual = Auth::user();
        $this->clientes = Clientes::all();
        $this->mesas = Mesas::where('id_mesera_asignada', $this->usuario_actual->id)->get();
        $this->productos = Productos::all();

    }

    public function render()
    {
        if ($this->usuario_actual == null) {
            return abort('403');
        } elseif ($this->usuario_actual->rol != 'mesera') {
            return abort('403');
        }

        return view('livewire.mesera.mesas-asignadas')->extends('layouts.app')->section('content');
    }
    public function obtenerMesas()
    {
        $this->mesas = Mesas::where('id_mesera_asignada', $this->usuario_actual->id)->get();
    }

    public function mesasLibres()
    {
        $this->mesas = Mesas::where('id_mesera_asignada', $this->usuario_actual->id)
            ->where('id_cliente_asignado', null)
            ->get();
    }

    public function mesasOcupadas()
    {
        $this->mesas = Mesas::where('id_mesera_asignada', $this->usuario_actual->id)
            ->whereNotNull('id_cliente_asignado')
            ->get();
    }

    public function iniciarMesa($id)
    {
        $this->mesa_db = Mesas::find($id);
        $this->clientes = Clientes::where('estado', 'activo')->get();
        $this->asignar_cliente = 0;

        $this->factura = Facturas::create([
            'id_mesa' => $id,
            'id_cliente' => 0,
            'estado' => 'activo',
            'id_vendedor' => $this->usuario_actual->id,
            'total' => 0,
            'hora_inicio' => $this->mesa_db->id_tipo_mesa != 3 ? now() : null,
        ]);

        $this->dispatch('show-start-modal');
    }
    public function asignarMesa($id)
    {
        $mesa_a_asignar = Mesas::find($id);
        $mesa_a_asignar->id_cliente_asignado = $this->asignar_cliente;
        $mesa_a_asignar->save();
        $this->factura->update([
            'id_cliente' =>  $this->asignar_cliente,
        ]);
        $this->dispatch('close-start-modal');
        $this->obtenerMesas();
    }
    public function abrirChiste($id)
    {
        $this->id_mesa = $id;
        $this->factura = Facturas::where('id_mesa', $id)->where('estado', 'activo')->first();
        $this->dispatch('show-modal-chistoso');
    }
    public function abrirFacturaMesa($id)
    {
        $this->id_mesa = $id;
        $this->factura = Facturas::where('id_mesa', $id)->where('estado', 'activo')->first();
        $this->detalles_factura = FacturaDetalles::where('id_factura', $this->factura->id)->get();
        $this->dispatch('show-modal-factura-mesa');
    }

    public function cerrarMesa($id)
    {
        $this->factura = Facturas::where('id_mesa', $id)->where('estado', 'activo')->first();
        $this->mesa_db = Mesas::find($id);
        $this->clientes = Clientes::where('estado', 'activo')->get();
        $this->asignar_cliente = 0;

        if($this->mesa_db->id_tipo_mesas != 3)
        {
            $time1 = Carbon::parse($this->factura->hora_inicio);
            $time2 = Carbon::parse(now());
            $this->diferencia_horas = $time1->diffInSeconds($time2);
            $this->diferencia_horas = ceil( ($this->diferencia_horas/60)/60);
        }


        $this->factura->update([
            'estado' => 'cobrado',
            'hora_fin' =>  $this->mesa_db->id_tipo_mesas != 3 ? now() : null,
            'total' =>  $this->mesa_db->id_tipo_mesas != 3 ? $this->factura->total +  $this->diferencia_horas * 4000 : $this->factura->total 
        ]);

        $this->mesa_db->update(
        [
            'id_cliente_asignado' => null,
        
        ]);
        $this->mesas = Mesas::where('id_mesera_asignada', $this->usuario_actual->id)->get();
    }
    public function resetUI()
    {
        $this->resetValidation();
        $this->datos_producto = null;
        $this->nombre_producto = null;
        $this->descripcion_producto = null;
        $this->categoria_producto = null;
        $this->unidad_medida_producto = null;
        $this->precio_compra_producto = null;
        $this->precio_venta_producto = null;
        $this->punto_reorden_producto = null;
        $this->cantidad_producto = null;
        $this->cantidad_agregada = null;
        $this->productosSeleccionados = [];
    }
}
