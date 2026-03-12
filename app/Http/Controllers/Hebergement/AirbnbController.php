<?php

namespace App\Http\Controllers\Hebergement;

use App\Models\Airbnb;
use App\Models\Ville;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AirbnbController extends Controller
{
    public function index(Request $request)
{
    $query = Airbnb::query();

    // Filtre par ville si ville_id est dans l'URL
    if ($request->has('ville_id')) {
        $query->where('ville_id', $request->ville_id);
    }

    $airbnbs = $query->get(); // ou paginate(12) si tu veux pagination
    $villes = Ville::all();

    return view('Hebergement.airbnbs.index', compact('airbnbs', 'villes'));
    }

    public function create()
    {
        $villes = Ville::all();
        return view('Hebergement.airbnbs.create', compact('villes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:150',
            'ville_id' => 'required|exists:villes,id',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string',
            'proprietaire' => 'nullable|string',
            'prix_nuit' => 'nullable|numeric',
            'chambres' => 'nullable|integer',
            'capacite' => 'nullable|integer',
            'image_url' => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        Airbnb::create($validated);

        return redirect()->route('airbnbs.index')
            ->with('success', 'Airbnb ajouté avec succès !');
    }

    public function show(string $id)
    {
        $airbnb = Airbnb::with('ville')->findOrFail($id);
        return view('Hebergement.airbnbs.show', compact('airbnb'));
    }

    public function edit(string $id)
    {
        $airbnb = Airbnb::findOrFail($id);
        $villes = Ville::all();
        return view('Hebergement.airbnbs.edit', compact('airbnb','villes'));
    }

    public function update(Request $request, string $id)
    {
        $airbnb = Airbnb::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:150',
            'ville_id' => 'required|exists:villes,id',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string',
            'proprietaire' => 'nullable|string',
            'prix_nuit' => 'nullable|numeric',
            'chambres' => 'nullable|integer',
            'capacite' => 'nullable|integer',
            'image_url' => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        $airbnb->update($validated);

        return redirect()->route('airbnbs.index')
            ->with('success', 'Airbnb mis à jour avec succès !');
    }

    public function destroy(string $id)
    {
        Airbnb::findOrFail($id)->delete();

        return redirect()->route('airbnbs.index')
            ->with('success', 'Airbnb supprimé avec succès !');
    }
}
