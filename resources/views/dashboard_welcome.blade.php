<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - EduTech</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom styles and animations */
        .gradient-bg {
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
        }
        .sidebar-bg {
            background: rgba(26, 32, 44, 0.95);
            backdrop-filter: blur(10px);
        }
        .text-gradient {
            background: linear-gradient(90deg, #3B82F6, #10B981);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .card-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        }
        .glow-on-hover {
            transition: all 0.3s ease;
        }
        .glow-on-hover:hover {
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.5);
        }
        .btn-press {
            transition: all 0.2s ease;
        }
        .btn-press:active {
            transform: scale(0.98);
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        .menu-item {
            transition: all 0.3s ease;
        }
        .menu-item:hover {
            background: rgba(59, 130, 246, 0.1);
            border-left: 3px solid #3B82F6;
        }
        .menu-item.active {
            background: rgba(59, 130, 246, 0.2);
            border-left: 3px solid #3B82F6;
        }
        .notification-ping {
            animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
        }
        @keyframes ping {
            75%, 100% { transform: scale(1.5); opacity: 0; }
        }
        .progress-ring {
            transition: stroke-dashoffset 0.5s ease;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }
    </style>
</head>
<body class="gradient-bg text-gray-100 min-h-screen flex overflow-hidden">
    <!-- Sidebar -->
    <div class="sidebar-bg w-64 min-h-screen fixed hidden md:flex flex-col border-r border-gray-700 z-50">
        <div class="p-6 flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
            </svg>
            <span class="text-2xl font-bold text-gradient">EduTech</span>
        </div>
        
        <div class="flex-1 overflow-y-auto px-4 py-6">
            <!-- User Profile -->
            <div class="flex items-center space-x-4 p-4 mb-6 rounded-lg bg-gray-700 bg-opacity-50 animate__animated animate__fadeIn">
                <div class="relative">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile" class="w-12 h-12 rounded-full object-cover border-2 border-blue-500">
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-800"></span>
                </div>
                <div>
                    <h4 class="font-semibold">Marie Dupont</h4>
                    <p class="text-sm text-gray-400">Étudiante</p>
                </div>
            </div>
            
            <!-- Menu -->
            <nav class="space-y-1 animate__animated animate__fadeIn animate__delay-1s">
                <a href="#" class="menu-item active flex items-center space-x-3 px-4 py-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Tableau de bord</span>
                </a>
                
                <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span>Mes cours</span>
                </a>
                
                <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span>Certifications</span>
                </a>
                
                <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Progression</span>
                </a>
                
                <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <span>Discussions</span>
                </a>
                
                <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Mon compte</span>
                </a>
            </nav>
            
            <!-- Progress -->
            <div class="mt-8 p-4 bg-gray-700 bg-opacity-50 rounded-lg animate__animated animate__fadeIn animate__delay-2s">
                <h4 class="font-medium mb-3 flex justify-between">
                    <span>Votre progression</span>
                    <span class="text-blue-400">42%</span>
                </h4>
                <div class="w-full bg-gray-600 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full" style="width: 42%"></div>
                </div>
                <p class="text-xs text-gray-400 mt-2">Complétez plus de cours pour débloquer des badges</p>
            </div>
        </div>
        
        <!-- Logout -->
        <div class="p-4 border-t border-gray-700 animate__animated animate__fadeIn animate__delay-3s">
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-400 hover:text-white hover:bg-gray-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Déconnexion</span>
            </a>
        </div>
    </div>

    <!-- Mobile sidebar backdrop -->
    <div id="sidebarBackdrop" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden hidden"></div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden md:ml-64">
        <!-- Navbar -->
        <header class="bg-gray-800 bg-opacity-90 backdrop-filter backdrop-blur-lg border-b border-gray-700 z-40">
            <div class="flex items-center justify-between px-6 py-3">
                <!-- Mobile menu button -->
                <button id="sidebarToggle" class="md:hidden text-gray-400 hover:text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                
                <!-- Search bar -->
                <div class="flex-1 max-w-md mx-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            class="bg-gray-700 w-full pl-10 pr-4 py-2 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            placeholder="Rechercher..."
                        >
                    </div>
                </div>
                
                <!-- Right buttons -->
                <div class="flex items-center space-x-4">
                    <button class="text-gray-400 hover:text-white relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500 notification-ping"></span>
                    </button>
                    
                    <button class="text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                    
                    <div class="relative">
                        <button id="userMenuButton" class="flex items-center space-x-2 focus:outline-none">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile" class="w-8 h-8 rounded-full border-2 border-blue-500">
                            <span class="hidden md:inline text-gray-300">Marie</span>
                        </button>
                        
                        <!-- Dropdown menu -->
                        <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-gray-800 rounded-md shadow-lg py-1 z-50 border border-gray-700">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Mon compte</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Paramètres</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Déconnexion</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-6 animate__animated animate__fadeIn animate__delay-1s">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl p-6 mb-8 card-hover">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold mb-2">Bon retour, Marie !</h1>
                        <p class="text-blue-100">Continuez votre apprentissage là où vous vous étiez arrêté</p>
                    </div>
                    <button class="mt-4 md:mt-0 bg-white text-blue-600 px-6 py-2 rounded-lg font-medium glow-on-hover btn-press">
                        Continuer
                    </button>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Course in progress -->
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 card-hover animate__animated animate__fadeInUp">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Cours en cours</p>
                            <h3 class="text-2xl font-bold mt-1">3</h3>
                        </div>
                        <div class="p-3 rounded-full bg-blue-500 bg-opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 65%"></div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">65% complété en moyenne</p>
                    </div>
                </div>
                
                <!-- Hours spent -->
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 card-hover animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Heures passées</p>
                            <h3 class="text-2xl font-bold mt-1">24h</h3>
                        </div>
                        <div class="p-3 rounded-full bg-purple-500 bg-opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 42%"></div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">+8h cette semaine</p>
                    </div>
                </div>
                
                <!-- Certificates -->
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 card-hover animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Certificats</p>
                            <h3 class="text-2xl font-bold mt-1">5</h3>
                        </div>
                        <div class="p-3 rounded-full bg-green-500 bg-opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 25%"></div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">2 nouveaux ce mois-ci</p>
                    </div>
                </div>
                
                <!-- Streak -->
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 card-hover animate__animated animate__fadeInUp animate__delay-3s">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Série actuelle</p>
                            <h3 class="text-2xl font-bold mt-1">7 jours</h3>
                        </div>
                        <div class="p-3 rounded-full bg-yellow-500 bg-opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: 70%"></div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Record: 14 jours</p>
                    </div>
                </div>
            </div>
            
            <!-- Courses in progress -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold">Vos cours en cours</h2>
                    <a href="#" class="text-blue-400 hover:text-blue-300 text-sm">Voir tout</a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Course 1 -->
                    <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg card-hover animate__animated animate__fadeIn">
                        <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="JavaScript" class="w-full h-40 object-cover">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <span class="bg-blue-900 bg-opacity-50 text-blue-400 text-xs px-2 py-1 rounded">Développement</span>
                                <div class="flex items-center text-yellow-400 text-sm">
                                    <i class="fas fa-star mr-1"></i> 4.9
                                </div>
                            </div>
                            <h3 class="text-lg font-bold mb-2">Maîtrise de JavaScript Moderne</h3>
                            <p class="text-gray-400 text-sm mb-4">Apprenez ES6+, React, Node.js et plus encore</p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-gray-400 text-sm">
                                    <i class="far fa-clock mr-2"></i> 12/32h
                                </div>
                                <div class="w-16 h-16 relative">
                                    <svg class="w-full h-full" viewBox="0 0 36 36">
                                        <circle cx="18" cy="18" r="16" fill="none" class="stroke-gray-700" stroke-width="3"></circle>
                                        <circle cx="18" cy="18" r="16" fill="none" class="stroke-blue-500 progress-ring" stroke-width="3" stroke-dasharray="100" stroke-dashoffset="40"></circle>
                                        <text x="18" y="20" class="text-sm font-bold fill-white text-center" dominant-baseline="middle" text-anchor="middle">60%</text>
                                    </svg>
                                </div>
                            </div>
                            <button class="w-full mt-4 bg-blue-600 hover:bg-blue-500 text-white py-2 rounded-lg glow-on-hover btn-press transition-all duration-300">
                                Continuer
                            </button>
                        </div>
                    </div>
                    
                    <!-- Course 2 -->
                    <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg card-hover animate__animated animate__fadeIn animate__delay-1s">
                        <img src="https://images.unsplash.com/photo-1581094794329-c811329bcea1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Data Science" class="w-full h-40 object-cover">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <span class="bg-green-900 bg-opacity-50 text-green-400 text-xs px-2 py-1 rounded">Data Science</span>
                                <div class="flex items-center text-yellow-400 text-sm">
                                    <i class="fas fa-star mr-1"></i> 4.7
                                </div>
                            </div>
                            <h3 class="text-lg font-bold mb-2">Data Science pour débutants</h3>
                            <p class="text-gray-400 text-sm mb-4">Introduction au machine learning avec Python</p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-gray-400 text-sm">
                                    <i class="far fa-clock mr-2"></i> 8/24h
                                </div>
                                <div class="w-16 h-16 relative">
                                    <svg class="w-full h-full" viewBox="0 0 36 36">
                                        <circle cx="18" cy="18" r="16" fill="none" class="stroke-gray-700" stroke-width="3"></circle>
                                        <circle cx="18" cy="18" r="16" fill="none" class="stroke-green-500 progress-ring" stroke-width="3" stroke-dasharray="100" stroke-dashoffset="65"></circle>
                                        <text x="18" y="20" class="text-sm font-bold fill-white text-center" dominant-baseline="middle" text-anchor="middle">35%</text>
                                    </svg>
                                </div>
                            </div>
                            <button class="w-full mt-4 bg-blue-600 hover:bg-blue-500 text-white py-2 rounded-lg glow-on-hover btn-press transition-all duration-300">
                                Continuer
                            </button>
                        </div>
                    </div>
                    
                    <!-- Course 3 -->
                    <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg card-hover animate__animated animate__fadeIn animate__delay-2s">
                        <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Design" class="w-full h-40 object-cover">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <span class="bg-purple-900 bg-opacity-50 text-purple-400 text-xs px-2 py-1 rounded">Design</span>
                                <div class="flex items-center text-yellow-400 text-sm">
                                    <i class="fas fa-star mr-1"></i> 4.8
                                </div>
                            </div>
                            <h3 class="text-lg font-bold mb-2">UI/UX Design Moderne</h3>
                            <p class="text-gray-400 text-sm mb-4">Créez des interfaces avec Figma</p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-gray-400 text-sm">
                                    <i class="far fa-clock mr-2"></i> 4/18h
                                </div>
                                <div class="w-16 h-16 relative">
                                    <svg class="w-full h-full" viewBox="0 0 36 36">
                                        <circle cx="18" cy="18" r="16" fill="none" class="stroke-gray-700" stroke-width="3"></circle>
                                        <circle cx="18" cy="18" r="16" fill="none" class="stroke-purple-500 progress-ring" stroke-width="3" stroke-dasharray="100" stroke-dashoffset="80"></circle>
                                        <text x="18" y="20" class="text-sm font-bold fill-white text-center" dominant-baseline="middle" text-anchor="middle">20%</text>
                                    </svg>
                                </div>
                            </div>
                            <button class="w-full mt-4 bg-blue-600 hover:bg-blue-500 text-white py-2 rounded-lg glow-on-hover btn-press transition-all duration-300">
                                Continuer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recommended Courses -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold">Recommandé pour vous</h2>
                    <a href="#" class="text-blue-400 hover:text-blue-300 text-sm">Voir tout</a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Course 1 -->
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg card-hover animate__animated animate__fadeIn">
                        <img src="https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="React" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <span class="bg-blue-900 bg-opacity-50 text-blue-400 text-xs px-2 py-1 rounded mb-2 inline-block">Développement</span>
                            <h3 class="text-md font-bold mb-2">React Avancé</h3>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-yellow-400 text-sm">
                                    <i class="fas fa-star mr-1"></i> 4.9
                                </div>
                                <span class="text-gray-400 text-sm">16h</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Course 2 -->
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg card-hover animate__animated animate__fadeIn animate__delay-1s">
                        <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Gestion de projet" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <span class="bg-yellow-900 bg-opacity-50 text-yellow-400 text-xs px-2 py-1 rounded mb-2 inline-block">Business</span>
                            <h3 class="text-md font-bold mb-2">Gestion de Projet Agile</h3>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-yellow-400 text-sm">
                                    <i class="fas fa-star mr-1"></i> 4.6
                                </div>
                                <span class="text-gray-400 text-sm">12h</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Course 3 -->
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg card-hover animate__animated animate__fadeIn animate__delay-2s">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Analyse de données" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <span class="bg-green-900 bg-opacity-50 text-green-400 text-xs px-2 py-1 rounded mb-2 inline-block">Data</span>
                            <h3 class="text-md font-bold mb-2">Analyse de Données avec Python</h3>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-yellow-400 text-sm">
                                    <i class="fas fa-star mr-1"></i> 4.7
                                </div>
                                <span class="text-gray-400 text-sm">20h</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Course 4 -->
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg card-hover animate__animated animate__fadeIn animate__delay-3s">
                        <img src="https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Photographie" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <span class="bg-pink-900 bg-opacity-50 text-pink-400 text-xs px-2 py-1 rounded mb-2 inline-block">Créatif</span>
                            <h3 class="text-md font-bold mb-2">Photographie Numérique</h3>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-yellow-400 text-sm">
                                    <i class="fas fa-star mr-1"></i> 4.8
                                </div>
                                <span class="text-gray-400 text-sm">14h</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Activity -->
            <div>
                <h2 class="text-xl font-bold mb-6">Activité récente</h2>
                
                <div class="bg-gray-800 bg-opacity-50 rounded-xl overflow-hidden">
                    <div class="divide-y divide-gray-700">
                        <!-- Activity 1 -->
                        <div class="p-4 hover:bg-gray-700 transition-colors duration-200 animate__animated animate__fadeIn">
                            <div class="flex items-start">
                                <div class="bg-blue-500 bg-opacity-20 p-2 rounded-lg mr-4">
                                    <i class="fas fa-book text-blue-400"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">
                                        <span class="font-semibold">Vous</span> avez terminé le chapitre "Composants React" dans <span class="text-blue-400">Maîtrise de JavaScript Moderne</span>
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">Il y a 2 heures</p>
                                </div>
                                <div class="w-2 h-2 rounded-full bg-blue-500 mt-1"></div>
                            </div>
                        </div>
                        
                        <!-- Activity 2 -->
                        <div class="p-4 hover:bg-gray-700 transition-colors duration-200 animate__animated animate__fadeIn animate__delay-1s">
                            <div class="flex items-start">
                                <div class="bg-green-500 bg-opacity-20 p-2 rounded-lg mr-4">
                                    <i class="fas fa-certificate text-green-400"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">
                                        <span class="font-semibold">Vous</span> avez obtenu le certificat "Bases de Python" avec une note de <span class="text-green-400">92%</span>
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">Hier à 16:42</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Activity 3 -->
                        <div class="p-4 hover:bg-gray-700 transition-colors duration-200 animate__animated animate__fadeIn animate__delay-2s">
                            <div class="flex items-start">
                                <div class="bg-purple-500 bg-opacity-20 p-2 rounded-lg mr-4">
                                    <i class="fas fa-comment-alt text-purple-400"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">
                                        <span class="font-semibold">Jean D.</span> a répondu à votre question dans <span class="text-purple-400">Data Science pour débutants</span>
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">Hier à 10:15</p>
                                </div>
                                <div class="w-2 h-2 rounded-full bg-purple-500 mt-1"></div>
                            </div>
                        </div>
                        
                        <!-- Activity 4 -->
                        <div class="p-4 hover:bg-gray-700 transition-colors duration-200 animate__animated animate__fadeIn animate__delay-3s">
                            <div class="flex items-start">
                                <div class="bg-yellow-500 bg-opacity-20 p-2 rounded-lg mr-4">
                                    <i class="fas fa-medal text-yellow-400"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">
                                        <span class="font-semibold">Félicitations !</span> Vous avez débloqué le badge "7 jours de série"
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">Avant-hier à 08:30</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 text-center border-t border-gray-700">
                        <a href="#" class="text-blue-400 hover:text-blue-300 text-sm">Voir toute l'activité</a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle sidebar on mobile
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');
            const sidebar = document.querySelector('.sidebar-bg');
            
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('hidden');
                sidebarBackdrop.classList.toggle('hidden');
            });
            
            sidebarBackdrop.addEventListener('click', function() {
                sidebar.classList.add('hidden');
                sidebarBackdrop.classList.add('hidden');
            });
            
            // Toggle user dropdown
            const userMenuButton = document.getElementById('userMenuButton');
            const userMenu = document.getElementById('userMenu');
            
            userMenuButton.addEventListener('click', function() {
                userMenu.classList.toggle('hidden');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
                    userMenu.classList.add('hidden');
                }
            });
            
            // Animate progress rings
            const progressRings = document.querySelectorAll('.progress-ring');
            progressRings.forEach(ring => {
                const circle = ring.querySelector('circle:last-child');
                const radius = circle.r.baseVal.value;
                const circumference = radius * 2 * Math.PI;
                const percent = parseInt(circle.nextElementSibling.textContent);
                const offset = circumference - (percent / 100) * circumference;
                
                circle.style.strokeDasharray = `${circumference} ${circumference}`;
                circle.style.strokeDashoffset = circumference;
                
                // Trigger animation after a delay
                setTimeout(() => {
                    circle.style.strokeDashoffset = offset;
                }, 200);
            });
            
            // Card hover animations
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 15px 25px rgba(0, 0, 0, 0.2)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                    this.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
                });
            });
            
            // Button press effect
            const buttons = document.querySelectorAll('.btn-press');
            buttons.forEach(button => {
                button.addEventListener('mousedown', function() {
                    this.style.transform = 'scale(0.98)';
                });
                
                button.addEventListener('mouseup', function() {
                    this.style.transform = '';
                });
                
                button.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                });
            });
        });
    </script>
</body>
</html>