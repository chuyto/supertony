<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\DescuentoController;
use App\Http\Controllers\DevolucionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\ReportController;
// Ruta para que ChartController sea la página de inicio

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/chart', function () {
        return view('dashboard.index');
    })->name('chart');

    Route::resource('productos', ProductoController::class);//administrador, gerente y cajero
    Route::resource('categorias', CategoriaController::class);//administrador y gerente
    Route::resource('descuentos', DescuentoController::class); //administrador
    Route::resource('devoluciones', DevolucionController::class); //administrador y gerente
    Route::resource('settings', SettingController::class); //administrador
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store'); //administrador
    Route::get('/navigation-menu', [NavigationController::class, 'show']); //administrador
    Route::get('/reportes/ventas', [ReportController::class, 'showVentasForm'])->name('reportes.ventas.form'); //administrador y gerente
    Route::get('/reportes/ventas/pdf', [ReportController::class, 'exportVentasPdf'])->name('reportes.ventas.pdf'); //administrador y gerente
    Route::get('/reportes/inventario/pdf', [ReportController::class, 'exportInventarioPdf'])->name('reportes.inventario.pdf'); //administrador y gerente



    Route::get('/chart', [ChartController::class, 'index'])->name('dashboard.index'); //administrador y gerente

    // Ruta para la búsqueda del producto por SKU
    Route::get('/pos/search', [PosController::class, 'searchProduct'])->name('pos.search'); //administradoor, gerente y cajero

    // Ruta para la vista del punto de venta
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index'); //administrador, gerente y cajero

    // Ruta para mostrar un producto específico
    Route::get('/pos/{id}', [PosController::class, 'show'])->name('pos.show'); //administrador, gerente y cajero
    Route::post('pos/add-product-to-cart', [PosController::class, 'addProductToCart'])->name('pos.addProductToCart'); //administrador, gerente y cajero
    Route::post('pos/complete-sale', [PosController::class, 'completeSale'])->name('pos.completeSale'); //administradoor, gerente y cajero
    Route::get('/company-name', [PosController::class, 'companyName']); //administrador

});
