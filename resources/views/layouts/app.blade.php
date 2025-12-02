<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre de la page affiché dans l'onglet du navigateur -->
    <title>Academie de langue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        /* Classes de mise en page en français */
        .ligne {
            display: flex;
            flex-wrap: wrap;
            margin-left: -0.5rem;
            margin-right: -0.5rem;
        }
        
        .ligne-centree {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-left: -0.5rem;
            margin-right: -0.5rem;
        }
        
        .colonne-12 {
            flex: 0 0 auto;
            width: 100%;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
        
        .colonne-md-1 {
            flex: 0 0 auto;
            width: 8.33333333%;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
        
        .colonne-md-2 {
            flex: 0 0 auto;
            width: 16.66666667%;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
        
        .colonne-md-3 {
            flex: 0 0 auto;
            width: 25%;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
        
        .colonne-md-4 {
            flex: 0 0 auto;
            width: 33.33333333%;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
        
        .colonne-md-5 {
            flex: 0 0 auto;
            width: 41.66666667%;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
        
        .colonne-md-6 {
            flex: 0 0 auto;
            width: 50%;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
        
        .gouttiere-1 {
            margin-left: -0.25rem;
            margin-right: -0.25rem;
        }
        
        .gouttiere-1 > .colonne-12,
        .gouttiere-1 > .colonne-md-1,
        .gouttiere-1 > .colonne-md-2,
        .gouttiere-1 > .colonne-md-3,
        .gouttiere-1 > .colonne-md-4,
        .gouttiere-1 > .colonne-md-5,
        .gouttiere-1 > .colonne-md-6 {
            padding-left: 0.25rem;
            padding-right: 0.25rem;
        }
        
        .gouttiere-2 {
            margin-left: -0.5rem;
            margin-right: -0.5rem;
        }
        
        .gouttiere-2 > .colonne-12,
        .gouttiere-2 > .colonne-md-1,
        .gouttiere-2 > .colonne-md-2,
        .gouttiere-2 > .colonne-md-3,
        .gouttiere-2 > .colonne-md-4,
        .gouttiere-2 > .colonne-md-5,
        .gouttiere-2 > .colonne-md-6 {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
        
        .gouttiere-3 {
            margin-left: -1rem;
            margin-right: -1rem;
        }
        
        .gouttiere-3 > .colonne-12,
        .gouttiere-3 > .colonne-md-1,
        .gouttiere-3 > .colonne-md-2,
        .gouttiere-3 > .colonne-md-3,
        .gouttiere-3 > .colonne-md-4,
        .gouttiere-3 > .colonne-md-5,
        .gouttiere-3 > .colonne-md-6 {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        /* Classes d'utilitaires en français */
        .marge-bas-1 {
            margin-bottom: 0.25rem !important;
        }
        
        .marge-bas-3 {
            margin-bottom: 1rem !important;
        }
        
        .marge-bas-4 {
            margin-bottom: 1.5rem !important;
        }
        
        .marge-haut-3 {
            margin-top: 1rem !important;
        }
        
        .marge-haut-4 {
            margin-top: 1.5rem !important;
        }
        
        .texte-centre {
            text-align: center !important;
        }
        
        .texte-muet {
            color: #6c757d !important;
        }
        
        .texte-danger {
            color: #dc3545 !important;
        }
        
        .texte-success {
            color: #198754 !important;
        }
        
        .texte-noir {
            color: #212529 !important;
        }
        
        .texte-blanc {
            color: #fff !important;
        }
        
        .bg-blanc {
            background-color: #fff !important;
        }
        
        .bg-clair {
            background-color: #f8f9fa !important;
        }
        
        .aligner-soi-fin {
            align-self: flex-end;
        }
        
        .gras {
            font-weight: bold !important;
        }
        
        .taille-police-4 {
            font-size: 1.5rem !important;
        }
        
        .cacher {
            display: none !important;
        }
        
        .affichage-inline-block {
            display: inline-block !important;
        }
        
        .marge-droite-5px {
            margin-right: 5px !important;
        }
        
        /* Classes personnalisées en français */
        .conteneur-principal {
            margin-left: 280px;
            min-height: 100vh;
            background-color: #f8f9fa;
            padding: 2rem;
            transition: all 0.3s ease;
        }
        
        .barre-navigation {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(180deg, #667eea 0%,rgb(75, 84, 162) 100%);
            box-shadow: 4px 0 12px rgba(0,0,0,0.15);
            z-index: 1000;
            overflow-y: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        
        .marque-navigation {
            padding: 2rem 1.5rem;
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }
        
        .liens-navigation {
            padding: 1rem 0;
            flex: 1;
            overflow-y: auto;
        }
        
        .lien-navigation {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            border-left: 4px solid transparent;
        }
        
        .lien-navigation:hover {
            background-color: rgba(255,255,255,0.15);
            color: white;
            padding-left: 2rem;
        }
        
        .lien-navigation.actif {
            background-color: rgba(255,255,255,0.2);
            color: white;
            border-left-color: white;
        }
        
        .pied-navigation {
            position: sticky;
            bottom: 0;
            width: 100%;
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.2);
            background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.08));
        }
        
        .menu-utilisateur {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1001;
        }
        
        .bouton-menu-utilisateur {
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        
        .menu-deroulant-utilisateur {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            min-width: 200px;
            display: none;
            z-index: 1002;
            margin-top: 0.5rem;
        }
        
        .menu-deroulant-utilisateur.affiche {
            display: block;
        }
        
        .entete-menu-utilisateur {
            padding: 1rem;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            color: #333;
        }
        
        .element-menu-utilisateur {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .element-menu-utilisateur:hover {
            background: #f8f9fa;
        }
        
        .formulaire-deconnexion {
            width: 100%;
        }
        
        .bouton-deconnexion {
            width: 100%;
            background: none;
            border: none;
            color: #dc3545;
            font-weight: 500;
            cursor: pointer;
            text-align: left;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        
        .bouton-deconnexion:hover {
            background: #f8f9fa;
        }
        
        .barre-haut-mobile {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            z-index: 1001;
            align-items: center;
            padding: 0 1rem;
        }
        
        .bouton-menu-mobile {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .liens-invite {
            padding: 2rem 1.5rem;
        }
        
        .lien-invite {
            display: block;
            padding: 1rem;
            background: rgba(255,255,255,0.2);
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .lien-invite:hover {
            background: rgba(255,255,255,0.3);
            color: white;
            transform: translateY(-2px);
        }
        
        .alerte {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .carte {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border: none;
        }
        
        .tableau-donnees {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .entete-tableau {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .ligne-tableau:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .ligne-tableau:hover {
            background-color: #e9ecef;
        }
        
        .bouton-primaire {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .bouton-primaire:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .bouton-secondaire {
            background: white;
            border: 2px solid #667eea;
            color: #667eea;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .bouton-secondaire:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
        }
        
        .bouton-succes {
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .bouton-succes:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .bouton-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .bouton-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .bouton-contour-primaire {
            background: transparent;
            border: 2px solid #667eea;
            color: #667eea;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .bouton-contour-primaire:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }
        
        .bouton-contour-secondaire {
            background: transparent;
            border: 2px solid #6c757d;
            color: #6c757d;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .bouton-contour-secondaire:hover {
            background: rgba(108, 117, 125, 0.1);
            transform: translateY(-2px);
        }
        
        .bouton-petit {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 6px;
        }
        
        .formulaire-carte {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 2rem;
        }
        
        .champ-formulaire {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            width: 100%;
            display: block;
        }
        
        .champ-formulaire:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        }
        
        .etiquette-formulaire {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .groupe-boutons {
            display: inline-flex;
            border-radius: 8px;
            vertical-align: middle;
        }
        
        .groupe-boutons > .bouton {
            position: relative;
            flex: 1 1 auto;
        }
        
        .groupe-boutons > .bouton:not(:first-child) {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        
        .groupe-boutons > .bouton:not(:last-child) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .barre-navigation {
                left: -280px;
            }
            
            .barre-navigation.affiche {
                left: 0;
            }
            
            .conteneur-principal {
                margin-left: 0;
                padding-top: 80px;
            }
            
            .barre-haut-mobile {
                display: flex;
            }
            
            .menu-utilisateur {
                position: absolute;
                top: 15px;
                right: 15px;
            }
            
            .colonne-md-1,
            .colonne-md-2,
            .colonne-md-3,
            .colonne-md-4,
            .colonne-md-5,
            .colonne-md-6 {
                flex: 0 0 auto;
                width: 100%;
            }
        }
        
    </style>
</head>
<body>
<!-- Barre haut mobile -->
<div class="barre-haut-mobile">
    <button class="bouton-menu-mobile" onclick="basculerNavigation()">
        <i class="bi bi-list"></i>
    </button>
    <div class="marque-navigation">
        <i class="bi bi-mortarboard-fill me-2"></i>Language Academy
    </div>
</div>

<!-- Menu déroulant utilisateur -->
@auth
<div class="menu-utilisateur">
    <button class="bouton-menu-utilisateur" onclick="basculerMenuUtilisateur()">
        <i class="bi bi-person-circle"></i>
        <span>{{ Auth::user()->name }}</span>
        <i class="bi bi-chevron-down ms-2"></i>
    </button>
    <div class="menu-deroulant-utilisateur" id="menuDeroulantUtilisateur">
        <div class="entete-menu-utilisateur">
            Connecté en tant que<br>
            <strong>{{ Auth::user()->name }}</strong>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="formulaire-deconnexion">
            @csrf
            <button type="submit" class="element-menu-utilisateur bouton-deconnexion">
                <i class="bi bi-box-arrow-right"></i>
                Déconnexion
            </button>
        </form>
    </div>
</div>
@endauth

<!-- Barre de navigation -->
<div class="barre-navigation" id="barreNavigation">
    <div class="marque-navigation">
        <img src="{{ asset('images/logo_université.png') }}" alt="Academie de langue" style="width: 80px; height: 80px; object-fit: contain; margin-bottom: 0.5rem;">
        <div>Academie de langue</div>
    </div>
    
    {{-- Affiche la navigation uniquement pour les utilisateurs connectés --}}
    @auth
    <!-- Menu latéral: liens activés selon la route courante avec request()->routeIs() -->
    <nav class="liens-navigation">
        <a href="{{ route('dashboard') }}" class="lien-navigation {{ request()->routeIs('dashboard') ? 'actif' : '' }}">
            <i class="bi bi-speedometer2"></i>
            <span>Tableau de bord</span>
        </a>
        <a href="{{ route('students.index') }}" class="lien-navigation {{ request()->routeIs('students.*') ? 'actif' : '' }}">
            <i class="bi bi-people-fill"></i>
            <span>Étudiants</span>
        </a>
        <a href="{{ route('enrollments.index') }}" class="lien-navigation {{ request()->routeIs('enrollments.*') ? 'actif' : '' }}">
            <i class="bi bi-card-checklist"></i>
            <span>Inscriptions</span>
        </a>
        <a href="{{ route('payments.index') }}" class="lien-navigation {{ request()->routeIs('payments.*') ? 'actif' : '' }}">
            <i class="bi bi-cash-coin"></i>
            <span>Paiements</span>
        </a>
        <a href="{{ route('needs.index') }}" class="lien-navigation {{ request()->routeIs('needs.*') ? 'actif' : '' }}">
            <i class="bi bi-list-check"></i>
            <span>Besoins</span>
        </a>
    </nav>
    
    <div class="pied-navigation">
        <!-- Removed user profile from sidebar footer -->
    </div>
    @else
    <div class="liens-invite">
        <a href="{{ route('login') }}" class="lien-invite">
            <i class="bi bi-box-arrow-in-right me-2"></i>Connexion
        </a>
        <a href="{{ route('register') }}" class="lien-invite">
            <i class="bi bi-person-plus me-2"></i>Inscription
        </a>
    </div>
    @endauth
</div>

<!-- Conteneur principal -->
<div class="conteneur-principal">
    @if(session('success'))
        <div class="alerte alerte-success alerte-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    <!-- Emplacement où chaque vue enfant injecte son contenu via @section('content') -->
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function basculerNavigation() {
        document.getElementById('barreNavigation').classList.toggle('affiche');
    }
    
    function basculerMenuUtilisateur() {
        document.getElementById('menuDeroulantUtilisateur').classList.toggle('affiche');
    }
    
    // Fermer la navigation quand on clique en dehors sur mobile
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('barreNavigation');
        const menuToggle = document.querySelector('.bouton-menu-mobile');
        
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                sidebar.classList.remove('affiche');
            }
        }
    });
    
    // Fermer le menu utilisateur quand on clique en dehors
    document.addEventListener('click', function(event) {
        const userDropdown = document.querySelector('.menu-utilisateur');
        const userDropdownToggle = document.querySelector('.bouton-menu-utilisateur');
        const userDropdownMenu = document.getElementById('menuDeroulantUtilisateur');
        
        if (userDropdown && !userDropdown.contains(event.target)) {
            userDropdownMenu.classList.remove('affiche');
        }
    });
</script>
</body>
</html>