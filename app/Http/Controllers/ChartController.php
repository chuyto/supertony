<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pos;
use App\Models\Producto;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function index()
    {
        // Obtener datos de ventas por día del mes
        $sales = Pos::selectRaw('DAY(fecha_venta) as day, SUM(precio_total) as total_sales')
                    ->whereMonth('fecha_venta', Carbon::now()->month) // Filtrar por el mes actual
                    ->groupBy('day')
                    ->orderBy('day')
                    ->get();

        // Formatear datos para Chart.js
        $days = $sales->pluck('day')->toArray();
        $totals = $sales->pluck('total_sales')->toArray();

        // Obtener los productos más vendidos
        $productSales = Pos::with('producto') // Cargar la relación producto
                            ->select('producto_id', \DB::raw('SUM(cantidad) as total_quantity'))
                            ->groupBy('producto_id')
                            ->orderBy('total_quantity', 'desc')
                            ->get()
                            ->map(function ($pos) {
                                return [
                                    'name' => $pos->producto->name, // Nombre del producto
                                    'total' => $pos->total_quantity,
                                ];
                            });

        $productNames = $productSales->pluck('name')->toArray();
        $productTotals = $productSales->pluck('total')->toArray();

        return view('dashboard.index', compact('days', 'totals', 'productNames', 'productTotals'));
    }
}
