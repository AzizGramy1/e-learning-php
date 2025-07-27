<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning - Plateforme d'Apprentissage</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        /* Custom animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        .glow-on-hover {
            transition: all 0.3s ease;
        }
        .glow-on-hover:hover {
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.7);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        .btn-press {
            transition: all 0.2s ease;
        }
        .btn-press:active {
            transform: scale(0.95);
        }
        .menu-item {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            perspective: 1000px;
        }
        .menu-item:hover {
            transform: translateY(-8px) rotateX(10deg);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        }
        .menu-item:active {
            transform: translateY(-2px) scale(0.98);
        }
        .floating {
            animation: floating 6s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(59, 130, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }
        .gradient-bg {
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
        }
        .text-gradient {
            background: linear-gradient(90deg, #3B82F6, #10B981);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
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
                <span class="text-2xl font-bold text-gradient">E-Learning</span>
            </div>
            <div class="hidden md:flex space-x-6">
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Accueil</a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Cours</a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Formateurs</a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">À propos</a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Contact</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('loginBackend') }}">
            <button class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg glow-on-hover btn-press transition-all duration-300">
                Connexion
            </button>
</a>
                <button class="md:hidden text-gray-300 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative overflow-hidden">
        <div class="container mx-auto px-4 py-20 md:py-32 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-12 md:mb-0 animate__animated animate__fadeInLeft">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                    Apprenez sans limites avec 
                    <span class="text-gradient">EduTech</span>
                </h1>
                <p class="text-xl text-gray-300 mb-8">
                    Accédez à des centaines de cours en ligne dispensés par les meilleurs experts dans leur domaine.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <button class="bg-blue-600 hover:bg-blue-500 text-white px-8 py-4 rounded-lg glow-on-hover btn-press transition-all duration-300 transform hover:scale-105">
                        Commencer maintenant
                    </button>
                    <button class="bg-gray-700 hover:bg-gray-600 text-white px-8 py-4 rounded-lg btn-press transition-all duration-300 transform hover:scale-105">
                        Explorer les cours
                    </button>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center animate__animated animate__fadeInRight">
                <img src="https://st2.depositphotos.com/1720162/10275/v/950/depositphotos_102750706-stock-illustration-flat-line-design-website-banner.jpg" alt="Online Learning" class="w-full max-w-md floating">
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-900 to-transparent"></div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-16">
        <!-- Features Section -->
        <section class="mb-20">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Pourquoi choisir EduTech ?</h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Une plateforme d'apprentissage conçue pour vous offrir la meilleure expérience éducative en ligne.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-8 card-hover border border-gray-700 transform transition-all duration-500 hover:border-blue-500">
                    <div class="bg-blue-500 rounded-full w-16 h-16 flex items-center justify-center mb-6 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-center">Contenu de qualité</h3>
                    <p class="text-gray-400 text-center">
                        Des cours créés et vérifiés par des experts pour garantir un apprentissage de haut niveau.
                    </p>
                </div>
                
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-8 card-hover border border-gray-700 transform transition-all duration-500 hover:border-green-500">
                    <div class="bg-green-500 rounded-full w-16 h-16 flex items-center justify-center mb-6 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-center">Apprentissage flexible</h3>
                    <p class="text-gray-400 text-center">
                        Apprenez à votre rythme, quand vous voulez et où vous voulez, sur tous vos appareils.
                    </p>
                </div>
                
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-8 card-hover border border-gray-700 transform transition-all duration-500 hover:border-purple-500">
                    <div class="bg-purple-500 rounded-full w-16 h-16 flex items-center justify-center mb-6 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-center">Certifications reconnues</h3>
                    <p class="text-gray-400 text-center">
                        Obtenez des certificats qui valoriseront votre CV et vos compétences professionnelles.
                    </p>
                </div>
            </div>
        </section>

        <!-- Menu Grid Section -->
        <section class="mb-20">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Explorez nos ressources</h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Accédez à tous nos outils et ressources pédagogiques en un clic.
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Menu Item 1 -->
                <div class="menu-item bg-gray-800 rounded-xl p-6 shadow-lg cursor-pointer" onclick="animateAndNavigate(this, '#')">
                    <div class="flex items-start">
                        <div class="bg-blue-500 bg-opacity-20 p-3 rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2">Tous les cours</h3>
                            <p class="text-gray-400">Explorez notre catalogue complet de cours dans tous les domaines.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Menu Item 2 -->
                <div class="menu-item bg-gray-800 rounded-xl p-6 shadow-lg cursor-pointer" onclick="animateAndNavigate(this, '#')">
                    <div class="flex items-start">
                        <div class="bg-green-500 bg-opacity-20 p-3 rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2">Bibliothèque</h3>
                            <p class="text-gray-400">Accédez à des ressources supplémentaires et documents pédagogiques.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Menu Item 3 -->
                <div class="menu-item bg-gray-800 rounded-xl p-6 shadow-lg cursor-pointer" onclick="animateAndNavigate(this, '#')">
                    <div class="flex items-start">
                        <div class="bg-purple-500 bg-opacity-20 p-3 rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2">Mes certifications</h3>
                            <p class="text-gray-400">Consultez et téléchargez vos certifications obtenues.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Menu Item 4 -->
                <div class="menu-item bg-gray-800 rounded-xl p-6 shadow-lg cursor-pointer" onclick="animateAndNavigate(this, '#')">
                    <div class="flex items-start">
                        <div class="bg-yellow-500 bg-opacity-20 p-3 rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2">Progression</h3>
                            <p class="text-gray-400">Suivez votre avancement dans les différents cours.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Menu Item 5 -->
                <div class="menu-item bg-gray-800 rounded-xl p-6 shadow-lg cursor-pointer" onclick="animateAndNavigate(this, '#')">
                    <div class="flex items-start">
                        <div class="bg-red-500 bg-opacity-20 p-3 rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2">Forum</h3>
                            <p class="text-gray-400">Échangez avec la communauté et posez vos questions.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Menu Item 6 -->
                <div class="menu-item bg-gray-800 rounded-xl p-6 shadow-lg cursor-pointer" onclick="animateAndNavigate(this, '#')">
                    <div class="flex items-start">
                        <div class="bg-pink-500 bg-opacity-20 p-3 rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2">Mon compte</h3>
                            <p class="text-gray-400">Gérez vos informations personnelles et paramètres.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Popular Courses -->
        <section class="mb-20">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Cours populaires</h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Découvrez les cours les plus appréciés par notre communauté.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Course 1 -->
                <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg card-hover">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Programmation" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4 bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Nouveau
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <span class="bg-blue-900 bg-opacity-50 text-blue-400 text-xs px-2 py-1 rounded">Développement</span>
                            <div class="flex items-center text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="ml-1 text-gray-300">4.9</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Maîtrise de JavaScript Moderne</h3>
                        <p class="text-gray-400 mb-4">Apprenez ES6+, React, Node.js et bien plus encore dans ce cours complet.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="ml-2 text-sm text-gray-400">32 heures</span>
                            </div>
                            <button class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg glow-on-hover btn-press transition-all duration-300">
                                Voir le cours
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Course 2 -->
                <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg card-hover">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1581094794329-c811329bcea1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Data Science" class="w-full h-48 object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <span class="bg-green-900 bg-opacity-50 text-green-400 text-xs px-2 py-1 rounded">Data Science</span>
                            <div class="flex items-center text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="ml-1 text-gray-300">4.7</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Data Science pour débutants</h3>
                        <p class="text-gray-400 mb-4">Introduction au machine learning et à l'analyse de données avec Python.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="ml-2 text-sm text-gray-400">24 heures</span>
                            </div>
                            <button class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg glow-on-hover btn-press transition-all duration-300">
                                Voir le cours
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Course 3 -->
                <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg card-hover">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Design" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4 bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Populaire
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <span class="bg-purple-900 bg-opacity-50 text-purple-400 text-xs px-2 py-1 rounded">Design</span>
                            <div class="flex items-center text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="ml-1 text-gray-300">4.8</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">UI/UX Design Moderne</h3>
                        <p class="text-gray-400 mb-4">Créez des interfaces utilisateur intuitives et esthétiques avec Figma.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="ml-2 text-sm text-gray-400">18 heures</span>
                            </div>
                            <button class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg glow-on-hover btn-press transition-all duration-300">
                                Voir le cours
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <button class="bg-gray-700 hover:bg-gray-600 text-white px-8 py-3 rounded-lg glow-on-hover btn-press transition-all duration-300 transform hover:scale-105">
                    Voir tous les cours
                </button>
            </div>
        </section>
    </main>

    <!-- CTA Section -->
    <section class="bg-gray-800 py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Prêt à commencer votre voyage d'apprentissage ?</h2>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto mb-8">
                Rejoignez des milliers d'apprenants et développez vos compétences dès aujourd'hui.
            </p>
            <button class="bg-blue-600 hover:bg-blue-500 text-white px-8 py-4 rounded-lg glow-on-hover btn-press transition-all duration-300 transform hover:scale-105 pulse">
                S'inscrire gratuitement
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path d="M12 14l6.16-3.422a
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                        </svg>
                        <span class="text-2xl font-bold text-gradient">EduTech</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">
                        Plateforme d'apprentissage en ligne pour les talents de demain
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Navigation</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Accueil</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Cours</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Formateurs</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">À propos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Légal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Conditions d'utilisation</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Politique de confidentialité</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Mentions légales</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="text-gray-400">contact@edutech.com</li>
                        <li class="text-gray-400">+33 1 23 45 67 89</li>
                        <li class="text-gray-400">12 Rue de l'Innovation<br>75000 Paris</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 mt-8 text-center">
                <p class="text-gray-400 text-sm">
                    © 2024 EduTech. Tous droits réservés. 
                    <span class="block sm:inline mt-2 sm:mt-0">Développé avec ❤️ par l'équipe EduTech</span>
                </p>
            </div>
        </div>
    </footer>

    <script>
        function animateAndNavigate(element, url) {
            element.style.transform = 'scale(0.95)';
            setTimeout(() => {
                element.style.transform = '';
                window.location.href = url;
            }, 200);
        }
    </script>
</body>
</html>