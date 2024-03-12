<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesas extends Model
{
    protected $table = 'mesas';
    protected $fillable = [
        'id_tipo_mesas',
        'id_mesera_asignada',
        'id_cliente_asignado',
        'created_at',
        'updated_at',
    ];
}
