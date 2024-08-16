<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use App\Models\Producto; // Asegúrate de importar el modelo Producto
use Illuminate\Http\Request;

class DevolucionController extends Controller
{
    // Mostrar una lista de devoluciones
    public function index()
    {
        $devoluciones = Devolucion::all();
        return view('devoluciones.index', compact('devoluciones'));
    }

    // Mostrar el formulario para crear una nueva devolución
    public function create()
    {
        return view('devoluciones.create');
    }

    // Almacenar una nueva devolución
    public function store(Request $request)
    {
        $request->validate([
            'venta_id' => 'required|integer',
            'producto_id' => 'required|integer',
            'cantidad' => 'required|integer',
            'monto' => 'required|numeric',
        ]);

        // Crear la devolución
        $devolucion = Devolucion::create($request->all());

        // Actualizar la cantidad del producto en el inventario
        $producto = Producto::find($request->producto_id);

        if ($producto) {
            // Incrementar la cantidad en inventario
            $producto->quantity += $request->cantidad;
            $producto->save();
        } else {
            // Manejo del error si el producto no se encuentra
            return redirect()->route('devoluciones.index')
                             ->with('error', 'Producto no encontrado.');
        }

        return redirect()->route('devoluciones.index')
                         ->with('success', 'Devolución registrada correctamente y stock actualizado.');
    }

    // Mostrar una devolución específica
    public function show(Devolucion $devolucion)
    {
        return view('devoluciones.show', compact('devolucion'));
    }

    // Mostrar el formulario para editar una devolución existente
    public function edit(Devolucion $devolucion)
    {
        return view('devoluciones.edit', compact('devolucion'));
    }

    // Actualizar una devolución existente
    public function update(Request $request, Devolucion $devolucion)
    {
        $request->validate([
            'venta_id' => 'required|integer',
            'producto_id' => 'required|integer',
            'cantidad' => 'required|integer',
            'monto' => 'required|numeric',
        ]);

        // Actualizar la devolución
        $devolucion->update($request->all());

        // Actualizar la cantidad del producto en el inventario
        $producto = Producto::find($request->producto_id);

        if ($producto) {
            // Incrementar la cantidad en inventario
            $producto->quantity += $request->cantidad;
            $producto->save();
        } else {
            // Manejo del error si el producto no se encuentra
            return redirect()->route('devoluciones.index')
                             ->with('error', 'Producto no encontrado.');
        }

        return redirect()->route('devoluciones.index')
                         ->with('success', 'Devolución actualizada correctamente y stock actualizado.');
    }

    // Eliminar una devolución existente
    public function destroy(Devolucion $devolucion)
    {
        // Antes de eliminar la devolución, debes revertir el stock del producto
        $producto = Producto::find($devolucion->producto_id);

        if ($producto) {
            // Decrementar la cantidad en inventario
            $producto->quantity -= $devolucion->cantidad;
            $producto->save();
        }

        $devolucion->delete();

        return redirect()->route('devoluciones.index')
                         ->with('success', 'Devolución eliminada correctamente y stock revertido.');
    }
}
