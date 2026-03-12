<?php

namespace App\Http\Controllers\Localisation;

use App\Models\Ville;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VilleController extends Controller
{
    public function index()
    {
        $villes = Ville::all();
        return view('Localisation.villes.index', compact('villes'));
    }

    public function create()
    {
        return view('Localisation.villes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric'
        ]);

        Ville::create($validated);

        return redirect()->route('villes.index')
            ->with('success', 'Ville créée avec succès !');
    }

    public function show(string $id)
    {
        $ville = Ville::with(['stades','hotels','restaurants'])->findOrFail($id);
        return view('Localisation.villes.show', compact('ville'));
    }

    public function edit(string $id)
    {
        $ville = Ville::findOrFail($id);
        return view('Localisation.villes.edit', compact('ville'));
    }

    public function update(Request $request, string $id)
    {
        $ville = Ville::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric'
        ]);

        $ville->update($validated);

        return redirect()->route('villes.index')
            ->with('success', 'Ville mise à jour avec succès !');
    }

    public function destroy(string $id)
    {
        Ville::findOrFail($id)->delete();

        return redirect()->route('villes.index')
            ->with('success', 'Ville supprimée avec succès !');
    }
}
