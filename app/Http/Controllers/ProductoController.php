<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $Productos = Producto::all();
        return view('productos.index', compact('Productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:100',
            'description' => 'required|string|min:1',
            'category' => 'required|string',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', // valida que el precio sea numérico con hasta 2 decimales
            'quantity' => 'required|integer',
            'description' => 'required|string',
            'image' => 'required|string'
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);

        return view('productos.edit', compact('producto'));
    }

   
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:100',
            'description' => 'required|string|min:1',
            'category' => 'required|string',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', // valida que el precio sea numérico con hasta 2 decimales
            'quantity' => 'required|integer',
            'description' => 'required|string',
            'image' => 'required|string'
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('productos.index');
    }

   
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
    
        // Devuelve una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado exitosamente'
        ]);
    }
    
}
