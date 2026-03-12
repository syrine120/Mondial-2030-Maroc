<?php

namespace App\Http\Controllers\Utilitaires;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConvertisseurController extends Controller
{
    public function index()
    {
        return view('Utilitaires.convertisseur');
    }

    public function convert(Request $request)
    {
        $montant = $request->input('montant');
        $devise_source = $request->input('devise_source');
        $devise_cible = $request->input('devise_cible');

        try {
            // Nouvelle API : open.exchangerate-api.com (GRATUITE, sans clé requise)
            $url = "https://open.exchangerate-api.com/v6/latest/{$devise_source}";

            // Utiliser cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Pour éviter les problèmes SSL

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode !== 200) {
                return redirect()->back()->with('error', 'Erreur de connexion à l\'API de conversion');
            }

            $data = json_decode($response, true);

            // Vérifier la structure de réponse
            if (!isset($data['rates']) || !isset($data['rates'][$devise_cible])) {
                return redirect()->back()->with('error', 'Devise non trouvée');
            }

            $taux = $data['rates'][$devise_cible];
            $resultat = $montant * $taux;

            return view('Utilitaires.convertisseur', [
                'montant' => $montant,
                'devise_source' => $devise_source,
                'devise_cible' => $devise_cible,
                'resultat' => round($resultat, 2),
                'taux' => round($taux, 4)
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la conversion: ' . $e->getMessage());
        }
    }
}
