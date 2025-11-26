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
        
        /* Sidebar */
        .sidebar {
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
        
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }
        
        .sidebar-brand {
            padding: 2rem 1.5rem;
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }
        
        .sidebar-brand i {
            display: block;
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }
        
        .sidebar-nav {
            padding: 1rem 0;
            flex: 1;
            overflow-y: auto;
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            border-left: 4px solid transparent;
        }
        
        .sidebar-link i {
            font-size: 1.3rem;
            width: 30px;
            margin-right: 1rem;
        }
        
        .sidebar-link:hover {
            background-color: rgba(255,255,255,0.15);
            color: white;
            padding-left: 2rem;
        }
        
        .sidebar-link.active {
            background-color: rgba(255,255,255,0.2);
            color: white;
            border-left-color: white;
        }
        
        .sidebar-footer {
            position: sticky;
            bottom: 0;
            width: 100%;
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.2);
            background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.08));
        }
        
        /* User profile dropdown */
        .user-dropdown {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1001;
        }
        
        .user-dropdown-toggle {
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
        
        .user-dropdown-toggle:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        .user-dropdown-toggle i {
            font-size: 1.5rem;
            margin-right: 0.5rem;
        }
        
        .user-dropdown-menu {
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
        
        .user-dropdown-menu.show {
            display: block;
        }
        
        .user-dropdown-header {
            padding: 1rem;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            color: #333;
        }
        
        .user-dropdown-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .user-dropdown-item:hover {
            background: #f8f9fa;
        }
        
        .user-dropdown-item i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }
        
        .logout-form {
            width: 100%;
        }
        
        .logout-btn {
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
        
        .logout-btn:hover {
            background: #f8f9fa;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            background-color: #f8f9fa;
            padding: 2rem;
            transition: all 0.3s ease;
        }
        
        /* Top Bar for mobile */
        .top-bar {
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
        
        .menu-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .top-bar-brand {
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            margin-left: 1rem;
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                left: -280px;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
                padding-top: 80px;
            }
            
            .top-bar {
                display: flex;
            }
            
            .user-dropdown {
                position: absolute;
                top: 15px;
                right: 15px;
            }
        }
        
        /* Guest links */
        .guest-links {
            padding: 2rem 1.5rem;
        }
        
        .guest-link {
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
        
        .guest-link:hover {
            background: rgba(255,255,255,0.3);
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<!-- Top bar for mobile -->
<div class="top-bar">
    <button class="menu-toggle" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>
    <div class="top-bar-brand">
        <i class="bi bi-mortarboard-fill me-2"></i>Language Academy
    </div>
</div>

<!-- User Profile Dropdown -->
@auth
<div class="user-dropdown">
    <button class="user-dropdown-toggle" onclick="toggleUserDropdown()">
        <i class="bi bi-person-circle"></i>
        <span>{{ Auth::user()->name }}</span>
        <i class="bi bi-chevron-down ms-2"></i>
    </button>
    <div class="user-dropdown-menu" id="userDropdownMenu">
        <div class="user-dropdown-header">
            Connecté en tant que<br>
            <strong>{{ Auth::user()->name }}</strong>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="user-dropdown-item logout-btn">
                <i class="bi bi-box-arrow-right"></i>
                Déconnexion
            </button>
        </form>
    </div>
</div>
@endauth

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <!-- <i class="bi bi-mortarboard-fill"></i> -->
        <img src="{{ asset('images/logo_université.png') }}" alt="Academie de langue" style="width: 80px; height: 80px; object-fit: contain; margin-bottom: 0.5rem;">
        <div>Academie de langue</div>
    </div>
    
    {{-- Affiche la navigation uniquement pour les utilisateurs connectés --}}
    @auth
    <!-- Menu latéral: liens activés selon la route courante avec request()->routeIs() -->
    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            <span>Tableau de bord</span>
        </a>
        <a href="{{ route('students.index') }}" class="sidebar-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i>
            <span>Étudiants</span>
        </a>
        <a href="{{ route('enrollments.index') }}" class="sidebar-link {{ request()->routeIs('enrollments.*') ? 'active' : '' }}">
            <i class="bi bi-card-checklist"></i>
            <span>Inscriptions</span>
        </a>
        <a href="{{ route('payments.index') }}" class="sidebar-link {{ request()->routeIs('payments.*') ? 'active' : '' }}">
            <i class="bi bi-cash-coin"></i>
            <span>Paiements</span>
        </a>
        <a href="{{ route('needs.index') }}" class="sidebar-link {{ request()->routeIs('needs.*') ? 'active' : '' }}">
            <i class="bi bi-list-check"></i>
            <span>Besoins</span>
        </a>
    </nav>
    
    <div class="sidebar-footer">
        <!-- Removed user profile from sidebar footer -->
    </div>
    @else
    <div class="guest-links">
        <a href="{{ route('login') }}" class="guest-link">
            <i class="bi bi-box-arrow-in-right me-2"></i>Connexion
        </a>
        <a href="{{ route('register') }}" class="guest-link">
            <i class="bi bi-person-plus me-2"></i>Inscription
        </a>
    </div>
    @endauth
</div>

<!-- Main Content -->
<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    <!-- Emplacement où chaque vue enfant injecte son contenu via @section('content') -->
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
    }
    
    function toggleUserDropdown() {
        document.getElementById('userDropdownMenu').classList.toggle('show');
    }
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.querySelector('.menu-toggle');
        
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        }
    });
    
    // Close user dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const userDropdown = document.querySelector('.user-dropdown');
        const userDropdownToggle = document.querySelector('.user-dropdown-toggle');
        const userDropdownMenu = document.getElementById('userDropdownMenu');
        
        if (userDropdown && !userDropdown.contains(event.target)) {
            userDropdownMenu.classList.remove('show');
        }
    });
</script>
</body>
</html>