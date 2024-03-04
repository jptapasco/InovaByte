<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioObservaciones extends Model
{
    protected $table = 'usuario_observaciones';
    protected $fillable = [
        'id_usuario',
        'observacion',
        'created_at',
        'updated_at',
    ];
}
