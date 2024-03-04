<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesas extends Model
{
    protected $table = 'mesas';
    protected $fillable = [
        'id_tipo_mesas',
        'id_mesera_asignada',
        'created_at',
        'updated_at',
    ];
}