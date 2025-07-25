<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vidéoconférences - EduTech</title>
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
            70% { box-shadow: 0 0 0 15px rgba(59, 130, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        .live-indicator {
            animation: pulse 1.5s infinite;
        }
        @keyframes ripple {
            0% { transform: scale(0.8); opacity: 1; }
            100% { transform: scale(2.5); opacity: 0; }
        }
        .ripple {
            position: relative;
            overflow: hidden;
        }
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple 1s linear;
            pointer-events: none;
        }
        .video-placeholder {
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
        }
        .participant-hover:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            z-index: 10;
        }
        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background-color: rgba(156, 163, 175, 0.5);
            border-radius: 3px;
        }
        .scrollbar-thin::-webkit-scrollbar-track {
            background-color: rgba(31, 41, 55, 0.3);
        }
    </style>
</head>
<body class="gradient-bg text-gray-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-gray-800 bg-opacity-90 backdrop-filter backdrop-blur-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                </svg>
                <span class="text-2xl font-bold text-gradient">EduTech</span>
            </div>
            <div class="hidden md:flex space-x-6">
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Accueil</a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Cours</a>
                <a href="#" class="text-blue-400 font-medium transition-colors duration-300">Conférences</a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Discussions</a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Ressources</a>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button id="userMenuButton" class="flex items-center space-x-2 focus:outline-none">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile" class="w-8 h-8 rounded-full border-2 border-blue-500">
                        <span class="hidden md:inline text-gray-300">Marie</span>
                    </button>
                </div>
                <button class="md:hidden text-gray-300 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold mb-2">Vidéoconférences</h1>
                <p class="text-xl text-gray-400">Rejoignez des sessions en direct ou planifiez de nouvelles réunions</p>
            </div>
            <button class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-3 rounded-lg glow-on-hover btn-press transition-all duration-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                Nouvelle conférence
            </button>
        </div>
        
        <!-- Live Conferences -->
        <section class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold flex items-center">
                    <span class="live-indicator w-3 h-3 bg-red-500 rounded-full mr-3"></span>
                    En direct maintenant
                </h2>
                <a href="#" class="text-blue-400 hover:text-blue-300 text-sm">Voir tout</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Conference 1 -->
                <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg card-hover animate__animated animate__fadeIn">
                    <div class="relative">
                        <div class="video-placeholder w-full h-48 flex items-center justify-center">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-gray-400">Session en cours</p>
                            </div>
                        </div>
                        <div class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold flex items-center">
                            <span class="live-indicator w-2 h-2 bg-white rounded-full mr-2"></span>
                            LIVE
                        </div>
                        <div class="absolute top-4 right-4 bg-gray-900 bg-opacity-70 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            24 participants
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold mb-1">React Avancé - Session Q&A</h3>
                            <div class="flex items-center text-yellow-400 text-sm">
                                <i class="fas fa-star mr-1"></i> 4.8
                            </div>
                        </div>
                        <p class="text-gray-400 text-sm mb-4">Session de questions-réponses avec l'expert React Jean Martin</p>
                        <div class="flex items-center text-sm text-gray-400 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Commencée il y a 25 min · Fin dans 35 min
                        </div>
                        <button class="w-full bg-red-600 hover:bg-red-500 text-white py-2 rounded-lg glow-on-hover btn-press transition-all duration-300 ripple">
                            Rejoindre maintenant
                        </button>
                    </div>
                </div>
                
                <!-- Conference 2 -->
                <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg card-hover animate__animated animate__fadeIn animate__delay-1s">
                    <div class="relative">
                        <div class="video-placeholder w-full h-48 flex items-center justify-center">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-gray-400">Session en cours</p>
                            </div>
                        </div>
                        <div class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold flex items-center">
                            <span class="live-indicator w-2 h-2 bg-white rounded-full mr-2"></span>
                            LIVE
                        </div>
                        <div class="absolute top-4 right-4 bg-gray-900 bg-opacity-70 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            15 participants
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold mb-1">Atelier Data Science</h3>
                            <div class="flex items-center text-yellow-400 text-sm">
                                <i class="fas fa-star mr-1"></i> 4.6
                            </div>
                        </div>
                        <p class="text-gray-400 text-sm mb-4">Analyse de données en temps réel avec Python</p>
                        <div class="flex items-center text-sm text-gray-400 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Commencée il y a 10 min · Fin dans 50 min
                        </div>
                        <button class="w-full bg-red-600 hover:bg-red-500 text-white py-2 rounded-lg glow-on-hover btn-press transition-all duration-300 ripple">
                            Rejoindre maintenant
                        </button>
                    </div>
                </div>
                
                <!-- Conference 3 -->
                <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg card-hover animate__animated animate__fadeIn animate__delay-2s">
                    <div class="relative">
                        <div class="video-placeholder w-full h-48 flex items-center justify-center">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-gray-400">Session en cours</p>
                            </div>
                        </div>
                        <div class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold flex items-center">
                            <span class="live-indicator w-2 h-2 bg-white rounded-full mr-2"></span>
                            LIVE
                        </div>
                        <div class="absolute top-4 right-4 bg-gray-900 bg-opacity-70 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            8 participants
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold mb-1">Mentorat UI/UX</h3>
                            <div class="flex items-center text-yellow-400 text-sm">
                                <i class="fas fa-star mr-1"></i> 4.9
                            </div>
                        </div>
                        <p class="text-gray-400 text-sm mb-4">Revue de portfolio avec Sophie Lambert</p>
                        <div class="flex items-center text-sm text-gray-400 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Commencée il y a 5 min · Fin dans 55 min
                        </div>
                        <button class="w-full bg-red-600 hover:bg-red-500 text-white py-2 rounded-lg glow-on-hover btn-press transition-all duration-300 ripple">
                            Rejoindre maintenant
                        </button>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Upcoming Conferences -->
        <section class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">À venir</h2>
                <a href="#" class="text-blue-400 hover:text-blue-300 text-sm">Voir tout</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Conference 4 -->
                <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg card-hover animate__animated animate__fadeIn">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="UI/UX Design" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4 bg-gray-900 bg-opacity-70 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            12 inscrits
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold mb-1">Atelier Figma</h3>
                            <div class="flex items-center text-yellow-400 text-sm">
                                <i class="fas fa-star mr-1"></i> 4.7
                            </div>
                        </div>
                        <p class="text-gray-400 text-sm mb-4">Maîtrisez les composants et prototypes avancés</p>
                        <div class="flex items-center text-sm text-gray-400 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Demain, 14h00 - 16h00
                        </div>
                        <button class="w-full bg-blue-600 hover:bg-blue-500 text-white py-2 rounded-lg glow-on-hover btn-press transition-all duration-300">
                            S'inscrire
                        </button>
                    </div>
                </div>
                
                <!-- Conference 5 -->
                <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg card-hover animate__animated animate__fadeIn animate__delay-1s">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1581094794329-c811329bcea1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Data Science" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4 bg-gray-900 bg-opacity-70 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            18 inscrits
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold mb-1">Machine Learning</h3>
                            <div class="flex items-center text-yellow-400 text-sm">
                                <i class="fas fa-star mr-1"></i> 4.8
                            </div>
                        </div>
                        <p class="text-gray-400 text-sm mb-4">Introduction aux réseaux de neurones</p>
                        <div class="flex items-center text-sm text-gray-400 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Jeu. 20 juil., 10h00 - 12h00
                        </div>
                        <button class="w-full bg-blue-600 hover:bg-blue-500 text-white py-2 rounded-lg glow-on-hover btn-press transition-all duration-300">
                            S'inscrire
                        </button>
                    </div>
                </div>
                
                <!-- Conference 6 -->
                <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg card-hover animate__animated animate__fadeIn animate__delay-2s">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="JavaScript" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4 bg-gray-900 bg-opacity-70 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            32 inscrits
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold mb-1">React Native</h3>
                            <div class="flex items-center text-yellow-400 text-sm">
                                <i class="fas fa-star mr-1"></i> 4.9
                            </div>
                        </div>
                        <p class="text-gray-400 text-sm mb-4">Créer des applications mobiles cross-platform</p>
                        <div class="flex items-center text-sm text-gray-400 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Ven. 21 juil., 16h00 - 18h00
                        </div>
                        <button class="w-full bg-blue-600 hover:bg-blue-500 text-white py-2 rounded-lg glow-on-hover btn-press transition-all duration-300">
                            S'inscrire
                        </button>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Past Conferences -->
        <section>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">Sessions passées</h2>
                <a href="#" class="text-blue-400 hover:text-blue-300 text-sm">Voir tout</a>
            </div>
            
            <div class="bg-gray-800 bg-opacity-50 rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Titre</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Participants</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Durée</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            <!-- Past 1 -->
                            <tr class="hover:bg-gray-700 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-blue-500 rounded-full flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium">Introduction à React</div>
                                            <div class="text-sm text-gray-400">Jean Martin</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">12 juil. 2024</div>
                                    <div class="text-sm text-gray-400">14h00 - 16h00</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">28</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">2h 05min</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <button class="text-blue-400 hover:text-blue-300 mr-4">Revoir</button>
                                    <button class="text-blue-400 hover:text-blue-300">Ressources</button>
                                </td>
                            </tr>
                            
                            <!-- Past 2 -->
                            <tr class="hover:bg-gray-700 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-purple-500 rounded-full flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium">UI/UX Avancé</div>
                                            <div class="text-sm text-gray-400">Sophie Lambert</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">8 juil. 2024</div>
                                    <div class="text-sm text-gray-400">10h00 - 12h00</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">19</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">1h 52min</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <button class="text-blue-400 hover:text-blue-300 mr-4">Revoir</button>
                                    <button class="text-blue-400 hover:text-blue-300">Ressources</button>
                                </td>
                            </tr>
                            
                            <!-- Past 3 -->
                            <tr class="hover:bg-gray-700 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-green-500 rounded-full flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium">Python pour Data Science</div>
                                            <div class="text-sm text-gray-400">Thomas Leroy</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">5 juil. 2024</div>
                                    <div class="text-sm text-gray-400">16h00 - 18h00</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">24</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">2h 12min</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <button class="text-blue-400 hover:text-blue-300 mr-4">Revoir</button>
                                    <button class="text-blue-400 hover:text-blue-300">Ressources</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <!-- Video Conference Modal -->
    <div id="conferenceModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-900 bg-opacity-75"></div>
            </div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div class="inline-block align-bottom bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg leading-6 font-medium text-white" id="modal-title">
                                    Rejoindre la conférence
                                </h3>
                                <button id="closeModal" class="text-gray-400 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            
                            <div class="mt-4">
                                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                    <!-- Video Preview -->
                                    <div class="lg:col-span-2 bg-gray-900 rounded-lg overflow-hidden">
                                        <div class="video-placeholder w-full h-64 flex items-center justify-center">
                                            <div class="text-center">
                                                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <p class="text-gray-400">Préparation de la conférence</p>
                                            </div>
                                        </div>
                                        <div class="p-4">
                                            <h4 class="font-bold text-lg mb-2" id="conferenceTitle">React Avancé - Session Q&A</h4>
                                            <p class="text-gray-400 text-sm" id="conferenceDescription">Session de questions-réponses avec l'expert React Jean Martin</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Join Options -->
                                    <div class="bg-gray-700 rounded-lg p-4">
                                        <h4 class="font-bold mb-4">Options de connexion</h4>
                                        
                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-300 mb-2">Votre nom</label>
                                            <input type="text" class="bg-gray-800 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="Marie Dupont">
                                        </div>
                                        
                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-300 mb-2">Audio</label>
                                            <select class="bg-gray-800 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                <option>Microphone intégré</option>
                                                <option>Casque USB</option>
                                                <option>Désactivé</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-300 mb-2">Vidéo</label>
                                            <select class="bg-gray-800 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                <option>Caméra intégrée</option>
                                                <option>Caméra USB</option>
                                                <option>Désactivé</option>
                                            </select>
                                        </div>
                                        
                                        <button class="w-full bg-blue-600 hover:bg-blue-500 text-white py-3 rounded-lg glow-on-hover btn-press transition-all duration-300 ripple flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                            Rejoindre maintenant
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ripple effect for buttons
            const buttons = document.querySelectorAll('.ripple');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const ripple = document.createElement('span');
                    ripple.className = 'ripple-effect';
                    ripple.style.left = `${x}px`;
                    ripple.style.top = `${y}px`;
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 1000);
                });
            });
            
            // Conference modal
            const modal = document.getElementById('conferenceModal');
            const closeModal = document.getElementById('closeModal');
            const joinButtons = document.querySelectorAll('[class*="bg-red-600"]');
            
            joinButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const card = this.closest('.bg-gray-800');
                    const title = card.querySelector('h3').textContent;
                    const description = card.querySelector('p.text-gray-400').textContent;
                    
                    document.getElementById('conferenceTitle').textContent = title;
                    document.getElementById('conferenceDescription').textContent = description;
                    
                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                });
            });
            
            closeModal.addEventListener('click', function() {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });
            
            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
            
            // Simulate live participant count updates
            setInterval(() => {
                const liveCounts = document.querySelectorAll('[class*="bg-gray-900"][class*="text-white"]');
                liveCounts.forEach(count => {
                    const current = parseInt(count.textContent.split(' ')[0]);
                    const change = Math.floor(Math.random() * 3) - 1; // -1, 0, or 1
                    const newCount = Math.max(1, current + change);
                    count.textContent = `${newCount} participants`;
                });
            }, 5000);
        });
    </script>
</body>
</html>