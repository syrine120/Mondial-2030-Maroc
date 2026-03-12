<?php

namespace App\Http\Controllers\Localisation;

use App\Models\Stade;
use App\Models\Ville;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StadeController extends Controller
{
   public function index(Request $request) //En Laravel, pour accéder aux données de la requête HTTP (comme ?ville_id=4 dans l'URL), il faut passer Illuminate\Http\Request en paramètre de la méthode du controller. Sans ça, $request n'existe pas → erreur "Undefined variable".
{
    $query = Stade::query();

    // Filtre par ville si ville_id est dans l'URL
    if ($request->has('ville_id')) {
        $query->where('ville_id', $request->ville_id);
    }

    $stades = $query->get(); // ou paginate(12)
    $villes = Ville::all();

    return view('Localisation.stades.index', compact('stades', 'villes'));
    }

    public function create()
    {
        $villes = Ville::all();
        return view('Localisation.stades.create', compact('villes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'ville_id' => 'required|exists:villes,id',
            'capacite' => 'nullable|integer',
            'adresse' => 'nullable|string',
            'image_url' => 'nullable|string'
        ]);

        Stade::create($validated);

        return redirect()->route('stades.index')
            ->with('success', 'Stade créé avec succès !');
    }

    public function show(string $id)
    {
        $stade = Stade::with('ville', 'games')->findOrFail($id);
        return view('Localisation.stades.show', compact('stade'));
    }

    public function edit(string $id)
    {
        $stade = Stade::findOrFail($id);
        $villes = Ville::all();
        return view('Localisation.stades.edit', compact('stade', 'villes'));
    }

    public function update(Request $request, string $id)
    {
        $stade = Stade::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'ville_id' => 'required|exists:villes,id',
            'capacite' => 'nullable|integer',
            'adresse' => 'nullable|string',
            'image_url' => 'nullable|string'
        ]);

        $stade->update($validated);

        return redirect()->route('stades.index')
            ->with('success', 'Stade mis à jour avec succès !');
    }

    public function destroy(string $id)
    {
        Stade::findOrFail($id)->delete();

        return redirect()->route('stades.index')
            ->with('success', 'Stade supprimé avec succès !');
    }
}
