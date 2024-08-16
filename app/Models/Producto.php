<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'category_id', 'price', 'quantity', 'sku', 'image', 'descuento_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'category_id');
    }

    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'venta_productos')->withPivot('cantidad', 'precio_total');
    }

    public function descuento()
    {
        return $this->belongsTo(Descuento::class, 'descuento_id');
    }
}
