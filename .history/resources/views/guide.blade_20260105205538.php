@extends('layouts.app')

@section('title', 'Guide d\'utilisation - Mondial 2030 Maroc')

@section('content')
<div class="hero-section" style="background: #c1272d; color: white; padding: 80px 40px; text-align: center; border-radius: 20px; margin-bottom: 50px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); position: relative; overflow: hidden;">
  <div style="position: absolute; top: -50px; left: -50px; width: 100px; height: 100px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
  <div style="position: absolute; bottom: -30px; right: -30px; width: 80px; height: 80px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
  <h1 style="font-size: 3rem; font-weight: bold; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); margin-bottom: 20px;">🎉 Bienvenue au Mondial 2030 Maroc ! 🌍⚽</h1>
  <p style="font-size: 1.3rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">Découvrez l'aventure ultime du football au Maroc ! Explorez, réservez et vivez l'expérience inoubliable !</p>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <h2 style="color: #c1272d; text-align: center; margin-bottom: 40px; font-weight: bold;">🚀 Comment profiter au maximum de votre expérience ?</h2>

      <div class="card border-0 shadow-lg mb-4" style="border-radius: 15px; overflow: hidden;">
        <div class="card-header" style="background: linear-gradient(90deg, #c1272d, #006233); color: white; font-size: 1.2rem; font-weight: bold;">
          🗺️ 1. Plongez dans la carte interactive !
        </div>
        <div class="card-body" style="padding: 30px;">
          <p class="lead">Cliquez sur le bouton magique ci-dessous pour accéder à notre carte interactive ultra-moderne ! 🌟</p>
          <p>Explorez les 6 villes hôtes sensationnelles : <strong>Casablanca, Rabat, Marrakech, Agadir, Tanger et Fès</strong> avec des pins interactifs qui vous feront vibrer !</p>
          <ul class="list-unstyled">
            <li>🔍 <strong>Zoom & Déplacement :</strong> Utilisez votre souris pour zoomer/dézoomer et découvrir chaque détail !</li>
            <li>📍 <strong>Cliquez sur les pins :</strong> Découvrez la météo en temps réel, les statistiques et bien plus !</li>
          </ul>
        </div>
      </div>

      <div class="card border-0 shadow-lg mb-4" style="border-radius: 15px; overflow: hidden;">
        <div class="card-header" style="background: linear-gradient(90deg, #006233, #c1272d); color: white; font-size: 1.2rem; font-weight: bold;">
          🎯 2. Découvrez les catégories organisées !
        </div>
        <div class="card-body" style="padding: 30px;">
          <p class="lead">Notre navbar révolutionnaire regroupe tout par catégories pour une navigation fluide ! 🎨</p>
          <div class="row text-center">
            <div class="col-md-4 mb-3">
              <div style="background: linear-gradient(135deg, #c1272d, #a02023); color: white; padding: 15px; border-radius: 10px;">
                📍 <strong>Localisation</strong><br><small>Villes & Stades</small>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div style="background: linear-gradient(135deg, #006233, #004d26); color: white; padding: 15px; border-radius: 10px;">
                🏨 <strong>Hébergement</strong><br><small>Hôtels & Airbnbs</small>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div style="background: linear-gradient(135deg, #c1272d, #a02023); color: white; padding: 15px; border-radius: 10px;">
                🍽️ <strong>Restauration</strong><br><small>Restaurants</small>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div style="background: linear-gradient(135deg, #006233, #004d26); color: white; padding: 15px; border-radius: 10px;">
                ⚽ <strong>Divertissement</strong><br><small>Matchs & Endroits</small>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div style="background: linear-gradient(135deg, #c1272d, #a02023); color: white; padding: 15px; border-radius: 10px;">
                🩺 <strong>Santé</strong><br><small>Pharmacies & Urgences</small>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div style="background: linear-gradient(135deg, #006233, #004d26); color: white; padding: 15px; border-radius: 10px;">
                🛠️ <strong>Utilitaires</strong><br><small>Convertisseur</small>
              </div>
            </div>
          </div>
          <p class="mt-3">Cliquez sur n'importe quelle catégorie pour découvrir un menu déroulant avec toutes les options disponibles !</p>
        </div>
      </div>

      <div class="card border-0 shadow-lg mb-4" style="border-radius: 15px; overflow: hidden;">
        <div class="card-header" style="background: linear-gradient(90deg, #c1272d, #006233); color: white; font-size: 1.2rem; font-weight: bold;">
          ⚡ 3. Explorez et réservez en un clic !
        </div>
        <div class="card-body" style="padding: 30px;">
          <p class="lead">Chaque popup sur la carte vous donne accès direct à tout ce dont vous avez besoin ! 🚀</p>
          <ul class="list-unstyled">
            <li>🌤️ <strong>Météo en temps réel :</strong> Température, ressenti, humidité, vent - restez informé !</li>
            <li>📊 <strong>Statistiques complètes :</strong> Nombre de matchs, hôtels, restaurants, pharmacies, urgences par ville</li>
            <li>🏆 <strong>Matchs programmés :</strong> Calendrier détaillé avec dates, heures, équipes et stades</li>
            <li>🏨 <strong>Hébergements variés :</strong> Hôtels de luxe et locations Airbnb pour tous les budgets</li>
            <li>🍴 <strong>Restaurants d'exception :</strong> Découvrez la gastronomie marocaine authentique</li>
            <li>🏛️ <strong>Endroits touristiques :</strong> Lieux incontournables et attractions uniques</li>
            <li>💊 <strong>Services de santé :</strong> Pharmacies et urgences pour votre tranquillité d'esprit</li>
            <li>💱 <strong>Convertisseur pratique :</strong> Changez vos devises en toute simplicité</li>
          </ul>
        </div>
      </div>

      <div class="text-center" style="margin-top: 50px;">
        <h3 style="color: #006233; margin-bottom: 30px;">Prêt à vivre l'aventure du siècle ? 🇲🇦⚽</h3>
        <a href="{{ route('carte') }}" class="btn btn-lg" style="background: linear-gradient(45deg, #c1272d, #006233); color: white; border: none; padding: 20px 40px; font-size: 1.4rem; font-weight: bold; border-radius: 50px; box-shadow: 0 8px 25px rgba(193, 39, 45, 0.3); text-decoration: none; transition: all 0.3s ease;">
          🚀 LANCER L'AVENTURE !
        </a>
        <p style="margin-top: 20px; color: #666; font-style: italic;">"Le Maroc vous attend pour le plus grand spectacle sportif de l'histoire ! 🌟"</p>
      </div>
    </div>
  </div>
</div>

<style>
.card:hover {
  transform: translateY(-5px);
  transition: all 0.3s ease;
}

.btn:hover {
  transform: scale(1.05);
  box-shadow: 0 12px 35px rgba(193, 39, 45, 0.4), 0 12px 35px rgba(0, 98, 51, 0.2) !important;
}
</style>
@endsection