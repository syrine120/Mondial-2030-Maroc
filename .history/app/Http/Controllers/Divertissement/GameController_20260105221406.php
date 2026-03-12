<?php

namespace App\Http\Controllers\Divertissement;

use App\Models\Game;
use App\Models\Stade;
use App\Models\Ville;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $query = Game::query();

        // Filtre par ville_id (via la relation avec le stade)
        if ($request->filled('ville_id')) {
            $villeId = $request->input('ville_id');
            $query->whereHas('stade', function ($q) use ($villeId) {
                $q->where('ville_id', $villeId);
            });
        }

        // Optionnel : tri par date de match
        $query->orderBy('date_match', 'asc');

        $games = $query->get(); // ou ->paginate(10) si tu veux une pagination
        $villes = Ville::all();

        return view('Divertissement.games.index', compact('games', 'villes'));
    }

    public function create()
    {
        $stades = Stade::all();
        return view('Divertissement.games.create', compact('stades'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'stade_id' => 'required|exists:stades,id',
            'equipe1' => 'required|string|max:100',
            'equipe2' => 'required|string|max:100',
            'date_match' => 'required|date',
            'heure_match' => 'required|date_format:H:i',
            'type_match' => 'nullable|string|max:50'
        ]);

        Game::create($validated);

        return redirect()->route('games.index')
                       ->with('success', 'Match créé avec succès !');
    }

    public function show(string $id)
    {
        $game = Game::with('stade')->findOrFail($id);
        return view('Divertissement.games.show', compact('game'));
    }

    public function edit(string $id)
    {
        $game = Game::findOrFail($id);
        $stades = Stade::all();
        return view('Divertissement.games.edit', compact('game', 'stades'));
    }

    public function update(Request $request, string $id)
    {
        $game = Game::findOrFail($id);

        $validated = $request->validate([
            'stade_id' => 'required|exists:stades,id',
            'equipe1' => 'required|string|max:100',
            'equipe2' => 'required|string|max:100',
            'date_match' => 'required|date',
            'heure_match' => 'required|date_format:H:i',
            'type_match' => 'nullable|string|max:50'
        ]);

        $game->update($validated);

        return redirect()->route('games.index')
                       ->with('success', 'Match mis à jour avec succès !');
    }

    public function destroy(string $id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect()->route('games.index')
                       ->with('success', 'Match supprimé avec succès !');
    }
}
