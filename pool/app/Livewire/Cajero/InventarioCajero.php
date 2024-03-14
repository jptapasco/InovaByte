<?php

namespace App\Livewire\Cajero;

use App\Models\Productos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class InventarioCajero extends Component
{
    public $usuario_actual, $imageData, $imagen_producto, $productos, $cantidad_agregada, $cantidad_agregada_total, $cantidad_producto_actual, $id_producto, $datos_producto, $nombre_producto, $descripcion_producto, $categoria_producto, $unidad_medida_producto, $precio_compra_producto, $precio_venta_producto, $punto_reorden_producto, $cantidad_producto, $search;
    public function mount()
    {
        $this->usuario_actual = Auth::user();
    }
    public function render()
    {
        if($this->usuario_actual == null){
            return abort('403');
        }else if ($this->usuario_actual->rol != 'cajero') {
            return abort('403');
        }
        $strSearch = $this->search == '' ? false : '%' . str_replace(' ', '%', $this->search) . '%';
        $this->productos = Productos::when($strSearch, function ($query, $strSearch) {
            return $query->where(
                function ($query) use ($strSearch) {
                    $query  ->where('nombre', 'like', $strSearch)
                            ->orWhere('descripcion', 'like', $strSearch)
                            ->orWhere('categoria', 'like', $strSearch)
                            ->orWhere('unidad_medida', 'like', $strSearch)
                            ->orWhere('precio_compra', 'like', $strSearch)
                            ->orWhere('precio_venta', 'like', $strSearch)
                            ->orWhere('cantidad', 'like', $strSearch);
                }
            );
        })->get();
        return view('livewire.Cajero.Inventario.inventario-cajero')->extends('layouts.app')->section('content');
    }
    public function update()
    {
        $rules = [
            'nombre_producto' => 'required',
            'descripcion_producto' => 'required',
            'precio_compra_producto' => 'required|numeric',
            'precio_venta_producto' => 'required|numeric',
            'punto_reorden_producto' => 'required|numeric',
            'cantidad_producto' => 'required|numeric',
        ];
        $messages = [
            'nombre_producto.required' => 'Debe ingresar un nombre',
            'descripcion_producto.required' => 'Debe ingresar una descripción',
            'precio_compra_producto.required' => 'Debe ingresar un precio de compra',
            'precio_compra_producto.numeric' => 'No se permiten letras o signos',
            'precio_venta_producto.required' => 'Debe ingresar un precio de venta',
            'precio_venta_producto.numeric' => 'No se permiten letras o signos',
            'punto_reorden_producto.required' => 'Debe ingresar un punto de reorden',
            'punto_reorden_producto.numeric' => 'No se permiten letras o signos',
            'cantidad_producto.required' => 'Debe ingresar una cantidad',
            'cantidad_producto.numeric' => 'No se permiten letras o signos',
        ];
        $this->validate($rules, $messages);

        $this->datos_producto->update([
            'nombre' => $this->nombre_producto,
            'descripcion' => $this->descripcion_producto,
            'precio_compra' => $this->precio_compra_producto,
            'precio_venta' => $this->precio_venta_producto,
            'punto_reorden' => $this->punto_reorden_producto,
            'cantidad' => $this->cantidad_producto,
        ]);
        $this->resetUI();
        $this->dispatch('hide-modal-editar-producto');
    }
    public function store()
    {
        $rules = [
            'nombre_producto' => 'required',
            'descripcion_producto' => 'required',
            'categoria_producto' => [Rule::notIn(0)],
            'unidad_medida_producto' => [Rule::notIn(0)],
            'precio_compra_producto' => 'required|numeric',
            'precio_venta_producto' => 'required|numeric',
            'punto_reorden_producto' => 'required|numeric',
            'cantidad_producto' => 'required|numeric',
            'imagen_producto' => 'required',
        ];
        $messages = [
            'nombre_producto.required' => 'Debe ingresar un nombre',
            'descripcion_producto.required' => 'Debe ingresar una descripción',
            'categoria_producto.not_in' => 'Debe seleccionar una categoría',
            'unidad_medida_producto.not_in' => 'Debe seleccionar una unidad de medida',
            'precio_compra_producto.required' => 'Debe ingresar un precio de compra',
            'precio_compra_producto.numeric' => 'No se permiten letras o signos',
            'precio_venta_producto.required' => 'Debe ingresar un precio de venta',
            'precio_venta_producto.numeric' => 'No se permiten letras o signos',
            'punto_reorden_producto.required' => 'Debe ingresar un punto de reorden',
            'punto_reorden_producto.numeric' => 'No se permiten letras o signos',
            'cantidad_producto.required' => 'Debe ingresar una cantidad',
            'cantidad_producto.numeric' => 'No se permiten letras o signos',
            'imagen_producto.required' => 'Debe ingresar una imagen',
        ];
        if ($this->imageData) {
            $this->imageData = base64_encode(File::get($this->imagen_producto->getRealPath()));
        }
        $this->validate($rules, $messages);

        $this->datos_producto = Productos::create([
            'nombre' => $this->nombre_producto,
            'descripcion' => $this->descripcion_producto,
            'categoria' => $this->categoria_producto,
            'unidad_medida' => $this->unidad_medida_producto,
            'precio_compra' => $this->precio_compra_producto,
            'precio_venta' => $this->precio_venta_producto,
            'punto_reorden' => $this->punto_reorden_producto,
            'cantidad' => $this->cantidad_producto,
            'url' => $this->imageData,

        ]);
        $this->resetUI();
        $this->dispatch('hide-modal-crear-producto');
    }

    public function actualizarCantidadProducto($id, $opc)
    {
        if ($opc == 1) {
            $this->datos_producto = Productos::find($id);
            $this->cantidad_producto_actual = $this->datos_producto->cantidad;
            $this->dispatch('show-modal-agregar-cantidad');
        }
    }

    public function actualizarIdProducto($id, $opc)
    {
        if ($opc == 1) {
            $this->datos_producto = Productos::find($id);
            $this->nombre_producto = $this->datos_producto->nombre;
            $this->descripcion_producto = $this->datos_producto->descripcion;
            $this->categoria_producto = $this->datos_producto->categoria;
            $this->unidad_medida_producto = $this->datos_producto->unidad_medida;
            $this->precio_compra_producto = $this->datos_producto->precio_compra;
            $this->precio_venta_producto = $this->datos_producto->precio_venta;
            $this->punto_reorden_producto = $this->datos_producto->punto_reorden;
            $this->cantidad_producto = $this->datos_producto->cantidad;
            $this->dispatch('show-modal-editar-producto');
        }
    }
    public function abrirModalCrear()
    {
        $this->resetUI();
        $this->dispatch('show-modal-crear-producto');
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
    }

    public function abrirModalAgregar()
    {
        $this->resetUI();
        $this->dispatch('show-modal-agregar-inventario');
    }
}
