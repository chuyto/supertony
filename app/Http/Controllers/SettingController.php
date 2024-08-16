<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Settings;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Settings::all();
        return view('settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name_company' => 'required|string|min:5|max:100',
            'logo_company' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Subir la imagen si se proporciona
        if ($request->hasFile('logo_company')) {
            $imagePath = $request->file('logo_company')->store('logos', 'public');
        }

        // Crear nueva configuración
        Settings::create([
            'name_company' => $request->name_company,
            'logo_company' => $imagePath ?? null,
        ]);

        return redirect()->route('settings.index');
    }

    /**
     * Display the specified resource.
     */
   public function show(string $id)
{
    $settings = Settings::findOrFail($id);
    $logoUrl = $settings->logo_company; // Usa logo_company

    // Regresa a la vista con los datos necesarios
    return view('settings.show', compact('settings', 'logoUrl'));
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $settings = Settings::findOrFail($id);
        return view('settings.edit', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name_company' => 'required|string|min:5|max:100',
            'logo_company' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $settings = Settings::findOrFail($id);

        // Subir la imagen si existe un nuevo archivo
        if ($request->hasFile('logo_company')) {
            // Eliminar la imagen anterior si existe
            if ($settings->logo_company) {
                Storage::disk('public')->delete($settings->logo_company);
            }

            $imagePath = $request->file('logo_company')->store('logos', 'public');
            $settings->logo_company = $imagePath;
        }

        // Actualizar la configuración
        $settings->update([
            'name_company' => $request->name_company,
            'logo_company' => $settings->logo_company,
        ]);

        return redirect()->route('settings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $settings = Settings::findOrFail($id);
        // Eliminar la imagen asociada si existe
        if ($settings->logo_company) {
            Storage::disk('public')->delete($settings->logo_company);
        }
        $settings->delete();

        // Devuelve una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Configuración eliminada exitosamente'
        ]);
    }
}
