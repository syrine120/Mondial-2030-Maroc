<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Localisation\VilleController;
use App\Http\Controllers\Localisation\StadeController;
use App\Http\Controllers\Divertissement\GameController;
use App\Http\Controllers\Hebergement\HotelController;
use App\Http\Controllers\Hebergement\AirbnbController;
use App\Http\Controllers\Restauration\RestaurantController;
use App\Http\Controllers\Sante\PharmacieController;
use App\Http\Controllers\Sante\UrgenceController;
use App\Http\Controllers\Utilitaires\ConvertisseurController;
use App\Http\Controllers\Divertissement\EndroitController;
use App\Http\Controllers\Api\VilleApiController;
use App\Http\Controllers\Api\MeteoApiController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ChatController;

// =============================================
// ROUTES AUTHENTIFICATION
// =============================================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/rating', [AuthController::class, 'submitRating'])->name('rating.submit')->middleware('auth');

// =============================================
// ROUTES PRINCIPALES
// =============================================

// ACCUEIL : CARTE INTERACTIVE (page d'accueil)
Route::get('/', function () {
    return view('index');
})->name('home');

// GUIDE
Route::get('/guide', function () {
    return view('guide');
})->name('carte');

// CONVERTISSEUR
Route::get('/convertisseur', [ConvertisseurController::class, 'index'])->name('convertisseur.index');
Route::post('/convertisseur', [ConvertisseurController::class, 'convert'])->name('convertisseur.convert');

// =============================================
// API (pour la carte et météo)
// =============================================
Route::prefix('api')->group(function () {
    Route::get('/ville/{id}', [VilleApiController::class, 'show'])->name('api.ville.show');
    Route::get('/meteo/{city}', [MeteoApiController::class, 'getWeather'])->name('api.meteo');
});

// =============================================
// ROUTES PUBLIQUES (Lecture seulement)
// =============================================
Route::resource('villes', VilleController::class)->only(['index', 'show']);
Route::resource('stades', StadeController::class)->only(['index', 'show']);
Route::resource('games', GameController::class)->only(['index', 'show']);
Route::resource('hotels', HotelController::class)->only(['index', 'show']);
Route::resource('restaurants', RestaurantController::class)->only(['index', 'show']);
Route::resource('endroits', EndroitController::class)->only(['index', 'show']);
Route::resource('airbnbs', AirbnbController::class)->only(['index', 'show']);
Route::resource('pharmacies', PharmacieController::class)->only(['index']);
Route::resource('urgences', UrgenceController::class)->only(['index']);

// =============================================
// ROUTES ADMIN PROTÉGÉES (Modification/Suppression)
// =============================================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('villes', VilleController::class)->except(['index', 'show']);
    Route::resource('stades', StadeController::class)->except(['index', 'show']);
    Route::resource('games', GameController::class)->except(['index', 'show']);
    Route::resource('hotels', HotelController::class)->except(['index', 'show']);
    Route::resource('restaurants', RestaurantController::class)->except(['index', 'show']);
    Route::resource('endroits', EndroitController::class)->except(['index', 'show']);
    Route::resource('airbnbs', AirbnbController::class)->except(['index', 'show']);
    Route::resource('pharmacies', PharmacieController::class)->except(['index']);
    Route::resource('urgences', UrgenceController::class);
});



Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
Route::get('/chat/stream', [ChatController::class, 'stream'])->name('chat.stream');
Route::post('/chat/clear', [ChatController::class, 'clear'])->name('chat.clear');