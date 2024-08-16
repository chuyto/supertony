<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use Carbon\Carbon;
use App\Models\Producto;
use App\Models\descuento;
class ChartController extends Controller
{
    public function index()
    {


        // Retrieve low stock products
        $lowStockThreshold = 10; // Adjust as needed
        $lowStockProducts = Producto::where('quantity', '>', 0) // Only include products with quantity greater than 0
                            ->where('quantity', '<', $lowStockThreshold)
                            ->get();

        $NoProducts = 0; // Initialize variable
        $NoProductsInStock = Producto::where('quantity', '==', 0)->get();

        // ... existing return statement ...

        $today = Carbon::now();
    $tomorrow = $today->copy()->addDay();

    $expiringDiscounts = Descuento::where('expiration', '<=', $tomorrow)
                                      ->where('expiration', '>', $today)
                                      ->get();


        // Obtener datos de ventas por día del mes
        $sales = Venta::selectRaw('DAY(fecha_venta) as day, SUM(total) as total_sales')
                    ->whereMonth('fecha_venta', Carbon::now()->month) // Filtrar por el mes actual
                    ->groupBy('day')
                    ->orderBy('day')
                    ->get();

        $days = $sales->pluck('day')->toArray();
        $totals = $sales->pluck('total_sales')->toArray();

        // Obtener los productos más vendidos
        $productSales = Producto::join('venta_productos', 'productos.id', '=', 'venta_productos.producto_id')
                            ->select('productos.name', \DB::raw('SUM(venta_productos.cantidad) as total_quantity'))
                            ->groupBy('productos.name')
                            ->orderBy('total_quantity', 'desc')
                            ->get();

        $productNames = $productSales->pluck('name')->toArray();
        $productTotals = $productSales->pluck('total_quantity')->toArray();

        // Obtener datos de ventas por mes
        $monthlySales = Venta::selectRaw('MONTH(fecha_venta) as month, SUM(total) as total_sales')
                        ->whereYear('fecha_venta', Carbon::now()->year) // Filtrar por el año actual
                        ->groupBy('month')
                        ->orderBy('month')
                        ->get();

        // Inicializar todos los meses del año
        $months = [];
        $monthlyTotals = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('F'); // Convertir número de mes a nombre
            $monthlyTotals[] = 0; // Valor predeterminado de 0
        }

        // Asignar los valores de ventas a los meses correspondientes
        foreach ($monthlySales as $sale) {
            $monthIndex = $sale->month - 1; // Ajustar índice para el array (0 basado)
            $monthlyTotals[$monthIndex] = $sale->total_sales;
        }

        return view('dashboard.index', compact('days', 'totals', 'productNames', 'productTotals', 'months', 'monthlyTotals', 'lowStockProducts','NoProductsInStock', 'expiringDiscounts'));
    }
}

