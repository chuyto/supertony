<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active', 'name', 'percentage', 'expiration'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'descuento_id');
    }
}
