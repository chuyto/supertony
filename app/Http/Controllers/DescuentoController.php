<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Descuento;

class DescuentoController extends Controller
{
    public function index()
    {
        $descuentos = Descuento::all();
        return view('descuentos.index', compact('descuentos'));
    }

    public function create()
    {
        return view('descuentos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0',
            'expiration' => 'required|date',
            'is_active' => 'required|boolean', // Asegúrate de que sea un valor booleano
        ]);

        Descuento::create([
            'name' => $request->input('name'),
            'percentage' => $request->input('percentage'),
            'expiration' => $request->input('expiration'),
            'is_active' => $request->input('is_active') == '1', // Convertir a booleano
        ]);

        return redirect()->route('descuentos.index')->with('success', 'Descuento creado exitosamente.');
    }

    public function show(Descuento $descuento)
    {
        return view('descuentos.show', compact('descuento'));
    }

    public function edit(Descuento $descuento)
    {
        return view('descuentos.edit', compact('descuento'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0',
            'expiration' => 'required|date',
            'is_active' => 'nullable|boolean',
        ]);

        $descuento = Descuento::findOrFail($id);
        $descuento->name = $request->input('name');
        $descuento->percentage = $request->input('percentage');
        $descuento->expiration = $request->input('expiration');
        $descuento->is_active = $request->has('is_active'); // Si el checkbox está marcado, se establece en true, de lo contrario, false.
        $descuento->save();

        return redirect()->route('descuentos.index')->with('success', 'Descuento actualizado con éxito.');
    }


    public function destroy(Descuento $descuento)
    {
        $descuento->delete();
        return redirect()->route('descuentos.index')->with('success', 'Descuento eliminado con éxito.');
    }
}
