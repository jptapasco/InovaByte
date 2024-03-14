<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaDetalles extends Model
{
    protected $table = 'factura_detalles';
    protected $fillable = [
        'id_factura',
        'id_producto',
        'cantidad',
        'subtotal',
        'created_at',
        'updated_at',
    ];

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'id_producto');
    }
}