<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>@yield('title', 'Mondial 2030 Maroc')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    /* Cache buster: v2026-01-05-19:45 */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
    }

    .navbar {
      background: #c1272d !important;
      box-shadow: 0 2px 10px rgba(0,0,0,0.2);
      z-index: 1030;
      position: relative;
    }

    .navbar-brand {
      font-size: 1.5rem;
      font-weight: bold;
      color: white !important;
    }

    .nav-link {
      color: white !important;
      font-weight: 600;
      font-size: 0.95rem;
    }

    .dropdown-menu {
      background-color: #c1272d !important;
      border: 1px solid #a02023 !important;
      border-radius: 0.375rem;
      min-width: 180px;
      z-index: 1050;
    }

    .dropdown-item {
      color: white !important;
      font-weight: 600;
    }

    .dropdown-item:hover {
      background-color: #a02023 !important;
      color: #c1272d !important;
    }

    /* BOUTONS DE RETOUR */
    .return-buttons {
      margin-bottom: 20px;
      display: none;
      flex-wrap: wrap;
      gap: 10px;
    }

    .return-buttons.show {
      display: flex;
    }

    .btn-return {
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    footer {
      background: #006233;
      color: white;
      padding: 40px 0;
      margin-top: 60px;
    }
        .language-selector-footer {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      padding: 25px 35px;
      display: inline-flex;
      align-items: center;
      gap: 20px;
      margin-bottom: 30px;
      transition: all 0.4s ease;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    }

    .language-selector-footer:hover {
      background: rgba(255, 255, 255, 0.15);
      transform: translateY(-5px);
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
    }

    .language-selector-footer .globe-icon {
      font-size: 42px;
      animation: spin 8s linear infinite;
      filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .language-selector-footer .text-content {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .language-selector-footer .title {
      font-size: 18px;
      font-weight: 700;
      color: white;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      letter-spacing: 0.5px;
    }

    .language-selector-footer .subtitle {
      font-size: 13px;
      color: rgba(255, 255, 255, 0.85);
      font-weight: 500;
    }

    /* Style the Google Translate dropdown to look AMAZING */
    .language-selector-footer .goog-te-gadget {
      font-family: inherit !important;
      font-size: 0 !important;
    }

    .language-selector-footer .goog-te-gadget > span,
    .language-selector-footer .goog-te-gadget > div > span {
      display: none !important;
    }

    .language-selector-footer .goog-te-combo {
      padding: 12px 20px;
      border-radius: 12px;
      border: 2px solid rgba(255, 255, 255, 0.4);
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%);
      font-size: 15px;
      font-weight: 600;
      color: #006233;
      cursor: pointer;
      outline: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
      min-width: 180px;
    }

    .language-selector-footer .goog-te-combo:hover {
      background: linear-gradient(135deg, #c1272d 0%, #a02023 100%);
      border-color: #c1272d;
      transform: scale(1.05);
      box-shadow: 0 6px 20px rgba(193, 39, 45, 0.4);
    }

    .language-selector-footer .goog-te-combo:focus {
      border-color: #c1272d;
      box-shadow: 0 0 0 4px rgba(193, 39, 45, 0.3);
    }

    /* Hide the ugly Google branding banner at the top */
    .goog-te-banner-frame.skiptranslate {
      display: none !important;
    }

    body {
      top: 0px !important;
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
      .navbar-nav .nav-link {
        font-size: 0.8rem;
        padding: 0.4rem 0.6rem;
      }
      .dropdown-menu {
        min-width: 140px;
      }
      .navbar-nav .nav-link:before {
        content: none;
      }
      .language-selector-footer {
        flex-direction: column;
        text-align: center;
        padding: 20px 25px;
        gap: 15px;
      }

      .language-selector-footer .globe-icon {
        font-size: 36px;
      }

      .language-selector-footer .goog-te-combo {
        width: 100%;
        min-width: auto;
      }
    }

    /* Footer divider line */
    .footer-divider {
      height: 2px;
      background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.3) 50%, transparent 100%);
      margin: 25px 0;
    }
  </style>
</head>
<body>

<!-- NAVBAR avec emojis -->
<nav class="navbar navbar-expand navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
      🏆 Mondial 2030 Maroc
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">

        <!-- LOCALISATION -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="localisationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            📍 Localisation
          </a>
          <ul class="dropdown-menu" aria-labelledby="localisationDropdown">
            <li><a class="dropdown-item" href="{{ route('villes.index') }}">🏙️ Villes</a></li>
            <li><a class="dropdown-item" href="{{ route('stades.index') }}">🏟️ Stades</a></li>
          </ul>
        </li>

        <!-- HÉBERGEMENT -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="hebergementDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            🏨 Hébergement
          </a>
          <ul class="dropdown-menu" aria-labelledby="hebergementDropdown">
            <li><a class="dropdown-item" href="{{ route('hotels.index') }}">🏨 Hôtels</a></li>
            <li><a class="dropdown-item" href="{{ route('airbnbs.index') }}">🏠 Airbnbs</a></li>
          </ul>
        </li>

        <!-- RESTAURATION -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="restaurationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            🍽️ Restauration
          </a>
          <ul class="dropdown-menu" aria-labelledby="restaurationDropdown">
            <li><a class="dropdown-item" href="{{ route('restaurants.index') }}">🍽️ Restaurants</a></li>
          </ul>
        </li>

        <!-- DIVERTISSEMENT -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="divertissementDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            ⚽ Divertissement
          </a>
          <ul class="dropdown-menu" aria-labelledby="divertissementDropdown">
            <li><a class="dropdown-item" href="{{ route('games.index') }}">⚽ Matchs</a></li>
            <li><a class="dropdown-item" href="{{ route('endroits.index') }}">🎫 Endroits</a></li>
          </ul>
        </li>

        <!-- UTILITAIRES -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="utilitairesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            🛠️ Utilitaires
          </a>
          <ul class="dropdown-menu" aria-labelledby="utilitairesDropdown">
            <li><a class="dropdown-item" href="{{ route('convertisseur.index') }}">💱 Convertisseur</a></li>
          </ul>
        </li>

        <!-- SANTÉ -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="santeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            🩺 Santé
          </a>
          <ul class="dropdown-menu" aria-labelledby="santeDropdown">
            <li><a class="dropdown-item" href="{{ route('pharmacies.index') }}">💊 Pharmacies</a></li>
            <li><a class="dropdown-item" href="{{ route('urgences.index') }}">🚨 Urgences</a></li>
          </ul>
        </li>

        <!-- GUIDE D'UTILISATION -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('carte') }}" style="margin-left: 10px;">
            📖 Guide
          </a>
        </li>

        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- CONTENU -->
<main class="py-4">
  <div class="container">

    <!-- Boutons Retour (Affichage dynamique selon la page) -->
    <div id="returnButtons" class="return-buttons mb-4 d-flex">
      <!-- Les boutons seront générés dynamiquement par JavaScript -->
    </div>

    <!-- MESSAGES D'ERREUR -->
    @if($errors->any())
      <div class="alert alert-danger">
        <strong>Erreurs :</strong>
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- MESSAGE DE SUCCÈS -->
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @yield('content')
  </div>
</main>
<!-- FOOTER -->
<footer>
  <div class="container text-center">
        <div class="language-selector-footer">
      <div class="globe-icon">🌍</div>
      <div class="text-content">
        <div class="title">Choisissez votre langue</div>
        <div class="subtitle">Choose your language • اختر لغتك</div>
      </div>
      <div id="google_translate_element"></div>
    </div>

    <!-- Divider line -->
    <div class="footer-divider"></div>
    <p>
      &copy; {{ date('Y') }} Mondial 2030 Maroc —
      Tous droits réservés
    </p>
    <p>Bienvenue dans l'univers du Mondial 2030 au Maroc 🌍⚽</p>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'fr',
    includedLanguages: 'en,es,ar,de,it,pt,zh-CN,ja,ru',
    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
  }, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname;
    const returnButtonsDiv = document.getElementById('returnButtons');

    // Déterminer quel bouton afficher selon la page
    let buttonsHTML = '';

    if (currentPath === '/') {
      // Page Guide : AUCUN bouton
      returnButtonsDiv.classList.remove('show');
    } else if (currentPath === '/guide') {
      // Page Guide : AUCUN bouton
      returnButtonsDiv.classList.remove('show');
    } else {
      // Pages Ressources (villes, hôtels, etc.) : 2 BOUTONS
      buttonsHTML = `
        <button onclick="window.history.back()" class="btn btn-outline-secondary btn-return">
          <i class="bi bi-arrow-left me-2"></i> Retour précédent
        </button>
        <a href="{{ route('home') }}" class="btn btn-outline-primary btn-return">
          <i class="bi bi-map me-2"></i> Retour à la carte
        </a>
      `;
      returnButtonsDiv.innerHTML = buttonsHTML;
      returnButtonsDiv.classList.add('show');
    }
  });
</script>

@yield('scripts')
</body>
</html>
