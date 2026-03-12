<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ville;
use App\Models\Game;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Endroit;
use App\Models\Pharmacie;
use App\Models\Urgence;
use App\Models\Airbnb;   // ← Ajouté
use App\Models\Stade;    // ← Ajouté

class VilleApiController extends Controller
{
    public function show($id)
    {
        $ville = Ville::findOrFail($id);

        // Compter les éléments de chaque type pour cette ville
        $games_count = Game::whereHas('stade', function($query) use ($id) {
            $query->where('ville_id', $id);
        })->count();

        $hotels_count       = Hotel::where('ville_id', $id)->count();
        $restaurants_count  = Restaurant::where('ville_id', $id)->count();
        $endroits_count     = Endroit::where('ville_id', $id)->count();
        $pharmacies_count   = Pharmacie::where('ville_id', $id)->count();
        $urgences_count     = Urgence::where('ville_id', $id)->count();

        // Ajout des deux nouveaux compteurs
        $airbnbs_count      = Airbnb::where('ville_id', $id)->count();
        $stades_count       = Stade::where('ville_id', $id)->count();

        return response()->json([
            'id'                => $ville->id,
            'nom'               => $ville->nom,
            'games_count'       => $games_count,
            'hotels_count'      => $hotels_count,
            'restaurants_count' => $restaurants_count,
            'endroits_count'    => $endroits_count,
            'pharmacies_count'  => $pharmacies_count,
            'urgences_count'    => $urgences_count,
            // Nouveaux champs ajoutés
            'airbnbs_count'     => $airbnbs_count,
            'stades_count'      => $stades_count,
        ]);
    }
}

