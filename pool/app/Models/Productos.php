<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
    protected $fillable = [
        'nombre',
        'categoria',
        'unidad_medida',
        'cantidad',
        'punto_reorden',
        'precio_compra',
        'precio_venta',
        'descripcion',
        'estado',
        'url',
        'created_at',
        'updated_at',
    ];
}
