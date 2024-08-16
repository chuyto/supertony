<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = ['total', 'fecha_venta', 'monto_pagado'];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'venta_productos')->withPivot('cantidad', 'precio_total');
    }
}
