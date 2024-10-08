<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    use HasFactory;
    protected $fillable = [
        'producto_id', 'cantidad', 'precio_total', 'fecha_venta',
    ];


public function producto()
{
    return $this->belongsTo(Producto::class, 'producto_id');
}
}
