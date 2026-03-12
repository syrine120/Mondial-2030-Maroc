<?php

namespace App\Http\Controllers\Hebergement;

use App\Models\Hotel;
use App\Models\Ville;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotelController extends Controller
{

public function index(Request $request)
    {
        $query = Hotel::query();

        if ($request->filled('ville_id')) {
            $query->where('ville_id', $request->input('ville_id'));
        }

        // Optionnel : tri par nom ou prix
        // $query->orderBy('nom', 'asc');

        $hotels = $query->get(); // ou ->paginate(12)
        $villes = Ville::all();

        return view('Hebergement.hotels.index', compact('hotels', 'villes'));
    }
    public function create()
    {
        $villes = Ville::all();
        return view('Hebergement.hotels.create', compact('villes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:150',
            'ville_id' => 'required|exists:villes,id',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'prix_nuit' => 'nullable|numeric',
            'etoiles' => 'nullable|integer|min:1|max:5',
            'image_url' => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        Hotel::create($validated);

        return redirect()->route('hotels.index')
            ->with('success', 'Hôtel ajouté avec succès !');
    }

    public function show(string $id)
    {
        $hotel = Hotel::with('ville')->findOrFail($id);
        return view('Hebergement.hotels.show', compact('hotel'));
    }

    public function edit(string $id)
    {
        $hotel = Hotel::findOrFail($id);
        $villes = Ville::all();
        return view('Hebergement.hotels.edit', compact('hotel', 'villes'));
    }

    public function update(Request $request, string $id)
    {
        $hotel = Hotel::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:150',
            'ville_id' => 'required|exists:villes,id',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'prix_nuit' => 'nullable|numeric',
            'etoiles' => 'nullable|integer|min:1|max:5',
            'image_url' => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        $hotel->update($validated);

        return redirect()->route('hotels.index')
            ->with('success', 'Hôtel mis à jour avec succès !');
    }

    public function destroy(string $id)
    {
        Hotel::findOrFail($id)->delete();

        return redirect()->route('hotels.index')
            ->with('success', 'Hôtel supprimé avec succès !');
    }
}
