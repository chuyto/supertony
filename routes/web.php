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

use Spatie\Permission\Models\Role;


// Ruta para que ChartController sea la página de inicio
Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Rutas para el dashboard (administrador y gerente)
    Route::get('/chart', [ChartController::class, 'index'])->name('dashboard.index')->middleware('role:administrador|gerente');

    // Rutas para productos (administrador, gerente y cajero)
    Route::resource('productos', ProductoController::class)->middleware('role:administrador|gerente|cajero');

    // Rutas para categorías (administrador y gerente)
    Route::resource('categorias', CategoriaController::class)->middleware('role:administrador|gerente');

    // Rutas para descuentos (administrador)
    Route::resource('descuentos', DescuentoController::class)->middleware('role:administrador');

    // Rutas para devoluciones (administrador y gerente)
    Route::resource('devoluciones', DevolucionController::class)->middleware('role:administrador|gerente');

    // Rutas para configuración (administrador)
    Route::resource('settings', SettingController::class)->middleware('role:administrador');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store')->middleware('role:administrador');

    // Ruta para mostrar el menú de navegación (administrador)
    Route::get('/navigation-menu', [NavigationController::class, 'show'])->middleware('role:administrador');

    // Rutas para reportes (administrador y gerente)
    Route::get('/reportes/ventas', [ReportController::class, 'showVentasForm'])->name('reportes.ventas.form')->middleware('role:administrador|gerente');
    Route::get('/reportes/ventas/pdf', [ReportController::class, 'exportVentasPdf'])->name('reportes.ventas.pdf')->middleware('role:administrador|gerente');
    Route::get('/reportes/inventario/pdf', [ReportController::class, 'exportInventarioPdf'])->name('reportes.inventario.pdf')->middleware('role:administrador|gerente');

    // Rutas para el punto de venta (administrador, gerente y cajero)
    Route::get('/pos/search', [PosController::class, 'searchProduct'])->name('pos.search')->middleware('role:administrador|gerente|cajero');
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index')->middleware('role:administrador|gerente|cajero');
    Route::get('/pos/{id}', [PosController::class, 'show'])->name('pos.show')->middleware('role:administrador|gerente|cajero');
    Route::post('pos/add-product-to-cart', [PosController::class, 'addProductToCart'])->name('pos.addProductToCart')->middleware('role:administrador|gerente|cajero');
    Route::post('pos/complete-sale', [PosController::class, 'completeSale'])->name('pos.completeSale')->middleware('role:administrador|gerente|cajero');
    Route::get('/company-name', [PosController::class, 'companyName'])->middleware('role:administrador');
});

