<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ChartController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('productos', ProductoController::class);
    Route::resource('categorias', CategoriaController::class);

    Route::get('/chart', [ChartController::class, 'index'])->name('dashboard.index');

    // Ruta para la búsqueda del producto por SKU
    Route::get('/pos/search', [PosController::class, 'searchProduct'])->name('pos.search');

    // Ruta para la vista del punto de venta
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');

    // Ruta para mostrar un producto específico
    Route::get('/pos/{id}', [PosController::class, 'show'])->name('pos.show');
    Route::post('pos/add-product-to-cart', [PosController::class, 'addProductToCart'])->name('pos.addProductToCart');
    Route::post('pos/complete-sale', [PosController::class, 'completeSale'])->name('pos.completeSale');
});
