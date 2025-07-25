<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Communité - EduTech</title>
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
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .animate-pulse {
            animation: pulse 2s infinite;
        }
        .discussion-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .discussion-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .category-tag {
            transition: all 0.3s ease;
        }
        .category-tag:hover {
            transform: scale(1.05);
        }
        .active-tab {
            position: relative;
            color: #3B82F6;
        }
        .active-tab::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #3B82F6, #10B981);
            border-radius: 3px;
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
        .reply-box {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        .reply-box.open {
            max-height: 300px;
            transition: max-height 0.5s ease-in;
        }
        .vote-button {
            transition: all 0.2s ease;
        }
        .vote-button:hover {
            transform: scale(1.1);
        }
        .vote-button:active {
            transform: scale(0.95);
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
                <a href="#" class="text-blue-400 font-medium transition-colors duration-300">Communauté</a>
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

    <!-- Forum Header -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold mb-2">Communauté</h1>
                <p class="text-xl text-gray-400">Échangez, posez des questions et partagez vos connaissances</p>
            </div>
            <button class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-3 rounded-lg glow-on-hover btn-press transition-all duration-300 flex items-center animate-pulse">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Nouvelle discussion
            </button>
        </div>
    </div>

    <!-- Forum Content -->
    <div class="container mx-auto px-4 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Left Sidebar -->
            <div class="lg:col-span-1">
                <!-- Categories -->
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 sticky top-24 card-hover">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Catégories
                    </h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="flex items-center justify-between py-2 px-3 rounded-lg bg-blue-900 bg-opacity-50 text-blue-400">
                                <span>Toutes les discussions</span>
                                <span class="bg-blue-800 text-white text-xs px-2 py-1 rounded-full">128</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-300">
                                <span>JavaScript</span>
                                <span class="bg-gray-700 text-gray-400 text-xs px-2 py-1 rounded-full">42</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-300">
                                <span>React</span>
                                <span class="bg-gray-700 text-gray-400 text-xs px-2 py-1 rounded-full">28</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-300">
                                <span>Python</span>
                                <span class="bg-gray-700 text-gray-400 text-xs px-2 py-1 rounded-full">19</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-300">
                                <span>Développement Web</span>
                                <span class="bg-gray-700 text-gray-400 text-xs px-2 py-1 rounded-full">15</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-300">
                                <span>Data Science</span>
                                <span class="bg-gray-700 text-gray-400 text-xs px-2 py-1 rounded-full">12</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-300">
                                <span>Cybersécurité</span>
                                <span class="bg-gray-700 text-gray-400 text-xs px-2 py-1 rounded-full">8</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Trending Topics -->
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 mt-6 card-hover">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        Sujets tendance
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="flex items-start hover:text-blue-400 transition-colors duration-300">
                                <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded-full mr-3 mt-1">1</span>
                                <div>
                                    <p class="font-medium">Nouveautés React 18</p>
                                    <p class="text-gray-500 text-sm">15 discussions</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-start hover:text-blue-400 transition-colors duration-300">
                                <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded-full mr-3 mt-1">2</span>
                                <div>
                                    <p class="font-medium">Transition vers TypeScript</p>
                                    <p class="text-gray-500 text-sm">12 discussions</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-start hover:text-blue-400 transition-colors duration-300">
                                <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded-full mr-3 mt-1">3</span>
                                <div>
                                    <p class="font-medium">Meilleures pratiques API REST</p>
                                    <p class="text-gray-500 text-sm">9 discussions</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-start hover:text-blue-400 transition-colors duration-300">
                                <span class="bg-gray-700 text-gray-400 text-xs px-2 py-1 rounded-full mr-3 mt-1">4</span>
                                <div>
                                    <p class="font-medium">Tests unitaires en JavaScript</p>
                                    <p class="text-gray-500 text-sm">7 discussions</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-start hover:text-blue-400 transition-colors duration-300">
                                <span class="bg-gray-700 text-gray-400 text-xs px-2 py-1 rounded-full mr-3 mt-1">5</span>
                                <div>
                                    <p class="font-medium">Optimisation des performances</p>
                                    <p class="text-gray-500 text-sm">6 discussions</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Community Stats -->
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 mt-6 card-hover">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Statistiques
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Membres</span>
                            <span class="font-bold">4,821</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Discussions</span>
                            <span class="font-bold">1,245</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Réponses</span>
                            <span class="font-bold">5,673</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">En ligne</span>
                            <span class="font-bold text-green-400">243</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Tabs -->
                <div class="bg-gray-800 bg-opacity-50 rounded-xl overflow-hidden mb-6">
                    <div class="border-b border-gray-700">
                        <nav class="flex -mb-px">
                            <button class="active-tab py-4 px-6 font-medium text-sm focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                Récentes
                            </button>
                            <button class="text-gray-400 hover:text-white py-4 px-6 font-medium text-sm focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                Populaires
                            </button>
                            <button class="text-gray-400 hover:text-white py-4 px-6 font-medium text-sm focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Non résolues
                            </button>
                            <button class="text-gray-400 hover:text-white py-4 px-6 font-medium text-sm focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Suivies
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Search and Filter -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <div class="relative w-full md:w-64 mb-4 md:mb-0">
                        <input type="text" placeholder="Rechercher..." class="w-full bg-gray-700 bg-opacity-50 border border-gray-600 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <div class="flex space-x-2">
                        <button class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg glow-on-hover btn-press transition-all duration-300 text-sm flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filtres
                        </button>
                        <button class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg glow-on-hover btn-press transition-all duration-300 text-sm flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                            </svg>
                            Trier
                        </button>
                    </div>
                </div>

                <!-- Discussions List -->
                <div class="space-y-4">
                    <!-- Discussion 1 -->
                    <div class="discussion-card bg-gray-800 bg-opacity-50 rounded-xl p-6">
                        <div class="flex items-start">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="w-10 h-10 rounded-full mr-4 mt-1 border-2 border-blue-500">
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-bold text-lg hover:text-blue-400 transition-colors duration-300 cursor-pointer">Problème avec useState et les tableaux</h3>
                                        <div class="flex items-center text-sm text-gray-400 mt-1">
                                            <span>Par <a href="#" class="text-blue-400 hover:underline">Jean Dupont</a></span>
                                            <span class="mx-2">•</span>
                                            <span>il y a 2 heures</span>
                                            <span class="mx-2">•</span>
                                            <span class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                </svg>
                                                8 réponses
                                            </span>
                                        </div>
                                    </div>
                                    <span class="category-tag bg-blue-900 bg-opacity-50 text-blue-400 text-xs px-3 py-1 rounded-full">React</span>
                                </div>
                                <p class="text-gray-400 mb-4">Je rencontre un problème étrange lorsque j'essaie de mettre à jour un tableau avec useState. Lorsque j'ajoute un nouvel élément, seul le dernier élément ajouté s'affiche...</p>
                                <div class="flex justify-between items-center">
                                    <div class="flex space-x-3">
                                        <button class="vote-button flex items-center text-gray-400 hover:text-green-400 transition-colors duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                            </svg>
                                            <span class="ml-1">12</span>
                                        </button>
                                        <button class="vote-button flex items-center text-gray-400 hover:text-red-400 transition-colors duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.017a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                            </svg>
                                            <span class="ml-1">2</span>
                                        </button>
                                        <button class="flex items-center text-gray-400 hover:text-blue-400 transition-colors duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                            <span class="ml-1">Répondre</span>
                                        </button>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>124 vues</span>
                                    </div>
                                </div>

                                <!-- Reply Box (hidden by default) -->
                                <div class="reply-box mt-4 bg-gray-700 rounded-lg overflow-hidden">
                                    <textarea class="w-full bg-gray-800 border border-gray-600 rounded-t-lg p-4 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500" rows="3" placeholder="Votre réponse..."></textarea>
                                    <div class="bg-gray-800 px-4 py-3 flex justify-end">
                                        <button class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg mr-2">
                                            Annuler
                                        </button>
                                        <button class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg">
                                            Publier
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Discussion 2 -->
                    <div class="discussion-card bg-gray-800 bg-opacity-50 rounded-xl p-6">
                        <div class="flex items-start">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="User" class="w-10 h-10 rounded-full mr-4 mt-1 border-2 border-purple-500">
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-bold text-lg hover:text-blue-400 transition-colors duration-300 cursor-pointer">Meilleure façon de structurer un projet React en 2024</h3>
                                        <div class="flex items-center text-sm text-gray-400 mt-1">
                                            <span>Par <a href="#" class="text-purple-400 hover:underline">Sophie Martin</a></span>
                                            <span class="mx-2">•</span>
                                            <span>il y a 5 heures</span>
                                            <span class="mx-2">•</span>
                                            <span class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                </svg>
                                                14 réponses
                                            </span>
                                        </div>
                                    </div>
                                    <span class="category-tag bg-purple-900 bg-opacity-50 text-purple-400 text-xs px-3 py-1 rounded-full">React</span>
                                </div>
                                <p class="text-gray-400 mb-4">Avec toutes les nouvelles fonctionnalités et outils disponibles, quelle est selon vous la meilleure façon de structurer un projet React moderne en 2024? Je cherche des bonnes pratiques...</p>
                                <div class="flex justify-between items-center">
                                    <div class="flex space-x-3">
                                        <button class="vote-button flex items-center text-gray-400 hover:text-green-400 transition-colors duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                            </svg>
                                            <span class="ml-1">24</span>
                                        </button>
                                        <button class="vote-button flex items-center text-gray-400 hover:text-red-400 transition-colors duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.017a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                            </svg>
                                            <span class="ml-1">3</span>
                                        </button>
                                        <button class="flex items-center text-gray-400 hover:text-blue-400 transition-colors duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                            <span class="ml-1">Répondre</span>
                                        </button>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>312 vues</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Discussion 3 -->
                    <div class="discussion-card bg-gray-800 bg-opacity-50 rounded-xl p-6">
                        <div class="flex items-start">
                            <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="User" class="w-10 h-10 rounded-full mr-4 mt-1 border-2 border-green-500">
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-bold text-lg hover:text-blue-400 transition-colors duration-300 cursor-pointer">[Résolu] Problème d'authentification avec Firebase</h3>
                                        <div class="flex items-center text-sm text-gray-400 mt-1">
                                            <span>Par <a href="#" class="text-green-400 hover:underline">Thomas Leroy</a></span>
                                            <span class="mx-2">•</span>
                                            <span>il y a 1 jour</span>
                                            <span class="mx-2">•</span>
                                            <span class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                </svg>
                                                5 réponses
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="category-tag bg-green-900 bg-opacity-50 text-green-400 text-xs px-3 py-1 rounded-full mr-2">Firebase</span>
                                        <span class="bg-blue-900 bg-opacity-50 text-blue-400 text-xs px-2 py-1 rounded-full">Résolu</span>
                                    </div>
                                </div>
                                <p class="text-gray-400 mb-4">J'ai finalement trouvé la solution à mon problème d'authentification avec Firebase. Je partage ici la solution pour ceux qui pourraient rencontrer le même problème...</p>
                                <div class="flex justify-between items-center">
                                    <div class="flex space-x-3">
                                        <button class="vote-button flex items-center text-gray-400 hover:text-green-400 transition-colors duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                            </svg>
                                            <span class="ml-1">8</span>
                                        </button>
                                        <button class="vote-button flex items-center text-gray-400 hover:text-red-400 transition-colors duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.017a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                            </svg>
                                            <span class="ml-1">0</span>
                                        </button>
                                        <button class="flex items-center text-gray-400 hover:text-blue-400 transition-colors duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                            <span class="ml-1">Répondre</span>
                                        </button>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>87 vues</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Discussion 4 -->
                    <div class="discussion-card bg-gray-800 bg-opacity-50 rounded-xl p-6">
                        <div class="flex items-start">
                            <img src="https://randomuser.me/api/portraits/women/42.jpg" alt="User" class="w-10 h-10 rounded-full mr-4 mt-1 border-2 border-yellow-500">
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-bold text-lg hover:text-blue-400 transition-colors duration-300 cursor-pointer">Comparaison : Next.js vs Remix en 2024</h3>
                                        <div class="flex items-center text-sm text-gray-400 mt-1">
                                            <span>Par <a href="#" class="text-yellow-400 hover:underline">Emma Laurent</a></span>
                                            <span class="mx-2">•</span>
                                            <span>il y a 2 jours</span>
                                            <span class="mx-2">•</span>
                                            <span class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                </svg>
                                                23 réponses
                                            </span>
                                        </div>
                                    </div>
                                    <span class="category-tag bg-yellow-900 bg-opacity-50 text-yellow-400 text-xs px-3 py-1 rounded-full">Framework</span>
                                </div>
                                <p class="text-gray-400 mb-4">Je dois choisir entre Next.js et Remix pour un nouveau projet. Quels sont selon vous les avantages et inconvénients de chaque framework en 2024? J'ai besoin d'avis d'experts...</p>
                                <div class="flex justify-between items-center">
                                    <div class="flex space-x-3">
                                        <button class="vote-button flex items-center text-gray-400 hover:text-green-400 transition-colors duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                            </svg>
                                            <span class="ml-1">17</span>
                                        </button>
                                        <button class="vote-button flex items-center text-gray-400 hover:text-red-400 transition-colors duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.017a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                            </svg>
                                            <span class="ml-1">2</span>
                                        </button>
                                        <button class="flex items-center text-gray-400 hover:text-blue-400 transition-colors duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                            <span class="ml-1">Répondre</span>
                                        </button>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>421 vues</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex justify-center items-center space-x-2 mt-8">
                    <button class="w-10 h-10 rounded-full bg-gray-700 hover:bg-gray-600 text-white flex items-center justify-center btn-press">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center btn-press">1</button>
                    <button class="w-10 h-10 rounded-full bg-gray-700 hover:bg-gray-600 text-white flex items-center justify-center btn-press">2</button>
                    <button class="w-10 h-10 rounded-full bg-gray-700 hover:bg-gray-600 text-white flex items-center justify-center btn-press">3</button>
                    <button class="w-10 h-10 rounded-full bg-gray-700 hover:bg-gray-600 text-white flex items-center justify-center btn-press">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
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
        // Toggle reply box
        document.querySelectorAll('[class*="flex items-center text-gray-400 hover:text-blue-400"]').forEach(button => {
            button.addEventListener('click', function() {
                const replyBox = this.closest('.discussion-card').querySelector('.reply-box');
                replyBox.classList.toggle('open');
            });
        });

        // Tab switching functionality
        const tabs = document.querySelectorAll('nav button');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                tabs.forEach(t => t.classList.remove('active-tab', 'text-blue-400'));
                tabs.forEach(t => t.classList.add('text-gray-400', 'hover:text-white'));
                this.classList.add('active-tab', 'text-blue-400');
                this.classList.remove('text-gray-400', 'hover:text-white');
            });
        });

        // Category tag animation
        document.querySelectorAll('.category-tag').forEach(tag => {
            tag.addEventListener('mouseenter', function() {
                this.classList.add('animate__animated', 'animate__pulse');
            });
            tag.addEventListener('mouseleave', function() {
                this.classList.remove('animate__animated', 'animate__pulse');
            });
        });

        // Vote button animation
        document.querySelectorAll('.vote-button').forEach(button => {
            button.addEventListener('click', function() {
                this.classList.add('animate__animated', 'animate__rubberBand');
                setTimeout(() => {
                    this.classList.remove('animate__animated', 'animate__rubberBand');
                }, 1000);
            });
        });
    </script>
</body>
</html>