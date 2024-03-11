<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
    protected $fillable = [
        'documento',
        'nombres',
        'telefono',
        'horas_jugadas',
        'horas_regalo',
        'estado',
        'ultima_visita',
        'created_at',
        'updated_at',
    ];
}
