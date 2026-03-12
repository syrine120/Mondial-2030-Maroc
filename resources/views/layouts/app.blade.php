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
    /* ===== BASE STYLES ===== */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      color: #2d3436;
      line-height: 1.6;
      padding-bottom: 100px;
    }
    h1, h2, h3, h4, h5, .navbar-brand {
      font-family: 'Outfit', sans-serif;
      font-weight: 700;
    }

    /* ===== NAVBAR ===== */
    .navbar {
      background: #c1272d !important;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      z-index: 1030;
      position: relative;
      padding: 1.2rem 0;
      transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .navbar-brand {
      font-size: 1.5rem;
      font-weight: bold;
      color: white !important;
      letter-spacing: -0.5px;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }
    .nav-link {
      color: white !important;
      font-weight: 600;
      font-size: 0.95rem;
      padding: 0.5rem 1rem !important;
      transition: all 0.3s ease;
    }
    .nav-link:hover {
      color: #ffffff !important;
      opacity: 1;
      transform: translateY(-2px);
    }
    .dropdown-menu {
      background-color: #c1272d !important;
      border: 1px solid #a02023 !important;
      border-radius: 0.375rem;
      min-width: 180px;
      z-index: 1050;
      padding: 10px;
    }
    .dropdown-item {
      color: white !important;
      font-weight: 600;
      border-radius: 10px;
      padding: 10px 15px;
    }
    .dropdown-item:hover {
      background-color: #a02023 !important;
      color: white !important;
    }

    /* ===== CARDS ===== */
    .card {
      border: none;
      border-radius: 24px;
      box-shadow: var(--shadow-soft, 0 2px 10px rgba(0,0,0,0.05));
      transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
      background: white;
      margin-bottom: 2rem;
    }
    .card:hover {
      transform: translateY(-12px);
      box-shadow: var(--shadow-premium, 0 20px 40px rgba(0,0,0,0.15));
    }

    /* ===== FOOTER ===== */
    footer {
      background: #006233 !important;
      color: white !important;
      padding: 60px 0 40px;
      margin-top: 80px;
      position: relative;
      text-align: center;
    }
    .language-selector-footer {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(15px);
      -webkit-backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 24px;
      padding: 30px 40px;
      display: inline-flex;
      align-items: center;
      gap: 30px;
      margin-bottom: 50px;
      transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }
    .language-selector-footer:hover {
      background: rgba(255, 255, 255, 0.12);
      transform: translateY(-8px);
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
      border-color: rgba(255, 255, 255, 0.4);
    }
    .language-selector-footer .globe-icon {
      font-size: 48px;
      animation: spin-slow 12s linear infinite;
      filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.3));
    }
    @keyframes spin-slow {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }
    .language-selector-footer .text-content {
      display: flex;
      flex-direction: column;
      gap: 5px;
      text-align: left;
    }
    .language-selector-footer .title {
      font-size: 20px;
      font-weight: 800;
      color: #fff;
      letter-spacing: 0.5px;
      margin: 0;
    }
    .language-selector-footer .subtitle {
      font-size: 14px;
      color: rgba(255, 255, 255, 0.7);
      font-weight: 500;
      margin: 0;
    }
    .goog-te-combo {
      padding: 12px 25px !important;
      border-radius: 12px !important;
      border: 1px solid rgba(255, 255, 255, 0.3) !important;
      background: rgba(255, 255, 255, 0.9) !important;
      font-size: 15px !important;
      font-weight: 600 !important;
      color: #333 !important;
      cursor: pointer !important;
      outline: none !important;
      transition: all 0.3s ease !important;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
    }
    .goog-te-combo:hover {
      background: #fff !important;
      transform: scale(1.05);
    }
    .goog-te-gadget {
      font-family: inherit !important;
      color: transparent !important;
    }
    .goog-te-gadget .goog-te-combo { margin: 4px 0 !important; }
    body { top: 0px !important; }

    @media (max-width: 768px) {
      .navbar-nav .nav-link { font-size: 0.8rem; padding: 0.4rem 0.6rem; }
      .dropdown-menu { min-width: 140px; }
      .navbar-nav .nav-link:before { content: none; }
      .language-selector-footer {
        flex-direction: column;
        text-align: center;
        padding: 20px 25px;
        gap: 15px;
      }
      .language-selector-footer .globe-icon { font-size: 36px; }
      .language-selector-footer .goog-te-combo { width: 100%; min-width: auto; }
    }
    .footer-divider {
      height: 2px;
      background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.3) 50%, transparent 100%);
      margin: 25px 0;
    }

    /* ===== CHATBOT WIDGET STYLES ===== */
    #chatbot-toggle {
      z-index: 9999;
      background: #c1272d !important;
      border: none;
      box-shadow: 0 4px 20px rgba(193, 39, 45, 0.4);
      transition: all 0.3s ease;
    }
    #chatbot-toggle:hover {
      transform: scale(1.1);
      box-shadow: 0 6px 25px rgba(193, 39, 45, 0.6);
    }
    #chatbot-window {
      z-index: 9998;
      border: 1px solid rgba(193, 39, 45, 0.2);
      animation: slideUp 0.3s ease;
    }
    @keyframes slideUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    #chatbot-messages { scroll-behavior: smooth; }
    #chatbot-messages .user-msg {
      background: #c1272d !important;
      color: white !important;
      border-radius: 18px 18px 4px 18px;
    }
    #chatbot-messages .bot-msg {
      background: #f1f1f1 !important;
      color: #2d3436 !important;
      border-radius: 18px 18px 18px 4px;
    }
    #chatbot-input {
      border: 2px solid #e0e0e0;
      transition: border-color 0.2s;
    }
    #chatbot-input:focus {
      border-color: #c1272d;
      box-shadow: 0 0 0 3px rgba(193, 39, 45, 0.1);
      outline: none;
    }
    #chatbot-send {
      background: #c1272d !important;
      border: none;
      transition: all 0.2s;
    }
    #chatbot-send:hover:not(:disabled) {
      background: #a02023 !important;
      transform: scale(1.05);
    }
    #chatbot-send:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }
    @media (max-width: 576px) {
      #chatbot-window {
        width: calc(100vw - 30px) !important;
        right: 15px !important;
        left: 15px !important;
      }
    }

    /* ===== THINKING ANIMATION ===== */
    .thinking-wrapper {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 4px 0;
      min-height: 24px;
    }
    .thinking-spinner {
      width: 16px;
      height: 16px;
      border: 2px solid rgba(193, 39, 45, 0.3);
      border-top-color: #c1272d;
      border-radius: 50%;
      animation: spin 1s linear infinite;
      flex-shrink: 0;
    }
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    .thinking-text {
      font-style: italic;
      color: #666 !important;
      font-size: 0.85rem;
      animation: pulseText 2s ease-in-out infinite;
    }
    @keyframes pulseText {
      0%, 100% { opacity: 0.7; }
      50% { opacity: 1; }
    }
  </style>
</head>

<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">🏆 Mondial 2030 Maroc</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="localisationDropdown" role="button" data-bs-toggle="dropdown">📍 Localisation</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('villes.index') }}">🏙️ Villes</a></li>
              <li><a class="dropdown-item" href="{{ route('stades.index') }}">🏟️ Stades</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="hebergementDropdown" role="button" data-bs-toggle="dropdown">🏨 Hébergement</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('hotels.index') }}">🏨 Hôtels</a></li>
              <li><a class="dropdown-item" href="{{ route('airbnbs.index') }}">🏠 Airbnbs</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="restaurationDropdown" role="button" data-bs-toggle="dropdown">🍽️ Restauration</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('restaurants.index') }}">🍽️ Restaurants</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="divertissementDropdown" role="button" data-bs-toggle="dropdown">⚽ Divertissement</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('games.index') }}">⚽ Matchs</a></li>
              <li><a class="dropdown-item" href="{{ route('endroits.index') }}">🎫 Endroits</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="utilitairesDropdown" role="button" data-bs-toggle="dropdown">🛠️ Utilitaires</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('convertisseur.index') }}">💱 Convertisseur</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="santeDropdown" role="button" data-bs-toggle="dropdown">🩺 Santé</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('pharmacies.index') }}">💊 Pharmacies</a></li>
              <li><a class="dropdown-item" href="{{ route('urgences.index') }}">🚨 Urgences</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link guide-link" href="{{ route('carte') }}">📖 Guide</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- CONTENT -->
  <main class="py-4">
    <div class="container">
      <div id="returnButtons" class="return-buttons mb-4 d-flex"></div>
      @if($errors->any())
        <div class="alert alert-danger">
          <strong>Erreurs :</strong>
          <ul class="mb-0">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
          </ul>
        </div>
      @endif
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @yield('content')
    </div>
  </main>

  <!-- CHATBOT WIDGET HTML -->
  <button id="chatbot-toggle" class="position-fixed bottom-0 end-0 m-4 rounded-circle p-3 d-flex align-items-center justify-content-center" onclick="toggleChatbot()" title="Chat avec l'assistant">
    <i class="bi bi-chat-dots-fill fs-4 text-white"></i>
  </button>

  <div id="chatbot-window" class="position-fixed bottom-0 end-0 m-4 mb-5 d-none" style="width: 380px; max-width: 95vw;">
    <div class="card shadow-lg border-0">
      <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center py-3">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-robot fs-5"></i>
          <span class="fw-bold">Assistant Mondial 2030</span>
        </div>
        <button onclick="toggleChatbot()" class="btn btn-sm btn-link text-white p-0 border-0" title="Fermer">
          <i class="bi bi-x-lg fs-5"></i>
        </button>
      </div>
      <div id="chatbot-messages" class="card-body p-3" style="height: 350px; overflow-y: auto; background: #fafafa;">
        <div class="d-flex justify-content-start mb-3">
          <div class="bot-msg px-3 py-2 small" style="max-width: 85%;">
            👋 Bonjour ! Je suis votre assistant pour le Mondial 2030 au Maroc. Comment puis-je vous aider aujourd'hui ?
          </div>
        </div>
      </div>
      <div class="card-footer bg-white border-0 p-3">
        <form id="chatbot-form" class="d-flex gap-2">
          @csrf
          <input type="text" id="chatbot-input" class="form-control form-control-sm" placeholder="Écrivez votre message..." autocomplete="off">
          <button type="submit" id="chatbot-send" class="btn btn-danger btn-sm px-3">
            <i class="bi bi-send-fill"></i>
          </button>
        </form>
        <div class="text-center mt-2">
          <small class="text-muted" style="font-size: 0.7rem;">Propulsé par IA locale • Données privées</small>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer>
    <div class="container mb-5">
      <div class="cta-premium-card">
        @guest
          <div class="cta-glass-content">
            <div class="cta-icon-wrapper">
              <i class="bi bi-bell-fill cta-main-icon"></i>
              <div class="cta-pulse"></div>
            </div>
            <div class="cta-text-wrapper text-start">
              <h2 class="cta-title">Vivez l'expérience Mondial 2030 ! 🌍⚽</h2>
              <p class="cta-description">
                Rejoignez notre communauté pour recevoir les dernières <strong>news sur l'histoire du Maroc</strong>,
                être informé des <strong>matchs</strong> et découvrir toutes les <strong>nouveautés</strong>.
              </p>
              <p class="cta-benefit">
                <i class="bi bi-check-circle-fill"></i> Si vous restez connecté, vous serez à jour avec les nouveautés et
                vous aurez la possibilité de recevoir des notifications exclusives !
              </p>
            </div>
            <div class="cta-actions">
              <a href="{{ route('login') }}" class="cta-btn cta-btn-primary text-decoration-none">Connexion 🔐</a>
              <a href="{{ route('register') }}" class="cta-btn cta-btn-outline text-decoration-none">S'inscrire ✍️</a>
            </div>
          </div>
        @endguest
        @auth
          <div class="cta-glass-content">
            <div class="cta-icon-wrapper">
              <i class="bi bi-star-fill cta-main-icon rating-star-icon"></i>
            </div>
            <div class="cta-text-wrapper text-start">
              <h2 class="cta-title">Votre avis compte pour nous ! ⭐</h2>
              <p class="cta-description">
                Vous êtes connecté en tant que <strong>{{ auth()->user()->nom }}</strong>.
                En restant connecté, vous recevrez toutes les <strong>nouveautés</strong> et des
                <strong>notifications</strong> en temps réel par email.
              </p>
              <div id="ratingSuccessMessage" class="alert alert-success d-none py-2 rounded-pill fw-bold mb-0">
                <i class="bi bi-check-lg"></i> Merci pour votre note ! Vous pouvez voter à nouveau si vous changez d'avis.
              </div>
            </div>
            <div class="cta-rating-wrapper">
              <form id="globalRatingForm" class="d-flex flex-column align-items-center mb-0">
                @csrf
                <div class="rating-stars-interactive mb-3">
                  @php $userRating = \App\Models\Rating::where('user_id', auth()->id())->first()?->stars ?? 0; @endphp
                  @for($i = 1; $i <= 5; $i++)
                    <span class="star-item" data-value="{{ $i }}" style="--index: {{ $i }};">
                      <i class="bi {{ $i <= $userRating ? 'bi-star-fill' : 'bi-star' }}"></i>
                    </span>
                  @endfor
                </div>
                <input type="hidden" name="stars" id="globalStarsInput" value="{{ $userRating }}">
                <button type="submit" class="cta-btn cta-btn-primary px-4 fw-bold mb-2">Enregistrer ma note</button>
              </form>
              <form action="{{ route('logout') }}" method="POST" class="text-center">
                @csrf
                <button type="submit" class="btn btn-link text-white-50 p-0 text-decoration-none small" style="font-size: 0.8rem;">Déconnexion</button>
              </form>
            </div>
          </div>
        @endauth
      </div>
    </div>

    <style>
      .cta-premium-card {
        background: linear-gradient(135deg, #c1272d 0%, #006233 100%);
        border-radius: 20px;
        padding: 3px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        margin-top: -20px;
        z-index: 10;
        transition: transform 0.4s ease;
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
      }
      .cta-premium-card:hover { transform: translateY(-5px); }
      .cta-glass-content {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 17px;
        padding: 25px 35px;
        display: flex;
        align-items: center;
        gap: 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
      }
      .cta-icon-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        flex-shrink: 0;
      }
      .cta-main-icon {
        font-size: 35px;
        color: #ffc107;
        z-index: 2;
        filter: drop-shadow(0 0 10px rgba(255, 193, 7, 0.6));
      }
      .cta-pulse {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 3px solid rgba(255, 255, 255, 0.4);
        border-radius: 50%;
        animation: pulse-ring 2.5s infinite;
      }
      @keyframes pulse-ring {
        0% { transform: scale(.7); opacity: 1; }
        100% { transform: scale(1.5); opacity: 0; }
      }
      .cta-title { color: white; font-size: 1.6rem; font-weight: 800; margin-bottom: 8px; letter-spacing: -0.5px; }
      .cta-description { color: rgba(255, 255, 255, 0.95); font-size: 1rem; margin-bottom: 12px; line-height: 1.5; }
      .cta-benefit {
        background: rgba(0, 0, 0, 0.2);
        padding: 8px 16px;
        border-radius: 10px;
        color: #ffc107;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        border: 1px solid rgba(255, 193, 7, 0.3);
      }
      .cta-actions { display: flex; gap: 15px; margin-left: auto; }
      .cta-btn {
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 700;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        cursor: pointer;
        white-space: nowrap;
        font-size: 0.95rem;
      }
      .cta-btn-primary {
        background: #fff;
        color: #c1272d;
        box-shadow: 0 10px 25px rgba(193, 39, 45, 0.3);
      }
      .cta-btn-primary:hover {
        background: #f0f0f0;
        box-shadow: 0 15px 35px rgba(193, 39, 45, 0.5);
        transform: translateY(-5px) scale(1.02);
      }
      .cta-btn-outline {
        background: transparent;
        color: #fff;
        border: 2px solid rgba(255, 255, 255, 0.6);
      }
      .cta-btn-outline:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: #fff;
        transform: translateY(-5px);
      }
      .rating-stars-interactive { display: flex; gap: 12px; }
      .star-item {
        font-size: 3rem;
        color: rgba(255, 255, 255, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
      }
      .star-item:hover { transform: scale(1.3) rotate(8deg); color: #ffca2c; }
      .star-item.active { color: #ffc107; filter: drop-shadow(0 0 10px rgba(255, 193, 7, 0.5)); }
      #ratingSuccessMessage.fade-out { opacity: 0; transition: opacity 0.5s ease; }
      @media (max-width: 1200px) {
        .cta-glass-content { flex-direction: column; text-align: center !important; padding: 40px 30px; }
        .cta-text-wrapper { text-align: center !important; }
        .cta-actions { margin-left: initial; }
        .cta-icon-wrapper { margin-bottom: 10px; }
      }
    </style>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const starItems = document.querySelectorAll('.star-item');
        const starsInput = document.getElementById('globalStarsInput');
        const ratingForm = document.getElementById('globalRatingForm');
        const ratingMsg = document.getElementById('ratingSuccessMessage');

        function renderStars(count) {
          starItems.forEach(s => {
            const val = parseInt(s.dataset.value);
            const icon = s.querySelector('i');
            if (val <= count) { s.classList.add('active'); icon.className = 'bi bi-star-fill'; }
            else { s.classList.remove('active'); icon.className = 'bi bi-star'; }
          });
        }
        starItems.forEach(star => {
          star.addEventListener('mouseover', () => renderStars(star.dataset.value));
          star.addEventListener('mouseout', () => renderStars(starsInput.value));
          star.addEventListener('click', () => { starsInput.value = star.dataset.value; renderStars(starsInput.value); });
        });
        if (ratingForm) {
          ratingForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(ratingForm);
            try {
              const res = await fetch('{{ route("rating.submit") }}', {
                method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' }
              });
              if (res.ok) {
                ratingMsg.classList.remove('d-none');
                setTimeout(() => {
                  ratingMsg.classList.add('fade-out');
                  setTimeout(() => { ratingMsg.classList.add('d-none'); ratingMsg.classList.remove('fade-out'); }, 500);
                }, 5000);
              }
            } catch (err) { console.error(err); }
          });
        }
      });
    </script>

    <div class="container text-center">
      <div class="language-selector-footer">
        <div class="globe-icon">🌍</div>
        <div class="text-content">
          <div class="title">Choisissez votre langue</div>
          <div class="subtitle">Choose your language • اختر لغتك</div>
        </div>
        <div id="google_translate_element" style="min-height: 40px;"></div>
      </div>
      <div class="footer-divider"></div>
      <p>&copy; {{ date('Y') }} Mondial 2030 Maroc — Tous droits réservés</p>
      <p>Bienvenue dans l'univers du Mondial 2030 au Maroc 🌍⚽</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Google Translate -->
  <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
        pageLanguage: 'fr',
        includedLanguages: 'en,es,ar,de,it,pt,zh-CN,ja,ru',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
      }, 'google_translate_element');
    }
  </script>
  <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  
  <!-- Return Buttons Logic -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const currentPath = window.location.pathname;
      const returnButtonsDiv = document.getElementById('returnButtons');
      let buttonsHTML = '';
      if (currentPath === '/' || currentPath === '/guide') {
        returnButtonsDiv.classList.remove('show');
      } else {
        buttonsHTML = `
          <button onclick="window.history.back()" class="btn btn-outline-secondary btn-return me-2">
            <i class="bi bi-arrow-left me-1"></i> Retour
          </button>
          <a href="{{ route('home') }}" class="btn btn-outline-primary btn-return">
            <i class="bi bi-map me-1"></i> Carte
          </a>
        `;
        returnButtonsDiv.innerHTML = buttonsHTML;
        returnButtonsDiv.classList.add('show');
      }
    });
  </script>

  <!-- ===== STREAMING CHATBOT JAVASCRIPT (FIXED) ===== -->
  <script>
    // Toggle chat window
    function toggleChatbot() {
      const win = document.getElementById('chatbot-window');
      win.classList.toggle('d-none');
      if (!win.classList.contains('d-none')) {
        document.getElementById('chatbot-input').focus();
        const msgs = document.getElementById('chatbot-messages');
        msgs.scrollTop = msgs.scrollHeight;
      }
    }

    // Escape HTML to prevent XSS
    function escapeHtml(text) {
      const div = document.createElement('div');
      div.textContent = text;
      return div.innerHTML;
    }

    // Show "thinking" animation with status text
    function showThinkingAnimation(element, phase = 'thinking') {
      const messages = {
        'thinking': 'L\'assistant réfléchit...',
        'analyzing': 'Analyse de votre demande...',
        'generating': 'Génération de la réponse...',
        'searching': 'Recherche d\'informations...'
      };
      // Keep the animation visible - don't clear content unless we have real text
      element.innerHTML = `
        <div class="thinking-wrapper d-flex align-items-center gap-2">
          <div class="thinking-spinner"></div>
          <small class="text-muted thinking-text">${messages[phase] || messages['thinking']}</small>
        </div>
      `;
    }

    // Handle form submission with streaming + fallback
    document.getElementById('chatbot-form').addEventListener('submit', async function(e) {
      e.preventDefault();
      
      const input = document.getElementById('chatbot-input');
      const sendBtn = document.getElementById('chatbot-send');
      const messagesDiv = document.getElementById('chatbot-messages');
      const message = input.value.trim();
      
      if (!message) return;

      // Add user message
      messagesDiv.innerHTML += `
        <div class="d-flex justify-content-end mb-3">
          <div class="user-msg px-3 py-2 small" style="max-width: 85%;">
            ${escapeHtml(message)}
          </div>
        </div>
      `;
      
      input.value = '';
      sendBtn.disabled = true;
      messagesDiv.scrollTop = messagesDiv.scrollHeight;

      // Create bot message container
      const botMsgId = 'bot-' + Date.now();
      messagesDiv.innerHTML += `
        <div class="d-flex justify-content-start mb-3">
          <div id="${botMsgId}" class="bot-msg px-3 py-2 small" style="max-width: 85%;">
          </div>
        </div>
      `;
      const botMsgEl = document.getElementById(botMsgId);
      
      // Show "thinking" animation immediately and KEEP it visible
      showThinkingAnimation(botMsgEl, 'thinking');
      messagesDiv.scrollTop = messagesDiv.scrollHeight;

      try {
        // Try streaming first
        await streamChat(message, botMsgEl);
      } catch (error) {
        console.log('Streaming failed, falling back to regular request');
        showThinkingAnimation(botMsgEl, 'generating');
        await fallbackChat(message, botMsgEl);
      }

      sendBtn.disabled = false;
      messagesDiv.scrollTop = messagesDiv.scrollHeight;
    });

    /**
     * Stream chat using Server-Sent Events - FIXED VERSION
     */
    async function streamChat(message, botMsgEl) {
      return new Promise((resolve, reject) => {
        const url = '{{ route("chat.stream") }}?message=' + encodeURIComponent(message);
        const eventSource = new EventSource(url);
        let fullText = '';
        let hasReceivedContent = false;

        eventSource.onmessage = function(event) {
          try {
            const data = JSON.parse(event.data);
            
            if (data.type === 'start') {
              // Keep thinking animation until we have actual content
              // Only clear when we receive the first content chunk
              return;
            }
            
            if (data.type === 'content' && data.text) {
              // First content received: clear animation and start showing text
              if (!hasReceivedContent) {
                botMsgEl.innerHTML = ''; // Now clear the thinking animation
                hasReceivedContent = true;
              }
              // Append each chunk
              fullText += data.text;
              botMsgEl.textContent = fullText;
              // Auto-scroll
              const messagesDiv = document.getElementById('chatbot-messages');
              messagesDiv.scrollTop = messagesDiv.scrollHeight;
              return;
            }
            
            if (data.type === 'end') {
              eventSource.close();
              // If we never received content, show fallback message
              if (!hasReceivedContent && !fullText.trim()) {
                botMsgEl.innerHTML = '<span class="text-muted">✓ Terminé</span>';
              }
              resolve();
              return;
            }
            
            if (data.type === 'error') {
              throw new Error(data.message);
            }
          } catch (e) {
            console.error('Parse error:', e, 'Raw:', event.data);
            // Don't reject on parse error - might be partial JSON
          }
        };

        eventSource.onerror = function(err) {
          eventSource.close();
          // If we never received content, reject to trigger fallback
          if (!hasReceivedContent && !fullText.trim()) {
            // Keep the thinking animation visible and trigger fallback
            reject(err);
          } else {
            resolve(); // Partial success
          }
        };

        // Timeout after 60 seconds
        setTimeout(() => {
          eventSource.close();
          if (!fullText.trim()) {
            // Keep animation visible and reject
            reject(new Error('Timeout'));
          }
        }, 60000);
      });
    }

    /**
     * Fallback: Regular non-streaming request
     */
    async function fallbackChat(message, botMsgEl) {
      // Keep "analyzing" animation while waiting
      showThinkingAnimation(botMsgEl, 'analyzing');
      
      const response = await fetch('{{ route("chat.send") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify({ message })
      });

      const data = await response.json();

      if (data.success) {
        // Clear animation and type the response
        botMsgEl.innerHTML = '';
        await typeText(botMsgEl, data.reply);
      } else {
        // Show error but keep container
        botMsgEl.innerHTML = `<span class="text-danger">⚠️ ${data.error || 'Erreur de connexion'}</span>`;
      }
    }

    /**
     * Simulate typing effect character by character
     */
    async function typeText(element, text, speed = 15) {
      element.innerHTML = '';
      for (let char of text) {
        element.textContent += char;
        const messagesDiv = document.getElementById('chatbot-messages');
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
        await new Promise(r => setTimeout(r, speed));
      }
    }
  </script>

  @yield('scripts')
</body>
</html>