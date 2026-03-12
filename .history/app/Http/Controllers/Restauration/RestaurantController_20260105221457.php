<?php

namespace App\Http\Controllers\Restauration;

use App\Models\Restaurant;
use App\Models\Ville;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $query = Restaurant::query();

        // Filtre optionnel par ville_id (si présent dans l'URL)
        if ($request->filled('ville_id')) {
            $query->where('ville_id', $request->input('ville_id'));
        }

        // Tu peux ajouter d'autres filtres ou tris si besoin
        // $query->orderBy('nom', 'asc');
$restaurants = $query->paginate(15)->appends($request->query());
$villes = Ville::all();
return view('Restauration.restaurants.index', compact('restaurants', 'villes'));

    }
    public function create()
    {
        $villes = Ville::all();
        return view('Restauration.restaurants.create', compact('villes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:150',
            'ville_id' => 'required|exists:villes,id',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
            'type_cuisine' => 'nullable|string',
            'prix_moyen' => 'nullable|numeric',
            'image_url' => 'nullable|string',
            'horaires' => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        Restaurant::create($validated);

        return redirect()->route('restaurants.index')
            ->with('success', 'Restaurant ajouté avec succès !');
    }

    public function show(string $id)
    {
        $restaurant = Restaurant::with('ville')->findOrFail($id);
        return view('Restauration.restaurants.show', compact('restaurant'));
    }

    public function edit(string $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $villes = Ville::all();
        return view('Restauration.restaurants.edit', compact('restaurant','villes'));
    }

    public function update(Request $request, string $id)
    {
        $restaurant = Restaurant::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:150',
            'ville_id' => 'required|exists:villes,id',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
            'type_cuisine' => 'nullable|string',
            'prix_moyen' => 'nullable|numeric',
            'image_url' => 'nullable|string',
            'horaires' => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        $restaurant->update($validated);

        return redirect()->route('restaurants.index')
            ->with('success', 'Restaurant mis à jour avec succès !');
    }

    public function destroy(string $id)
    {
        Restaurant::findOrFail($id)->delete();

        return redirect()->route('restaurants.index')
            ->with('success', 'Restaurant supprimé avec succès !');
    }
}
