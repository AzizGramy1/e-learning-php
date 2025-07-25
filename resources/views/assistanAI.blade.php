<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistant AI - EduTech</title>
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
        .ai-assistant-card {
            background: linear-gradient(135deg, rgba(45, 55, 72, 0.8) 0%, rgba(26, 32, 44, 0.9) 100%);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            overflow: hidden;
        }
        .message-user {
            background: rgba(59, 130, 246, 0.15);
            border-left: 3px solid #3B82F6;
        }
        .message-ai {
            background: rgba(31, 41, 55, 0.5);
            border-left: 3px solid #10B981;
        }
        .typing-indicator span {
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #9CA3AF;
            border-radius: 50%;
            margin-right: 4px;
            animation: typing 1.4s infinite ease-in-out;
        }
        .typing-indicator span:nth-child(2) {
            animation-delay: 0.2s;
        }
        .typing-indicator span:nth-child(3) {
            animation-delay: 0.4s;
        }
        @keyframes typing {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-5px); }
        }
        .ai-avatar {
            background: linear-gradient(135deg, #3B82F6 0%, #10B981 100%);
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
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
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
                <a href="#" class="text-blue-400 font-medium transition-colors duration-300">Assistant AI</a>
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
            <!-- Left Column - Assistant Info -->
            <div class="lg:w-1/3">
                <div class="ai-assistant-card p-6 mb-6">
                    <div class="flex flex-col items-center text-center mb-6">
                        <div class="ai-avatar w-24 h-24 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold mb-2">Assistant EduTech AI</h2>
                        <p class="text-gray-400 mb-4">Votre compagnon d'apprentissage intelligent</p>
                        <div class="flex space-x-2">
                            <span class="bg-blue-900 bg-opacity-50 text-blue-400 text-xs px-3 py-1 rounded-full">Disponible 24/7</span>
                            <span class="bg-green-900 bg-opacity-50 text-green-400 text-xs px-3 py-1 rounded-full">GPT-4</span>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="font-medium">Réponses instantanées</h3>
                                <p class="text-sm text-gray-400">Obtenez des réponses à vos questions en temps réel</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="font-medium">Personnalisé pour vous</h3>
                                <p class="text-sm text-gray-400">Adapté à votre niveau et vos préférences d'apprentissage</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="font-medium">Sécurisé et privé</h3>
                                <p class="text-sm text-gray-400">Vos données sont protégées et ne sont jamais partagées</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="ai-assistant-card p-6">
                    <h3 class="font-bold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Suggestions de questions
                    </h3>
                    <div class="space-y-3">
                        <button class="w-full text-left bg-gray-700 hover:bg-gray-600 text-sm px-4 py-3 rounded-lg transition-colors duration-300">
                            Explique-moi les hooks React comme si j'avais 10 ans
                        </button>
                        <button class="w-full text-left bg-gray-700 hover:bg-gray-600 text-sm px-4 py-3 rounded-lg transition-colors duration-300">
                            Quelle est la différence entre let, const et var en JavaScript ?
                        </button>
                        <button class="w-full text-left bg-gray-700 hover:bg-gray-600 text-sm px-4 py-3 rounded-lg transition-colors duration-300">
                            Donne-moi un exemple de boucle for en Python
                        </button>
                        <button class="w-full text-left bg-gray-700 hover:bg-gray-600 text-sm px-4 py-3 rounded-lg transition-colors duration-300">
                            Comment améliorer les performances de mon site web ?
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Chat Interface -->
            <div class="lg:w-2/3">
                <div class="ai-assistant-card h-full flex flex-col">
                    <!-- Chat Header -->
                    <div class="border-b border-gray-700 p-4 flex items-center">
                        <div class="ai-avatar w-10 h-10 rounded-full flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold">Assistant EduTech</h3>
                            <p class="text-xs text-gray-400">En ligne - Prêt à vous aider</p>
                        </div>
                        <div class="ml-auto flex space-x-2">
                            <button class="text-gray-400 hover:text-white p-2 rounded-full hover:bg-gray-700 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </button>
                            <button class="text-gray-400 hover:text-white p-2 rounded-full hover:bg-gray-700 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Chat Messages -->
                    <div class="flex-1 p-4 overflow-y-auto scrollbar-thin" id="chat-messages">
                        <!-- Welcome Message -->
                        <div class="message-ai rounded-lg p-4 mb-4 animate__animated animate__fadeIn">
                            <div class="flex items-start mb-2">
                                <div class="ai-avatar w-8 h-8 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-green-400">Assistant EduTech</p>
                                    <p class="text-gray-300">Bonjour Marie ! 👋 Je suis votre assistant AI EduTech. Comment puis-je vous aider aujourd'hui ? Voici quelques idées :</p>
                                    <ul class="list-disc list-inside mt-2 text-gray-300 text-sm">
                                        <li>Expliquer un concept de programmation</li>
                                        <li>Réviser un sujet spécifique</li>
                                        <li>Corriger un exercice</li>
                                        <li>Proposer des ressources d'apprentissage</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mt-2 text-right">Aujourd'hui, 10:24</div>
                        </div>
                        
                        <!-- Sample User Message -->
                        <div class="message-user rounded-lg p-4 mb-4 animate__animated animate__fadeIn">
                            <div class="flex items-start mb-2">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile" class="w-8 h-8 rounded-full mr-3 flex-shrink-0">
                                <div>
                                    <p class="font-medium text-blue-400">Marie</p>
                                    <p class="text-gray-300">Peux-tu m'expliquer les promesses en JavaScript ?</p>
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mt-2 text-right">Aujourd'hui, 10:26</div>
                        </div>
                        
                        <!-- Sample AI Response -->
                        <div class="message-ai rounded-lg p-4 mb-4 animate__animated animate__fadeIn">
                            <div class="flex items-start mb-2">
                                <div class="ai-avatar w-8 h-8 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-green-400">Assistant EduTech</p>
                                    <p class="text-gray-300">Bien sûr Marie ! Les promesses en JavaScript sont des objets qui représentent l'achèvement ou l'échec d'une opération asynchrone. Voici une explication simple :</p>
                                    <div class="bg-gray-800 rounded-lg p-3 mt-2 text-sm">
                                        <pre><code class="text-blue-300">// Création d'une promesse
const maPromesse = new Promise((resolve, reject) => {
    // Opération asynchrone
    const reussi = true;
    
    if (reussi) {
        resolve("Succès !");
    } else {
        reject("Échec");
    }
});

// Utilisation
maPromesse
    .then(resultat => console.log(resultat))
    .catch(erreur => console.error(erreur));</code></pre>
                                    </div>
                                    <p class="text-gray-300 mt-2">Les promesses permettent d'éviter le "callback hell" et rendent le code plus lisible. Voulez-vous un exemple pratique ?</p>
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mt-2 text-right">Aujourd'hui, 10:26</div>
                        </div>
                        
                        <!-- Typing Indicator -->
                        <div id="typing-indicator" class="hidden mb-4">
                            <div class="flex items-start">
                                <div class="ai-avatar w-8 h-8 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                                </div>
                                <div class="typing-indicator">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chat Input -->
                    <div class="border-t border-gray-700 p-4">
                        <form id="chat-form" class="flex items-center">
                            <div class="flex-1 relative">
                                <input type="text" id="message-input" class="w-full input-field rounded-full px-5 py-3 focus:outline-none pr-12" placeholder="Posez votre question..." autocomplete="off">
                                <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </button>
                            </div>
                            <button type="submit" class="ml-3 bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-full glow-on-hover btn-press transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </button>
                        </form>
                        <div class="text-xs text-gray-500 mt-2 text-center">
                            EduTech AI peut faire des erreurs. Vérifiez les informations importantes.
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
        // Chat functionality
        const chatForm = document.getElementById('chat-form');
        const messageInput = document.getElementById('message-input');
        const chatMessages = document.getElementById('chat-messages');
        const typingIndicator = document.getElementById('typing-indicator');
        
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const message = messageInput.value.trim();
            if (message === '') return;
            
            // Add user message to chat
            addMessageToChat('user', message);
            messageInput.value = '';
            
            // Show typing indicator
            typingIndicator.classList.remove('hidden');
            chatMessages.scrollTop = chatMessages.scrollHeight;
            
            // Simulate AI response after a delay
            setTimeout(() => {
                typingIndicator.classList.add('hidden');
                addMessageToChat('ai', getAIResponse(message));
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 1500);
        });
        
        function addMessageToChat(sender, message) {
            const messageDiv = document.createElement('div');
            const timestamp = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            
            if (sender === 'user') {
                messageDiv.className = 'message-user rounded-lg p-4 mb-4 animate__animated animate__fadeIn';
                messageDiv.innerHTML = `
                    <div class="flex items-start mb-2">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile" class="w-8 h-8 rounded-full mr-3 flex-shrink-0">
                        <div>
                            <p class="font-medium text-blue-400">Marie</p>
                            <p class="text-gray-300">${message}</p>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500 mt-2 text-right">Aujourd'hui, ${timestamp}</div>
                `;
            } else {
                messageDiv.className = 'message-ai rounded-lg p-4 mb-4 animate__animated animate__fadeIn';
                messageDiv.innerHTML = `
                    <div class="flex items-start mb-2">
                        <div class="ai-avatar w-8 h-8 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-green-400">Assistant EduTech</p>
                            <p class="text-gray-300">${message}</p>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500 mt-2 text-right">Aujourd'hui, ${timestamp}</div>
                `;
            }
            
            chatMessages.appendChild(messageDiv);
        }
        
        function getAIResponse(userMessage) {
            // This is a simplified version - in a real app, you'd call an AI API
            const responses = {
                "bonjour": "Bonjour Marie ! Comment puis-je vous aider aujourd'hui ?",
                "aide": "Je peux vous aider avec des concepts de programmation, des explications de cours, ou des exercices pratiques. Sur quoi souhaitez-vous travailler ?",
                "merci": "Je vous en prie ! N'hésitez pas si vous avez d'autres questions.",
                "javascript": "JavaScript est un langage de programmation utilisé pour créer des pages web interactives. Voulez-vous des informations spécifiques sur JavaScript ?",
                "python": "Python est un langage de programmation populaire pour la science des données, le machine learning et le développement web. Quel aspect de Python vous intéresse ?",
                "react": "React est une bibliothèque JavaScript pour construire des interfaces utilisateur. Elle utilise un système de composants réutilisables. Voulez-vous un exemple de code ?"
            };
            
            const lowerMessage = userMessage.toLowerCase();
            
            for (const [keyword, response] of Object.entries(responses)) {
                if (lowerMessage.includes(keyword)) {
                    return response;
                }
            }
            
            return "Je suis votre assistant EduTech. Je peux vous aider à comprendre des concepts, résoudre des problèmes ou trouver des ressources. Pouvez-vous préciser votre demande ?";
        }
        
        // Sample questions click handler
        document.querySelectorAll('.ai-assistant-card button').forEach(button => {
            button.addEventListener('click', function() {
                messageInput.value = this.textContent.trim();
                messageInput.focus();
            });
        });
    </script>
</body>
</html>