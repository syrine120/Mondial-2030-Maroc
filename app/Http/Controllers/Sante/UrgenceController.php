<?php

namespace App\Http\Controllers\Sante;

use App\Models\Urgence;
use App\Models\Ville;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UrgenceController extends Controller
{

public function index(Request $request)
{
    $query = Urgence::query();
    if ($request->filled('ville_id')) {
        $query->where('ville_id', $request->input('ville_id'));
        // Ou si tu veux aussi les urgences nationales (ville_id null) :
        // ->where(function($q) use ($request) {
        //     $q->where('ville_id', $request->input('ville_id'))
        //       ->orWhereNull('ville_id');
        // });
    }
    $urgences = $query->get();
    $villes = Ville::all();
    return view('Sante.urgences.index', compact('urgences', 'villes'));
}
    public function create()
    {
        $villes = Ville::all();
        return view('Sante.urgences.create', compact('villes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:100',
            'numero' => 'required|string|max:20',
            'ville_id' => 'nullable|exists:villes,id',
            'description' => 'nullable|string'
        ]);

        Urgence::create($validated);

        return redirect()->route('urgences.index')
            ->with('success', 'Urgence ajoutée avec succès !');
    }

    public function show(string $id)
    {
        $urgence = Urgence::with('ville')->findOrFail($id);
        return view('Sante.urgences.show', compact('urgence'));
    }

    public function edit(string $id)
    {
        $urgence = Urgence::findOrFail($id);
        $villes = Ville::all();
        return view('Sante.urgences.edit', compact('urgence','villes'));
    }

    public function update(Request $request, string $id)
    {
        $urgence = Urgence::findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|string|max:100',
            'numero' => 'required|string|max:20',
            'ville_id' => 'nullable|exists:villes,id',
            'description' => 'nullable|string'
        ]);

        $urgence->update($validated);

        return redirect()->route('urgences.index')
            ->with('success', 'Urgence mise à jour avec succès !');
    }

    public function destroy(string $id)
    {
        Urgence::findOrFail($id)->delete();

        return redirect()->route('urgences.index')
            ->with('success', 'Urgence supprimée avec succès !');
    }
}
