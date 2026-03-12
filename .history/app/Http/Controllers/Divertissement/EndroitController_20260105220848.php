<?php

namespace App\Http\Controllers\Divertissement;

use App\Models\Endroit;
use App\Models\Ville;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EndroitController extends Controller {

public function index(Request $request)
{
    $query = Endroit::query();
    if ($request->filled('ville_id')) {
        $query->where('ville_id', $request->input('ville_id'));
    }
    $endroits = $query->get();
    $villes = Ville::all();
    return view('Divertissement.endroits.index', compact('endroits', 'villes'));
}
    public function create() {
        $villes = Ville::all();
        return view('Divertissement.endroits.create', compact('villes'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'ville_id' => 'required|exists:villes,id',
            'nom' => 'required|string|max:150',
            'type' => 'required|string|max:100',
            'adresse' => 'nullable|string',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'telephone' => 'nullable|string|max:20',
            'horaires' => 'nullable|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric'
        ]);

        Endroit::create($validated);
        return redirect()->route('endroits.index')->with('success', 'Endroit créé avec succès !');
    }

    public function show(string $id) {
        $endroit = Endroit::with('ville')->findOrFail($id);
        return view('Divertissement.endroits.show', compact('endroit'));
    }

    public function edit(string $id) {
        $endroit = Endroit::findOrFail($id);
        $villes = Ville::all();
        return view('Divertissement.endroits.edit', compact('endroit', 'villes'));
    }

    public function update(Request $request, string $id) {
        $endroit = Endroit::findOrFail($id);

        $validated = $request->validate([
            'ville_id' => 'required|exists:villes,id',
            'nom' => 'required|string|max:150',
            'type' => 'required|string|max:100',
            'adresse' => 'nullable|string',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'telephone' => 'nullable|string|max:20',
            'horaires' => 'nullable|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric'
        ]);

        $endroit->update($validated);
        return redirect()->route('endroits.index')->with('success', 'Endroit mis à jour avec succès !');
    }

    public function destroy(string $id) {
        $endroit = Endroit::findOrFail($id);
        $endroit->delete();
        return redirect()->route('endroits.index')->with('success', 'Endroit supprimé avec succès !');
    }
}
