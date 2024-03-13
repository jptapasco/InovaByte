<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
    protected $table = 'facturas';
    protected $fillable = [
        'id_mesa',
        'id_cliente',
        'id_vendedor',
        'total',
        'estado',
        'hora_inicio',
        'hora_fin',
        'created_at',
        'updated_at',
    ];
}