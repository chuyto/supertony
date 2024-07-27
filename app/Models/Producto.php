<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'price',
        'quantity',
        'sku',
        'image'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'category_id');
    }
}

