<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMesas extends Model
{
    protected $table = 'tipo_mesas';
    protected $fillable = [
        'nombre_mesa',
        'created_at',
        'updated_at',
    ];
}
