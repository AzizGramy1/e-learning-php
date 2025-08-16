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
        /* (Conserver les styles CSS existants) */
        /* ... */
    </style>
</head>
<body class="gradient-bg text-gray-100 min-h-screen flex overflow-hidden">
    <!-- (Conserver la sidebar existante) -->
    <!-- ... -->

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden md:ml-64">
        <!-- (Conserver la navbar existante) -->
        <!-- ... -->

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
            
            <!-- Réunions en cours -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold">Vos réunions en cours</h2>
                    <a href="#" class="text-blue-400 hover:text-blue-300 text-sm">Voir tout</a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Réunion 1 -->
                    <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg card-hover animate__animated animate__fadeIn">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <span class="bg-indigo-900 bg-opacity-50 text-indigo-400 text-xs px-2 py-1 rounded">Live</span>
                                <div class="flex items-center text-sm text-green-400">
                                    <span class="h-2 w-2 rounded-full bg-green-400 mr-2 animate-pulse"></span>
                                    En cours
                                </div>
                            </div>
                            <h3 class="text-lg font-bold mb-2">Atelier JavaScript Avancé</h3>
                            <p class="text-gray-400 text-sm mb-4">Session pratique sur les closures et promises</p>
                            
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="flex -space-x-2">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Professeur" class="w-8 h-8 rounded-full border-2 border-indigo-500">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Vous" class="w-8 h-8 rounded-full border-2 border-green-500">
                                    <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Participant" class="w-8 h-8 rounded-full border-2 border-gray-600">
                                </div>
                                <span class="text-xs text-gray-400">+12 participants</span>
                            </div>
                            
                            <div class="flex justify-between items-center text-sm mb-4">
                                <div class="flex items-center text-gray-400">
                                    <i class="far fa-clock mr-2"></i>
                                    14:00 - 15:30
                                </div>
                                <div class="text-gray-400">
                                    <i class="fas fa-users mr-1"></i> 15/25
                                </div>
                            </div>
                            
                            <button class="w-full bg-indigo-600 hover:bg-indigo-500 text-white py-2 rounded-lg glow-on-hover btn-press transition-all duration-300 flex items-center justify-center">
                                <i class="fas fa-video mr-2"></i> Rejoindre maintenant
                            </button>
                        </div>
                    </div>
                    
                    <!-- Réunion 2 -->
                    <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg card-hover animate__animated animate__fadeIn animate__delay-1s">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <span class="bg-purple-900 bg-opacity-50 text-purple-400 text-xs px-2 py-1 rounded">Q&A</span>
                                <div class="flex items-center text-sm text-yellow-400">
                                    <i class="far fa-clock mr-1"></i>
                                    Dans 30 min
                                </div>
                            </div>
                            <h3 class="text-lg font-bold mb-2">Questions/Réponses Data Science</h3>
                            <p class="text-gray-400 text-sm mb-4">Session de questions avec l'expert Pierre Martin</p>
                            
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="flex -space-x-2">
                                    <img src="https://randomuser.me/api/portraits/men/65.jpg" alt="Professeur" class="w-8 h-8 rounded-full border-2 border-purple-500">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Vous" class="w-8 h-8 rounded-full border-2 border-green-500">
                                </div>
                                <span class="text-xs text-gray-400">+8 participants</span>
                            </div>
                            
                            <div class="flex justify-between items-center text-sm mb-4">
                                <div class="flex items-center text-gray-400">
                                    <i class="far fa-clock mr-2"></i>
                                    15:30 - 16:30
                                </div>
                                <div class="text-gray-400">
                                    <i class="fas fa-users mr-1"></i> 9/15
                                </div>
                            </div>
                            
                            <button class="w-full bg-purple-600 hover:bg-purple-500 text-white py-2 rounded-lg glow-on-hover btn-press transition-all duration-300 flex items-center justify-center">
                                <i class="fas fa-calendar-plus mr-2"></i> Programmer un rappel
                            </button>
                        </div>
                    </div>
                    
                    <!-- Réunion 3 -->
                    <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg card-hover animate__animated animate__fadeIn animate__delay-2s">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <span class="bg-blue-900 bg-opacity-50 text-blue-400 text-xs px-2 py-1 rounded">Tutoriel</span>
                                <div class="flex items-center text-sm text-gray-400">
                                    <i class="far fa-calendar mr-1"></i>
                                    Demain
                                </div>
                            </div>
                            <h3 class="text-lg font-bold mb-2">Introduction à React Hooks</h3>
                            <p class="text-gray-400 text-sm mb-4">Découvrez les hooks avec des exemples pratiques</p>
                            
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="flex -space-x-2">
                                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Professeur" class="w-8 h-8 rounded-full border-2 border-blue-500">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Vous" class="w-8 h-8 rounded-full border-2 border-green-500">
                                </div>
                                <span class="text-xs text-gray-400">+5 participants</span>
                            </div>
                            
                            <div class="flex justify-between items-center text-sm mb-4">
                                <div class="flex items-center text-gray-400">
                                    <i class="far fa-clock mr-2"></i>
                                    10:00 - 11:30
                                </div>
                                <div class="text-gray-400">
                                    <i class="fas fa-users mr-1"></i> 3/10
                                </div>
                            </div>
                            
                            <button class="w-full bg-blue-600 hover:bg-blue-500 text-white py-2 rounded-lg glow-on-hover btn-press transition-all duration-300 flex items-center justify-center">
                                <i class="fas fa-calendar-check mr-2"></i> S'inscrire
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- (Conserver les sections existantes) -->
            <!-- Stats Cards -->
            <!-- ... -->
            
            <!-- Courses in progress -->
            <!-- ... -->
            
            <!-- Recommended Courses -->
            <!-- ... -->
            
            <!-- Recent Activity -->
            <!-- ... -->
        </main>
    </div>

    <script>
        // (Conserver le JavaScript existant)
        // ...
    </script>
</body>
</html>