<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Venta;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function showVentasForm()
    {
        return view('reportes.ventas');
    }

    public function exportVentasPdf(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Obtener los datos de ventas en el rango de fechas, incluyendo productos
        $ventas = Venta::with('productos')
            ->whereBetween('fecha_venta', [$startDate, $endDate])
            ->get()
            ->map(function ($venta) {
                $venta->fecha_venta = Carbon::parse($venta->fecha_venta);
                return $venta;
            });

        // Obtener la ruta del logo desde la base de datos
        // $logoPath = DB::table('settings')->value('logo_path');
        // $logoUrl = Storage::url($logoPath);


        $pdf = Pdf::loadView('reportes.ventas_pdf', compact('ventas', 'startDate', 'endDate', 'logoUrl'));
        return $pdf->download('ventas_'.$startDate.'_a_'.$endDate.'.pdf');
    }

    public function exportInventarioPdf()
    {
        // Obtén los datos de inventario
        $productos = Producto::all(['id', 'name', 'description', 'category_id', 'price', 'quantity', 'sku']);

        // Obtener la ruta del logo desde la base de datos
        $logoPath = DB::table('settings')->value('logo_path');
        $logoUrl = Storage::url($logoPath);

        // Carga la vista HTML para el reporte
        $pdf = Pdf::loadView('reportes.inventario', compact('productos', 'logoUrl'));

        // Genera el archivo PDF y lo descarga
        return $pdf->download('inventario.pdf');
    }
}
