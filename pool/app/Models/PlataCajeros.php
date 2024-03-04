<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlataCajeros extends Model
{
    protected $table = 'plata_cajeros';
    protected $fillable = [
        'estado',
        'dinero_inicio_dia',
        'dinero_fin_dia',
        'created_at',
        'updated_at',
    ];
}