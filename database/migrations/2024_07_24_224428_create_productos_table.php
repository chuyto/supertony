<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del Producto
            $table->text('description'); // Descripción del Producto
            $table->string('category'); // Categoría
            $table->decimal('price', 8, 2); // Precio
            $table->integer('quantity'); // Cantidad en Stock
            $table->string('SKU'); // Código de Barras
            $table->string('image'); // Imagen del Producto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
