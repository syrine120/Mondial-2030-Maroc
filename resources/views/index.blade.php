@extends('layouts.app')

@section('title', 'Accueil - Mondial 2030 Maroc')

@section('content')
  <style>
    .hero-section {
      background: #c1272d;
      color: white;
      padding: 80px 20px;
      border-radius: 20px;
      text-align: center;
      margin-bottom: 40px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .hero-section h1 {
      font-size: 3.8rem;
      font-weight: bold;
      text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.6);
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 20px;
    }

    .hero-section .trophy {
      font-size: 4.5rem;
    }

    .hero-section p {
      font-size: 1.7rem;
      max-width: 900px;
      margin: 0 auto;
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
      line-height: 1.4;
    }

    #map {
      height: 600px;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
      margin-bottom: 40px;
    }

    .convertisseur-section {
      background-color: #f8f9fa;
      padding: 30px;
      border-radius: 15px;
    }
  </style>

  <!-- Hero section -->
  <div class="hero-section">
    <h1>
      <span class="trophy">🏆</span> Mondial 2030 Maroc
    </h1>
    <p>
      Découvrez les 6 villes hôtes de la Coupe du Monde 2030<br>
      en cliquant sur les pins de la carte
    </p>
  </div>

  <!-- Carte Leaflet -->
  <div id="map"></div>

  <!-- Leaflet CSS + JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>

  <script>
    const map = L.map('map').setView([31.7917, -7.0926], 6);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors',
      maxZoom: 19
    }).addTo(map);

    const villes = [
      { id: 1, nom: 'Casablanca', lat: 33.5731, lng: -7.5898, description: 'Capitale économique et hôte du match d’ouverture Mondial 2030', color: '#c1272d' },
      { id: 2, nom: 'Rabat', lat: 34.0209, lng: -6.8416, description: 'Capitale du Royaume et ville de la finale Mondial 2030', color: '#006233' },
      { id: 3, nom: 'Marrakech', lat: 31.6295, lng: -8.0088, description: 'Ville ocre, ambiance festive pour le Mondial 2030', color: '#c1272d' },
      { id: 4, nom: 'Agadir', lat: 30.4278, lng: -9.5981, description: 'Perle du sud, stades modernes pour le Mondial 2030', color: '#006233' },
      { id: 5, nom: 'Tanger', lat: 35.7595, lng: -5.8340, description: 'Porte nord-africaine, matchs explosifs Mondial 2030', color: '#c1272d' },
      { id: 6, nom: 'Fès', lat: 34.0181, lng: -5.0078, description: 'Capitale spirituelle et décor parfait pour le Mondial 2030', color: '#006233' }
    ];

    villes.forEach(ville => {
      const icon = L.divIcon({
        html: `<div style="background-color: ${ville.color}; width:48px; height:48px; border-radius:50%; border:4px solid white; display:flex; align-items:center; justify-content:center; font-size:22px; font-weight:bold; color:white; box-shadow:0 4px 12px rgba(0,0,0,0.3);">${ville.nom.charAt(0)}</div>`,
        iconSize: [48, 48],
        className: 'custom-icon'
      });

      const marker = L.marker([ville.lat, ville.lng], { icon }).addTo(map);

      marker.bindPopup(`
                <div class="popup-content" style="min-width: 340px; font-family: 'Segoe UI', sans-serif;">
                  <h5 style="color: #6b7280; font-size: 1.4rem; margin-bottom: 12px;">${ville.nom}</h5>
                  <p style="color: #4b5563; font-weight: 500; margin-bottom: 16px;">${ville.description}</p>

                  <!-- Météo -->
                  <div id="meteo-${ville.id}" style="
                    background: linear-gradient(135deg, #f3e8ff 0%, #e0f2fe 100%);
                    border-radius: 12px;
                    padding: 18px;
                    margin: 16px 0;
                    text-align: center;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
                    color: #1f2937;
                    min-height: 140px;
                  ">
                    <div>⏳ Chargement de la météo...</div>
                  </div>

                  <!-- Compteurs -->
                  <div class="info-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(90px, 1fr)); gap: 12px; margin: 16px 0;">
                    <div class="info-item" style="background: #fef3f2; border-radius: 10px; padding: 12px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
                      <strong id="matches-${ville.id}" style="color: #ef4444; font-size: 1.6rem; display: block;">...</strong>
                      <span style="color: #6b7280; font-size: 0.9rem;">Matchs</span>
                    </div>
                    <div class="info-item" style="background: #ecfdf5; border-radius: 10px; padding: 12px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
                      <strong id="hotels-${ville.id}" style="color: #10b981; font-size: 1.6rem; display: block;">...</strong>
                      <span style="color: #6b7280; font-size: 0.9rem;">Hôtels</span>
                    </div>
                    <div class="info-item" style="background: #fef3f2; border-radius: 10px; padding: 12px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
                      <strong id="restos-${ville.id}" style="color: #f59e0b; font-size: 1.6rem; display: block;">...</strong>
                      <span style="color: #6b7280; font-size: 0.9rem;">Restaurants</span>
                    </div>
                    <div class="info-item" style="background: #ecfdf5; border-radius: 10px; padding: 12px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
                      <strong id="places-${ville.id}" style="color: #8b5cf6; font-size: 1.6rem; display: block;">...</strong>
                      <span style="color: #6b7280; font-size: 0.9rem;">Endroits</span>
                    </div>
                    <div class="info-item" style="background: #fef3f2; border-radius: 10px; padding: 12px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
                      <strong id="pharm-${ville.id}" style="color: #ec4899; font-size: 1.6rem; display: block;">...</strong>
                      <span style="color: #6b7280; font-size: 0.9rem;">Pharmacies</span>
                    </div>
                    <div class="info-item" style="background: #ecfdf5; border-radius: 10px; padding: 12px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
                      <strong id="urg-${ville.id}" style="color: #ef4444; font-size: 1.6rem; display: block;">...</strong>
                      <span style="color: #6b7280; font-size: 0.9rem;">Urgences</span>
                    </div>
                    <div class="info-item" style="background: #e0f2fe; border-radius: 10px; padding: 12px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
                      <strong id="airbnbs-${ville.id}" style="color: #0ea5e9; font-size: 1.6rem; display: block;">...</strong>
                      <span style="color: #6b7280; font-size: 0.9rem;">Airbnbs</span>
                    </div>
                    <div class="info-item" style="background: #fef3f2; border-radius: 10px; padding: 12px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
                      <strong id="stades-${ville.id}" style="color: #ef4444; font-size: 1.6rem; display: block;">...</strong>
                      <span style="color: #6b7280; font-size: 0.9rem;">Stades</span>
                    </div>
                  </div>

                  <!-- Boutons -->
                  <div class="popup-links" style="display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; margin-top: 16px;">
                    <a href="/games?ville_id=${ville.id}"     style="background: #fee2e2; color: #991b1b; padding: 8px 14px; border-radius: 8px; text-decoration: none; font-weight: 500;">⚽ Matchs</a>
                    <a href="/hotels?ville_id=${ville.id}"    style="background: #d1fae5; color: #065f46; padding: 8px 14px; border-radius: 8px; text-decoration: none; font-weight: 500;">🏨 Hôtels</a>
                    <a href="/restaurants?ville_id=${ville.id}" style="background: #fee2e2; color: #991b1b; padding: 8px 14px; border-radius: 8px; text-decoration: none; font-weight: 500;">🍽️ Restaurants</a>
                    <a href="/endroits?ville_id=${ville.id}"  style="background: #d1fae5; color: #065f46; padding: 8px 14px; border-radius: 8px; text-decoration: none; font-weight: 500;">🎫 Endroits</a>
                    <a href="/pharmacies?ville_id=${ville.id}" style="background: #e0e7ff; color: #3730a3; padding: 8px 14px; border-radius: 8px; text-decoration: none; font-weight: 500;">💊 Pharmacies</a>
                    <a href="/urgences?ville_id=${ville.id}"  style="background: #fee2e2; color: #991b1b; padding: 8px 14px; border-radius: 8px; text-decoration: none; font-weight: 500;">🚨 Urgences</a>
                    <a href="/airbnbs?ville_id=${ville.id}"   style="background: #e0f2fe; color: #0ea5e9; padding: 8px 14px; border-radius: 8px; text-decoration: none; font-weight: 500;">🏠 Airbnbs</a>
                    <a href="/stades?ville_id=${ville.id}"    style="background: #fee2e2; color: #ef4444; padding: 8px 14px; border-radius: 8px; text-decoration: none; font-weight: 500;">🏟️ Stades</a>
                  </div>
                </div>
              `, { maxWidth: 400 });

      marker.on('popupopen', async function () {
        try {
          const respVille = await fetch(`/api/ville/${ville.id}`);
          const dataVille = await respVille.json();

          document.getElementById(`matches-${ville.id}`).textContent = dataVille.games_count || '0';
          document.getElementById(`hotels-${ville.id}`).textContent = dataVille.hotels_count || '0';
          document.getElementById(`restos-${ville.id}`).textContent = dataVille.restaurants_count || '0';
          document.getElementById(`places-${ville.id}`).textContent = dataVille.endroits_count || '0';
          document.getElementById(`pharm-${ville.id}`).textContent = dataVille.pharmacies_count || '0';
          document.getElementById(`urg-${ville.id}`).textContent = dataVille.urgences_count || '0';
          document.getElementById(`airbnbs-${ville.id}`).textContent = dataVille.airbnbs_count || '0';
          document.getElementById(`stades-${ville.id}`).textContent = dataVille.stades_count || '0';

          const respMeteo = await fetch(`/api/meteo/${encodeURIComponent(ville.nom)}`);
          const meteo = await respMeteo.json();
          let meteoHtml = '<div>Météo indisponible</div>';
          if (!meteo.error) {
            const icon = getWeatherIcon(meteo.icon);
            meteoHtml = `<div style="font-size:52px;margin:12px 0;">${icon}</div>
                      <strong>${meteo.temperature}°C</strong> (ressenti ${meteo.feels_like}°C)<br>
                      <span>${meteo.description_fr}</span><br>
                      <small>Humidité: ${meteo.humidity}% • Vent: ${meteo.wind_speed} km/h</small>`;
          }
          document.getElementById(`meteo-${ville.id}`).innerHTML = meteoHtml;
        } catch (error) {
          document.getElementById(`meteo-${ville.id}`).innerHTML = 'Erreur de chargement';
        }
      });
    });

    function getWeatherIcon(code) {
      const map = {
        '01d': '☀️', '01n': '🌙', '02d': '⛅', '02n': '🌤️',
        '03d': '☁️', '03n': '☁️', '04d': '☁️', '04n': '☁️',
        '09d': '🌦️', '10d': '🌧️', '11d': '⛈️', '13d': '❄️', '50d': '🌫️'
      };
      return map[code] || '🌤️';
    }
  </script>
@endsection