<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class MeteoApiController extends Controller
{
    public function getWeather($cityName)
    {
        try {
            $apiKey = env('OPENWEATHER_API_KEY');
            
            if (!$apiKey) {
                return response()->json([
                    'error' => 'Clé API non configurée'
                ], 500);
            }

            // URL de l'API OpenWeatherMap
            // Utiliser urlencode() pour gérer les espaces dans les noms de villes (ex: "New York")
        $cityName = urlencode($cityName);
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$cityName}&appid={$apiKey}&units=metric&lang=fr";

            // Faire la requête
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode !== 200) {
                return response()->json([
                    'error' => 'Impossible de récupérer la météo'
                ], 500);
            }

            $data = json_decode($response, true);

            // Extraire les informations importantes
            $weather = [
                'city' => $data['name'] ?? 'Inconnu',
                'temperature' => round($data['main']['temp'] ?? 0),
                'feels_like' => round($data['main']['feels_like'] ?? 0),
                'humidity' => $data['main']['humidity'] ?? 0,
                'pressure' => $data['main']['pressure'] ?? 0,
                'wind_speed' => round($data['wind']['speed'] ?? 0, 1),
                'description' => $data['weather'][0]['main'] ?? 'Inconnu',
                'description_fr' => $data['weather'][0]['description'] ?? 'Inconnu',
                'icon' => $data['weather'][0]['icon'] ?? '01d',
                'is_rainy' => in_array($data['weather'][0]['main'], ['Rain', 'Drizzle', 'Thunderstorm']),
                'is_cloudy' => $data['weather'][0]['main'] === 'Clouds',
                'is_sunny' => $data['weather'][0]['main'] === 'Clear'
            ];

            return response()->json($weather);

        } catch (\Exception $e) {
            // Enregistrer la vraie erreur dans les logs serveur
            Log::error('Meteo API Error', ['message' => $e->getMessage()]);

            // Retourner un message générique au visiteur
            return response()->json(['error' => 'Service météo indisponible'], 500);
        }
    }
}