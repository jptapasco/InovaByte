<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesas extends Model
{
    protected $table = 'mesas';
    protected $fillable = [
        'id_tipo_mesas',
        'id_mesera_asignada',
        'id_cliente_asignado',
        'estado',
        'numero',
        'created_at',
        'updated_at',
    ];

    public function mesera()
    {
        return $this->belongsTo(User::class, 'id_mesera_asignada');
    }
    public function tipoMesa(): BelongsTo
    {
        return $this->belongsTo(TipoMesas::class, 'id_tipo_mesas');
    }
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Clientes::class, 'id_cliente_asignado');
    }
    public function estado()
    {
        return $this->id_mesera_asignada ? 'Ocupada' : 'Disponible';
    }
    public function optionAsignarMesera()
    {
        return $this->id_mesera_asignada ? 'Cambiar mesera' : 'Asignar una mesera';
    }
}
