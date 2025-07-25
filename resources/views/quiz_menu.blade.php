<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - EduTech</title>
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
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-bounce {
            animation: bounce 1s infinite;
        }
        .quiz-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            perspective: 1000px;
        }
        .quiz-card:hover {
            transform: translateY(-5px) rotateX(5deg);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }
        .difficulty-badge {
            transition: all 0.3s ease;
        }
        .difficulty-badge:hover {
            transform: scale(1.1);
        }
        .category-filter {
            transition: all 0.3s ease;
        }
        .category-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
        .marquee {
            animation: marquee 15s linear infinite;
        }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
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
                <a href="#" class="text-blue-400 font-medium transition-colors duration-300">Quiz</a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Certificats</a>
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

    <!-- Hero Section -->
    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-8 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Testez vos connaissances</h1>
                <p class="text-xl text-gray-400 mb-6">Découvrez nos quiz interactifs pour évaluer et renforcer vos compétences en programmation et technologies web.</p>
                <div class="flex space-x-4">
                    <button class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-3 rounded-lg glow-on-hover btn-press transition-all duration-300 flex items-center animate-pulse">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        Quiz populaires
                    </button>
                    <button class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg glow-on-hover btn-press transition-all duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Tous les quiz
                    </button>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <div class="relative w-64 h-64 md:w-80 md:h-80">
                    <div class="absolute inset-0 bg-blue-500 rounded-full opacity-20 blur-xl animate-pulse"></div>
                    <img src="https://cdn-icons-png.flaticon.com/512/3652/3652191.png" alt="Quiz Illustration" class="relative z-10 w-full h-full object-contain animate-float">
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
            </svg>
            Catégories
        </h2>
        <div class="flex overflow-x-auto pb-4 scrollbar-thin">
            <div class="flex space-x-4">
                <!-- All Categories -->
                <button class="category-filter bg-blue-600 text-white px-6 py-2 rounded-full whitespace-nowrap flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Toutes
                </button>
                <!-- Programming -->
                <button class="category-filter bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-full whitespace-nowrap flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                    Programmation
                </button>
                <!-- Web Dev -->
                <button class="category-filter bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-full whitespace-nowrap flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                    </svg>
                    Développement Web
                </button>
                <!-- Data Science -->
                <button class="category-filter bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-full whitespace-nowrap flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Data Science
                </button>
                <!-- Mobile -->
                <button class="category-filter bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-full whitespace-nowrap flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    Mobile
                </button>
                <!-- Cybersecurity -->
                <button class="category-filter bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-full whitespace-nowrap flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Cybersécurité
                </button>
            </div>
        </div>
    </div>

    <!-- Popular Quizzes -->
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
            Quiz populaires
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Quiz 1 -->
            <div class="quiz-card bg-gray-800 bg-opacity-50 rounded-xl overflow-hidden relative">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-blue-900 bg-opacity-50 text-blue-400 text-xs px-2 py-1 rounded">JavaScript</span>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <span class="text-sm">4.8</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Maîtrise de JavaScript</h3>
                    <p class="text-gray-400 text-sm mb-4">Testez vos connaissances avancées en JavaScript avec ce quiz complet.</p>
                    <div class="flex justify-between items-center text-sm text-gray-400 mb-6">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>15 min</span>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>5.2k</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="difficulty-badge bg-yellow-900 bg-opacity-50 text-yellow-400 text-xs px-3 py-1 rounded-full">Moyen</span>
                        <button class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg glow-on-hover btn-press transition-all duration-300 text-sm">
                            Commencer
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Quiz 2 -->
            <div class="quiz-card bg-gray-800 bg-opacity-50 rounded-xl overflow-hidden relative">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-purple-900 bg-opacity-50 text-purple-400 text-xs px-2 py-1 rounded">React</span>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <span class="text-sm">4.9</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">React Avancé</h3>
                    <p class="text-gray-400 text-sm mb-4">Découvrez si vous maîtrisez les concepts avancés de React.</p>
                    <div class="flex justify-between items-center text-sm text-gray-400 mb-6">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>20 min</span>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>3.8k</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="difficulty-badge bg-red-900 bg-opacity-50 text-red-400 text-xs px-3 py-1 rounded-full">Difficile</span>
                        <button class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg glow-on-hover btn-press transition-all duration-300 text-sm">
                            Commencer
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Quiz 3 -->
            <div class="quiz-card bg-gray-800 bg-opacity-50 rounded-xl overflow-hidden relative">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-green-900 bg-opacity-50 text-green-400 text-xs px-2 py-1 rounded">Python</span>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <span class="text-sm">4.7</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Python pour débutants</h3>
                    <p class="text-gray-400 text-sm mb-4">Apprenez les bases de Python avec ce quiz interactif.</p>
                    <div class="flex justify-between items-center text-sm text-gray-400 mb-6">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>10 min</span>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>7.1k</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="difficulty-badge bg-green-900 bg-opacity-50 text-green-400 text-xs px-3 py-1 rounded-full">Facile</span>
                        <button class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg glow-on-hover btn-press transition-all duration-300 text-sm">
                            Commencer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Quizzes -->
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
            Nouveaux quiz
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Quiz 4 -->
            <div class="quiz-card bg-gray-800 bg-opacity-50 rounded-xl overflow-hidden relative">
                <div class="absolute top-4 right-4 bg-blue-600 text-white text-xs px-2 py-1 rounded-full animate-bounce">Nouveau</div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-indigo-900 bg-opacity-50 text-indigo-400 text-xs px-2 py-1 rounded">TypeScript</span>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <span class="text-sm">4.6</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">TypeScript Fondamentaux</h3>
                    <p class="text-gray-400 text-sm mb-4">Maîtrisez les bases de TypeScript avec ce nouveau quiz.</p>
                    <div class="flex justify-between items-center text-sm text-gray-400 mb-6">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>12 min</span>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>1.2k</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="difficulty-badge bg-yellow-900 bg-opacity-50 text-yellow-400 text-xs px-3 py-1 rounded-full">Moyen</span>
                        <button class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg glow-on-hover btn-press transition-all duration-300 text-sm">
                            Commencer
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Quiz 5 -->
            <div class="quiz-card bg-gray-800 bg-opacity-50 rounded-xl overflow-hidden relative">
                <div class="absolute top-4 right-4 bg-blue-600 text-white text-xs px-2 py-1 rounded-full animate-bounce">Nouveau</div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-red-900 bg-opacity-50 text-red-400 text-xs px-2 py-1 rounded">Cybersécurité</span>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <span class="text-sm">4.8</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Sécurité des applications web</h3>
                    <p class="text-gray-400 text-sm mb-4">Testez vos connaissances sur les vulnérabilités courantes.</p>
                    <div class="flex justify-between items-center text-sm text-gray-400 mb-6">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>18 min</span>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>2.5k</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="difficulty-badge bg-red-900 bg-opacity-50 text-red-400 text-xs px-3 py-1 rounded-full">Difficile</span>
                        <button class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg glow-on-hover btn-press transition-all duration-300 text-sm">
                            Commencer
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Quiz 6 -->
            <div class="quiz-card bg-gray-800 bg-opacity-50 rounded-xl overflow-hidden relative">
                <div class="absolute top-4 right-4 bg-blue-600 text-white text-xs px-2 py-1 rounded-full animate-bounce">Nouveau</div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-pink-900 bg-opacity-50 text-pink-400 text-xs px-2 py-1 rounded">UI/UX</span>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <span class="text-sm">4.5</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Design d'interface moderne</h3>
                    <p class="text-gray-400 text-sm mb-4">Évaluez vos connaissances en design UI/UX.</p>
                    <div class="flex justify-between items-center text-sm text-gray-400 mb-6">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>15 min</span>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>1.8k</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="difficulty-badge bg-yellow-900 bg-opacity-50 text-yellow-400 text-xs px-3 py-1 rounded-full">Moyen</span>
                        <button class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg glow-on-hover btn-press transition-all duration-300 text-sm">
                            Commencer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Quiz -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-gradient-to-r from-blue-800 to-purple-800 rounded-xl overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 p-8 md:p-12">
                    <div class="flex items-center mb-4">
                        <span class="bg-white bg-opacity-20 text-white text-xs px-3 py-1 rounded-full mr-2">Featured</span>
                        <span class="bg-white bg-opacity-20 text-white text-xs px-3 py-1 rounded-full">Expert</span>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Quiz Ultime Full Stack</h2>
                    <p class="text-blue-100 mb-6">Testez vos connaissances complètes en développement web avec ce quiz ultime couvrant frontend, backend et bases de données.</p>
                    <div class="flex flex-wrap gap-3 mb-6">
                        <span class="bg-white bg-opacity-10 text-white text-xs px-3 py-1 rounded-full">JavaScript</span>
                        <span class="bg-white bg-opacity-10 text-white text-xs px-3 py-1 rounded-full">Node.js</span>
                        <span class="bg-white bg-opacity-10 text-white text-xs px-3 py-1 rounded-full">React</span>
                        <span class="bg-white bg-opacity-10 text-white text-xs px-3 py-1 rounded-full">MongoDB</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="bg-white hover:bg-gray-100 text-blue-600 px-6 py-3 rounded-lg glow-on-hover btn-press transition-all duration-300 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15.536a5 5 0 001.414 1.414m2.828-9.9a9 9 0 012.728-2.728" />
                            </svg>
                            Démarrer le défi
                        </button>
                        <div class="flex items-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>30 min</span>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 hidden md:flex items-center justify-center p-8">
                    <img src="https://cdn-icons-png.flaticon.com/512/2933/2933245.png" alt="Featured Quiz" class="w-64 h-64 object-contain animate-float">
                </div>
            </div>
        </div>
    </div>

    <!-- Trending Topics -->
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
            Tendances
        </h2>
        <div class="bg-gray-800 bg-opacity-50 rounded-xl p-4 overflow-hidden">
            <div class="whitespace-nowrap overflow-hidden">
                <div class="inline-block whitespace-nowrap marquee">
                    <span class="text-lg font-medium mx-4">#JavaScript</span>
                    <span class="text-lg font-medium mx-4">#React2024</span>
                    <span class="text-lg font-medium mx-4">#Web3</span>
                    <span class="text-lg font-medium mx-4">#TypeScript</span>
                    <span class="text-lg font-medium mx-4">#AIProgramming</span>
                    <span class="text-lg font-medium mx-4">#CloudComputing</span>
                    <span class="text-lg font-medium mx-4">#Cybersécurité</span>
                    <span class="text-lg font-medium mx-4">#UXDesign</span>
                    <span class="text-lg font-medium mx-4">#DevOps</span>
                    <span class="text-lg font-medium mx-4">#Python</span>
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
        // Animation for quiz cards
        document.querySelectorAll('.quiz-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.querySelector('.difficulty-badge').classList.add('animate__animated', 'animate__pulse');
            });
            
            card.addEventListener('mouseleave', function() {
                this.querySelector('.difficulty-badge').classList.remove('animate__animated', 'animate__pulse');
            });
        });

        // Category filter selection
        const categoryFilters = document.querySelectorAll('.category-filter');
        categoryFilters.forEach(filter => {
            filter.addEventListener('click', function() {
                categoryFilters.forEach(f => f.classList.remove('bg-blue-600', 'text-white'));
                categoryFilters.forEach(f => f.classList.add('bg-gray-700', 'hover:bg-gray-600', 'text-white'));
                this.classList.add('bg-blue-600', 'text-white');
                this.classList.remove('bg-gray-700', 'hover:bg-gray-600');
            });
        });

        // Marquee effect for trending topics
        const marquee = document.querySelector('.marquee');
        const marqueeContent = marquee.innerHTML;
        marquee.innerHTML = marqueeContent + marqueeContent; // Duplicate content for seamless loop
    </script>
</body>
</html>