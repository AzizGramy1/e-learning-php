<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur - EduTech</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Styles cohérents avec la page de certificats */
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
        .profile-header {
            background: linear-gradient(135deg, rgba(26, 32, 44, 0.8) 0%, rgba(45, 55, 72, 0.9) 100%);
            backdrop-filter: blur(10px);
        }
        .progress-ring {
            transition: stroke-dashoffset 0.5s ease;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .skill-badge {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .skill-badge:hover {
            transform: translateY(-3px) scale(1.05);
        }
        .tab-active {
            position: relative;
            color: #3B82F6;
        }
        .tab-active::after {
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
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Conférences</a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Certificats</a>
                <a href="#" class="text-blue-400 font-medium transition-colors duration-300">Profil</a>
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

    <!-- Profile Header -->
    <div class="profile-header border-b border-gray-700">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="relative mb-6 md:mb-0 md:mr-8">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile" class="w-32 h-32 rounded-full border-4 border-blue-500 shadow-lg animate-float">
                    <div class="absolute bottom-0 right-0 bg-blue-600 rounded-full p-2 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
                <div class="text-center md:text-left">
                    <h1 class="text-3xl font-bold mb-1">Marie Dubois</h1>
                    <p class="text-xl text-blue-400 mb-3">Développeuse Full Stack</p>
                    <div class="flex flex-wrap justify-center md:justify-start gap-2 mb-4">
                        <span class="bg-blue-900 bg-opacity-50 text-blue-400 text-xs px-3 py-1 rounded-full">Paris, France</span>
                        <span class="bg-purple-900 bg-opacity-50 text-purple-400 text-xs px-3 py-1 rounded-full">Membre depuis 2022</span>
                        <span class="bg-green-900 bg-opacity-50 text-green-400 text-xs px-3 py-1 rounded-full">Niveau Expert</span>
                    </div>
                    <div class="flex space-x-4 justify-center md:justify-start">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">
                            <i class="fas fa-globe text-xl"></i>
                        </a>
                    </div>
                </div>
                <div class="mt-6 md:mt-0 md:ml-auto">
                    <button class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-3 rounded-lg glow-on-hover btn-press transition-all duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Modifier le profil
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Tabs Navigation -->
        <div class="border-b border-gray-700 mb-8">
            <nav class="flex space-x-8">
                <button class="tab-active py-4 px-1 font-medium text-sm focus:outline-none">
                    Aperçu
                </button>
                <button class="text-gray-400 hover:text-white py-4 px-1 font-medium text-sm focus:outline-none">
                    Certificats
                </button>
                <button class="text-gray-400 hover:text-white py-4 px-1 font-medium text-sm focus:outline-none">
                    Cours
                </button>
                <button class="text-gray-400 hover:text-white py-4 px-1 font-medium text-sm focus:outline-none">
                    Projets
                </button>
                <button class="text-gray-400 hover:text-white py-4 px-1 font-medium text-sm focus:outline-none">
                    Paramètres
                </button>
            </nav>
        </div>

        <!-- Profile Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Progress Card -->
            <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 card-hover">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold">Progression globale</h3>
                    <span class="text-blue-400 text-sm font-medium">78%</span>
                </div>
                <div class="relative w-full h-2 bg-gray-700 rounded-full mb-6">
                    <div class="absolute top-0 left-0 h-2 bg-gradient-to-r from-blue-500 to-blue-300 rounded-full" style="width: 78%"></div>
                </div>
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div>
                        <p class="text-gray-400 text-sm">Cours</p>
                        <p class="text-xl font-bold">12</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Heures</p>
                        <p class="text-xl font-bold">156</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Certificats</p>
                        <p class="text-xl font-bold">7</p>
                    </div>
                </div>
            </div>

            <!-- Skills Card -->
            <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 card-hover">
                <h3 class="text-lg font-bold mb-6">Compétences</h3>
                <div class="flex flex-wrap gap-2">
                    <span class="skill-badge bg-blue-900 bg-opacity-50 text-blue-400 px-3 py-1 rounded-full text-sm">JavaScript</span>
                    <span class="skill-badge bg-green-900 bg-opacity-50 text-green-400 px-3 py-1 rounded-full text-sm">React</span>
                    <span class="skill-badge bg-purple-900 bg-opacity-50 text-purple-400 px-3 py-1 rounded-full text-sm">Node.js</span>
                    <span class="skill-badge bg-red-900 bg-opacity-50 text-red-400 px-3 py-1 rounded-full text-sm">Python</span>
                    <span class="skill-badge bg-yellow-900 bg-opacity-50 text-yellow-400 px-3 py-1 rounded-full text-sm">UI/UX</span>
                    <span class="skill-badge bg-indigo-900 bg-opacity-50 text-indigo-400 px-3 py-1 rounded-full text-sm">MongoDB</span>
                    <span class="skill-badge bg-pink-900 bg-opacity-50 text-pink-400 px-3 py-1 rounded-full text-sm">GraphQL</span>
                </div>
                <div class="mt-6">
                    <button class="w-full bg-gray-700 hover:bg-gray-600 text-white py-2 rounded-lg glow-on-hover btn-press transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Ajouter des compétences
                    </button>
                </div>
            </div>

            <!-- Badges Card -->
            <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 card-hover">
                <h3 class="text-lg font-bold mb-6">Badges</h3>
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div class="p-3">
                        <div class="bg-gradient-to-br from-yellow-500 to-yellow-300 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <p class="text-xs text-gray-400">Élève modèle</p>
                    </div>
                    <div class="p-3">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-300 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <p class="text-xs text-gray-400">Top 5%</p>
                    </div>
                    <div class="p-3">
                        <div class="bg-gradient-to-br from-purple-500 to-purple-300 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <p class="text-xs text-gray-400">Expert</p>
                    </div>
                </div>
                <button class="w-full mt-4 bg-gray-700 hover:bg-gray-600 text-white py-2 rounded-lg glow-on-hover btn-press transition-all duration-300">
                    Voir tous les badges
                </button>
            </div>
        </div>

        <!-- Two Columns Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- About Card -->
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 card-hover">
                    <h3 class="text-lg font-bold mb-4">À propos</h3>
                    <p class="text-gray-400 mb-4">
                        Développeuse full stack passionnée avec plus de 5 ans d'expérience dans la création d'applications web modernes. 
                        Spécialisée en JavaScript et ses frameworks, j'aime partager mes connaissances et apprendre de nouvelles technologies.
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-500 text-sm">Email</p>
                            <p class="text-blue-400">marie.dubois@example.com</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Téléphone</p>
                            <p class="text-blue-400">+33 6 12 34 56 78</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Date de naissance</p>
                            <p class="text-blue-400">15 mars 1992</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Langues</p>
                            <p class="text-blue-400">Français, Anglais, Espagnol</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 card-hover">
                    <h3 class="text-lg font-bold mb-4">Activité récente</h3>
                    <div class="space-y-4">
                        <!-- Activity 1 -->
                        <div class="flex items-start">
                            <div class="bg-blue-900 bg-opacity-50 text-blue-400 p-2 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">A obtenu un certificat <span class="text-blue-400">Maîtrise de JavaScript</span></p>
                                <p class="text-gray-500 text-sm">15 juin 2024 - Note: 92%</p>
                            </div>
                        </div>
                        <!-- Activity 2 -->
                        <div class="flex items-start">
                            <div class="bg-green-900 bg-opacity-50 text-green-400 p-2 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">A commencé un nouveau cours <span class="text-green-400">React Avancé</span></p>
                                <p class="text-gray-500 text-sm">10 juin 2024 - Progression: 35%</p>
                            </div>
                        </div>
                        <!-- Activity 3 -->
                        <div class="flex items-start">
                            <div class="bg-purple-900 bg-opacity-50 text-purple-400 p-2 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">A commenté le cours <span class="text-purple-400">Node.js Fondamentaux</span></p>
                                <p class="text-gray-500 text-sm">5 juin 2024 - "Excellent contenu!"</p>
                            </div>
                        </div>
                    </div>
                    <button class="w-full mt-4 bg-gray-700 hover:bg-gray-600 text-white py-2 rounded-lg glow-on-hover btn-press transition-all duration-300">
                        Voir toute l'activité
                    </button>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Education Card -->
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 card-hover">
                    <h3 class="text-lg font-bold mb-4">Formation</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between">
                                <p class="font-medium">Master en Informatique</p>
                                <span class="bg-blue-900 bg-opacity-50 text-blue-400 text-xs px-2 py-1 rounded">2015</span>
                            </div>
                            <p class="text-gray-400">Université Paris-Saclay</p>
                        </div>
                        <div>
                            <div class="flex justify-between">
                                <p class="font-medium">Licence en Mathématiques</p>
                                <span class="bg-blue-900 bg-opacity-50 text-blue-400 text-xs px-2 py-1 rounded">2013</span>
                            </div>
                            <p class="text-gray-400">Université Paris-Diderot</p>
                        </div>
                    </div>
                </div>

                <!-- Experience Card -->
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 card-hover">
                    <h3 class="text-lg font-bold mb-4">Expérience</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between">
                                <p class="font-medium">Développeuse Full Stack</p>
                                <span class="bg-blue-900 bg-opacity-50 text-blue-400 text-xs px-2 py-1 rounded">2019-Présent</span>
                            </div>
                            <p class="text-gray-400">TechSolutions Inc.</p>
                        </div>
                        <div>
                            <div class="flex justify-between">
                                <p class="font-medium">Développeuse Frontend</p>
                                <span class="bg-blue-900 bg-opacity-50 text-blue-400 text-xs px-2 py-1 rounded">2016-2019</span>
                            </div>
                            <p class="text-gray-400">WebCraft Studio</p>
                        </div>
                    </div>
                </div>

                <!-- Goals Card -->
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 card-hover">
                    <h3 class="text-lg font-bold mb-4">Objectifs</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium">Certification AWS</span>
                                <span class="text-sm text-blue-400">65%</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 65%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium">Niveau Expert React</span>
                                <span class="text-sm text-green-400">42%</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: 42%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium">1000 heures d'apprentissage</span>
                                <span class="text-sm text-purple-400">15%</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-purple-600 h-2 rounded-full" style="width: 15%"></div>
                            </div>
                        </div>
                    </div>
                    <button class="w-full mt-4 bg-blue-600 hover:bg-blue-500 text-white py-2 rounded-lg glow-on-hover btn-press transition-all duration-300">
                        Définir de nouveaux objectifs
                    </button>
                </div>
            </div>
        </div>
    </main>

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
        // Animation for skill badges
        document.querySelectorAll('.skill-badge').forEach(badge => {
            badge.addEventListener('mouseenter', function() {
                this.classList.add('shadow-md');
            });
            badge.addEventListener('mouseleave', function() {
                this.classList.remove('shadow-md');
            });
        });

        // Tab switching functionality
        const tabs = document.querySelectorAll('nav button');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                tabs.forEach(t => t.classList.remove('tab-active', 'text-blue-400'));
                tabs.forEach(t => t.classList.add('text-gray-400', 'hover:text-white'));
                this.classList.add('tab-active', 'text-blue-400');
                this.classList.remove('text-gray-400', 'hover:text-white');
            });
        });
    </script>
</body>
</html>