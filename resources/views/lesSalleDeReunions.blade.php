<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salles Virtuelles - EduTech</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Styles cohérents avec le thème EduTech */
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
        .virtual-room-card {
            background: linear-gradient(135deg, rgba(45, 55, 72, 0.8) 0%, rgba(26, 32, 44, 0.9) 100%);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            overflow: hidden;
        }
        .room-number {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            text-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
        }
        .live-badge {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
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
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .meeting-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        .meeting-card:hover {
            transform: translateX(5px);
        }
        .meeting-card.javascript {
            border-left-color: #F59E0B;
        }
        .meeting-card.react {
            border-left-color: #61DAFB;
        }
        .meeting-card.python {
            border-left-color: #3776AB;
        }
        .meeting-card.web {
            border-left-color: #3B82F6;
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
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Quiz</a>
                <a href="#" class="text-blue-400 font-medium transition-colors duration-300">Salles Virtuelles</a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Profil</a>
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
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Column - Rooms List -->
            <div class="lg:w-1/3">
                <div class="virtual-room-card p-6 mb-6">
                    <h2 class="text-2xl font-bold mb-6 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Salles Virtuelles
                    </h2>
                    
                    <div class="relative mb-4">
                        <input type="text" placeholder="Rechercher une salle..." class="w-full input-field rounded-lg pl-10 pr-4 py-3 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    
                    <div class="space-y-4 max-h-96 overflow-y-auto scrollbar-thin">
                        <!-- Room 1 -->
                        <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4 card-hover">
                            <div class="flex items-start">
                                <div class="room-number text-3xl text-blue-400 mr-4">101</div>
                                <div>
                                    <h3 class="font-medium flex items-center">
                                        JavaScript Avancé
                                        <span class="ml-2 bg-red-600 text-white text-xs px-2 py-0.5 rounded-full live-badge">LIVE</span>
                                    </h3>
                                    <p class="text-sm text-gray-400 mt-1">Promesses, async/await et modules</p>
                                    <div class="flex items-center text-xs text-gray-500 mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        En cours jusqu'à 12:00
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Room 2 -->
                        <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4 card-hover">
                            <div class="flex items-start">
                                <div class="room-number text-3xl text-blue-400 mr-4">102</div>
                                <div>
                                    <h3 class="font-medium">React Masterclass</h3>
                                    <p class="text-sm text-gray-400 mt-1">Hooks avancés et performance</p>
                                    <div class="flex items-center text-xs text-gray-500 mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Démarre à 14:30
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Room 3 -->
                        <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4 card-hover">
                            <div class="flex items-start">
                                <div class="room-number text-3xl text-blue-400 mr-4">103</div>
                                <div>
                                    <h3 class="font-medium">Python pour la Data Science</h3>
                                    <p class="text-sm text-gray-400 mt-1">Pandas et NumPy avancés</p>
                                    <div class="flex items-center text-xs text-gray-500 mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Demain 09:00
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Room 4 -->
                        <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4 card-hover">
                            <div class="flex items-start">
                                <div class="room-number text-3xl text-blue-400 mr-4">104</div>
                                <div>
                                    <h3 class="font-medium">Développement Web Moderne</h3>
                                    <p class="text-sm text-gray-400 mt-1">HTML5, CSS3 et JavaScript ES6+</p>
                                    <div class="flex items-center text-xs text-gray-500 mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Tous les jours 16:00
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Room 5 -->
                        <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4 card-hover">
                            <div class="flex items-start">
                                <div class="room-number text-3xl text-blue-400 mr-4">105</div>
                                <div>
                                    <h3 class="font-medium">Session de Mentorat</h3>
                                    <p class="text-sm text-gray-400 mt-1">Questions/Réponses avec experts</p>
                                    <div class="flex items-center text-xs text-gray-500 mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Vendredi 18:00
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="virtual-room-card p-6">
                    <h2 class="text-xl font-bold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Mes prochaines sessions
                    </h2>
                    
                    <div class="space-y-3">
                        <div class="meeting-card react bg-gray-700 bg-opacity-50 rounded-lg p-3">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="font-medium">React Masterclass</h3>
                                    <p class="text-xs text-gray-400">Salle 102</p>
                                </div>
                                <div class="text-sm text-blue-400">14:30 - 16:00</div>
                            </div>
                        </div>
                        
                        <div class="meeting-card python bg-gray-700 bg-opacity-50 rounded-lg p-3">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="font-medium">Python Data Science</h3>
                                    <p class="text-xs text-gray-400">Salle 103</p>
                                </div>
                                <div class="text-sm text-blue-400">Demain 09:00</div>
                            </div>
                        </div>
                        
                        <div class="meeting-card web bg-gray-700 bg-opacity-50 rounded-lg p-3">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="font-medium">Développement Web</h3>
                                    <p class="text-xs text-gray-400">Salle 104</p>
                                </div>
                                <div class="text-sm text-blue-400">Mercredi 16:00</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Selected Room -->
            <div class="lg:w-2/3">
                <div class="virtual-room-card h-full p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-2xl font-bold flex items-center">
                                <span class="room-number text-4xl text-blue-400 mr-3">101</span>
                                <span>JavaScript Avancé</span>
                                <span class="ml-3 bg-red-600 text-white text-sm px-2 py-0.5 rounded-full live-badge">LIVE</span>
                            </h2>
                            <p class="text-gray-400">Promesses, async/await et modules ES6</p>
                        </div>
                        <button class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-3 rounded-lg glow-on-hover btn-press transition-all duration-300 flex items-center animate-pulse">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            Rejoindre
                        </button>
                    </div>
                    
                    <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4 mb-6">
                        <div class="flex items-center mb-4">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Instructor" class="w-12 h-12 rounded-full border-2 border-blue-500 mr-3">
                            <div>
                                <h3 class="font-medium">Professeur: Jean Dupont</h3>
                                <p class="text-sm text-gray-400">Expert JavaScript - 10 ans d'expérience</p>
                            </div>
                        </div>
                        <p class="text-gray-300 mb-4">
                            Cette session couvrira les concepts avancés de JavaScript, y compris les promesses, async/await, 
                            les modules ES6 et les meilleures pratiques pour écrire du code maintenable.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-blue-900 bg-opacity-50 text-blue-400 text-xs px-2 py-1 rounded">JavaScript</span>
                            <span class="bg-yellow-900 bg-opacity-50 text-yellow-400 text-xs px-2 py-1 rounded">ES6</span>
                            <span class="bg-purple-900 bg-opacity-50 text-purple-400 text-xs px-2 py-1 rounded">Asynchrone</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4">
                            <h3 class="font-medium mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Horaires
                            </h3>
                            <ul class="space-y-2 text-sm">
                                <li class="flex justify-between">
                                    <span class="text-gray-400">Aujourd'hui</span>
                                    <span>10:00 - 12:00</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-400">Mercredi</span>
                                    <span>10:00 - 12:00</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-400">Vendredi</span>
                                    <span>10:00 - 12:00</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4">
                            <h3 class="font-medium mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Programme
                            </h3>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Promesses et callbacks</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Async/Await</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Modules ES6 (à venir)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4">
                        <h3 class="font-medium mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Participants (24)
                        </h3>
                        <div class="flex flex-wrap gap-3">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Participant" class="w-10 h-10 rounded-full border-2 border-blue-500">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Participant" class="w-10 h-10 rounded-full border-2 border-blue-500">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Participant" class="w-10 h-10 rounded-full border-2 border-blue-500">
                            <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Participant" class="w-10 h-10 rounded-full border-2 border-blue-500">
                            <div class="w-10 h-10 rounded-full bg-gray-600 border-2 border-dashed border-gray-500 flex items-center justify-center text-xs">
                                +20
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 bg-opacity-90 backdrop-filter backdrop-blur-lg py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-4 md:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                    <span class="text-xl font-bold text-gradient">EduTech</span>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Confidentialité</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Conditions</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Contact</a>
                </div>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-6 pt-6 text-center text-gray-500 text-sm">
                <p>© 2024 EduTech. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Animation for room cards
        document.querySelectorAll('.card-hover').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.querySelector('.room-number').classList.add('animate__animated', 'animate__pulse');
            });
            
            card.addEventListener('mouseleave', function() {
                this.querySelector('.room-number').classList.remove('animate__animated', 'animate__pulse');
            });
        });

        // Simulate room selection
        document.querySelectorAll('.bg-gray-700.bg-opacity-50.rounded-lg').forEach(room => {
            room.addEventListener('click', function() {
                // Remove all selected states
                document.querySelectorAll('.bg-gray-700.bg-opacity-50.rounded-lg').forEach(r => {
                    r.classList.remove('ring-2', 'ring-blue-500');
                });
                
                // Add selected state to clicked room
                this.classList.add('ring-2', 'ring-blue-500');
                
                // In a real app, you would load the room details here
            });
        });
    </script>
</body>
</html>