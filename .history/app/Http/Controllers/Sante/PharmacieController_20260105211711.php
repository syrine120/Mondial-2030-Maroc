<?php

namespace App\Http\Controllers\Sante;

use App\Models\Pharmacie;
use App\Models\Ville;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PharmacieController extends Controller
{
    public function index(Request $request)
{
    $query = Pharmacie::query();
    if ($request->filled('ville_id')) {
        $query->where('ville_id', $request->input('ville_id'));
    }
    $pharmacies = $query->get();
    $villes = Ville::all();
    return view('Sante.pharmacies.index', compact('pharmacies', 'villes'));
}
    public function create()
    {
        $villes = Ville::all();
        return view('Sante.pharmacies.create', compact('villes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:150',
            'ville_id' => 'required|exists:villes,id',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string',
            'horaires_ouverture' => 'nullable|string',
            'horaires_fermeture' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric'
        ]);

        Pharmacie::create($validated);

        return redirect()->route('pharmacies.index')
            ->with('success', 'Pharmacie ajoutée avec succès !');
    }

    public function show(string $id)
    {
        $pharmacie = Pharmacie::with('ville')->findOrFail($id);
        return view('Sante.pharmacies.show', compact('pharmacie'));
    }

    public function edit(string $id)
    {
        $pharmacie = Pharmacie::findOrFail($id);
        $villes = Ville::all();
        return view('Sante.pharmacies.edit', compact('pharmacie','villes'));
    }

    public function update(Request $request, string $id)
    {
        $pharmacie = Pharmacie::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:150',
            'ville_id' => 'required|exists:villes,id',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string',
            'horaires_ouverture' => 'nullable|string',
            'horaires_fermeture' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric'
        ]);

        $pharmacie->update($validated);

        return redirect()->route('pharmacies.index')
            ->with('success', 'Pharmacie mise à jour avec succès !');
    }

    public function destroy(string $id)
    {
        Pharmacie::findOrFail($id)->delete();

        return redirect()->route('pharmacies.index')
            ->with('success', 'Pharmacie supprimée avec succès !');
    }
}
