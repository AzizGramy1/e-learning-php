<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz JavaScript - EduTech</title>
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
        .option-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            transform-style: preserve-3d;
        }
        .option-card:hover {
            transform: translateY(-5px) rotateX(5deg);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .option-card.correct {
            animation: correctAnswer 0.5s ease forwards;
        }
        .option-card.incorrect {
            animation: incorrectAnswer 0.5s ease forwards;
        }
        @keyframes correctAnswer {
            0% { transform: scale(1); background-color: rgba(16, 185, 129, 0.1); }
            50% { transform: scale(1.05); background-color: rgba(16, 185, 129, 0.3); }
            100% { transform: scale(1); background-color: rgba(16, 185, 129, 0.2); border: 2px solid #10B981; }
        }
        @keyframes incorrectAnswer {
            0% { transform: translateX(0); background-color: rgba(239, 68, 68, 0.1); }
            20% { transform: translateX(-10px); }
            40% { transform: translateX(10px); }
            60% { transform: translateX(-10px); }
            80% { transform: translateX(10px); }
            100% { transform: translateX(0); background-color: rgba(239, 68, 68, 0.2); border: 2px solid #EF4444; }
        }
        .progress-ring__circle {
            transition: stroke-dashoffset 0.5s ease;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #f00;
            opacity: 0;
        }
        .question-transition {
            animation: questionFade 0.5s ease-out;
        }
        @keyframes questionFade {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
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

    <!-- Quiz Header -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold mb-2">Quiz JavaScript</h1>
                <p class="text-xl text-gray-400">Testez vos connaissances en JavaScript</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2 bg-gray-800 bg-opacity-50 px-4 py-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                    <span class="font-medium">125 XP</span>
                </div>
                <div class="flex items-center space-x-2 bg-gray-800 bg-opacity-50 px-4 py-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">15 min</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quiz Content -->
    <div class="container mx-auto px-4 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Quiz Progress -->
            <div class="lg:col-span-1">
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 sticky top-24 card-hover">
                    <h3 class="text-lg font-bold mb-6">Progression du quiz</h3>
                    
                    <!-- Progress Ring -->
                    <div class="relative w-32 h-32 mx-auto mb-6">
                        <svg class="w-full h-full" viewBox="0 0 100 100">
                            <!-- Background circle -->
                            <circle class="text-gray-700" stroke-width="8" stroke="currentColor" fill="transparent" r="40" cx="50" cy="50" />
                            <!-- Progress circle -->
                            <circle class="progress-ring__circle text-blue-500" stroke-width="8" stroke-linecap="round" stroke="currentColor" fill="transparent" r="40" cx="50" cy="50" 
                                    stroke-dasharray="251.2" stroke-dashoffset="175.84" />
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center flex-col">
                            <span class="text-2xl font-bold">3/5</span>
                            <span class="text-gray-400 text-sm">questions</span>
                        </div>
                    </div>
                    
                    <!-- Timer -->
                    <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4 mb-6 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-medium">Temps restant</span>
                        </div>
                        <span class="text-xl font-mono font-bold">08:42</span>
                    </div>
                    
                    <!-- Questions Navigation -->
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-400 mb-3">Questions</h4>
                        <div class="grid grid-cols-5 gap-2">
                            <button class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center btn-press">1</button>
                            <button class="w-10 h-10 rounded-full bg-green-600 text-white flex items-center justify-center btn-press">2</button>
                            <button class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center btn-press">3</button>
                            <button class="w-10 h-10 rounded-full bg-gray-700 text-gray-400 flex items-center justify-center btn-press">4</button>
                            <button class="w-10 h-10 rounded-full bg-gray-700 text-gray-400 flex items-center justify-center btn-press">5</button>
                        </div>
                    </div>
                    
                    <!-- Score -->
                    <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-400">Score actuel</span>
                            <span class="font-bold">240/500</span>
                        </div>
                        <div class="w-full bg-gray-800 rounded-full h-2 mb-2">
                            <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full" style="width: 48%"></div>
                        </div>
                        <div class="flex justify-between text-sm text-gray-400">
                            <span>0%</span>
                            <span>100%</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Quiz Question -->
            <div class="lg:col-span-2">
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-8 card-hover question-transition">
                    <!-- Question Header -->
                    <div class="flex justify-between items-center mb-6">
                        <span class="bg-blue-900 bg-opacity-50 text-blue-400 text-xs px-3 py-1 rounded-full">Question 3/5</span>
                        <span class="bg-yellow-900 bg-opacity-50 text-yellow-400 text-xs px-3 py-1 rounded-full">Difficulté: Moyenne</span>
                    </div>
                    
                    <!-- Question -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold mb-4">Quel est le résultat de l'expression suivante ?</h2>
                        <div class="bg-gray-900 rounded-lg p-4 mb-4 overflow-x-auto">
                            <pre class="text-green-400 font-mono text-sm"><code>console.log(1 + "2" + "2" + 1 - 1);</code></pre>
                        </div>
                        <p class="text-gray-400">Choisissez la bonne réponse :</p>
                    </div>
                    
                    <!-- Options -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8" id="optionsContainer">
                        <!-- Option 1 -->
                        <div class="option-card bg-gray-700 bg-opacity-50 rounded-lg p-4 border-2 border-transparent cursor-pointer">
                            <div class="flex items-start">
                                <span class="bg-gray-600 text-gray-200 rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-1">A</span>
                                <div>
                                    <p class="font-medium">1220</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Option 2 -->
                        <div class="option-card bg-gray-700 bg-opacity-50 rounded-lg p-4 border-2 border-transparent cursor-pointer">
                            <div class="flex items-start">
                                <span class="bg-gray-600 text-gray-200 rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-1">B</span>
                                <div>
                                    <p class="font-medium">1221</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Option 3 (Correct Answer) -->
                        <div class="option-card bg-gray-700 bg-opacity-50 rounded-lg p-4 border-2 border-transparent cursor-pointer">
                            <div class="flex items-start">
                                <span class="bg-gray-600 text-gray-200 rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-1">C</span>
                                <div>
                                    <p class="font-medium">121</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Option 4 -->
                        <div class="option-card bg-gray-700 bg-opacity-50 rounded-lg p-4 border-2 border-transparent cursor-pointer">
                            <div class="flex items-start">
                                <span class="bg-gray-600 text-gray-200 rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-1">D</span>
                                <div>
                                    <p class="font-medium">Erreur</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Feedback (hidden by default) -->
                    <div class="bg-green-900 bg-opacity-30 border border-green-800 rounded-lg p-4 mb-6 hidden" id="feedbackCorrect">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <div>
                                <h4 class="font-bold text-green-400 mb-1">Bonne réponse !</h4>
                                <p class="text-green-300">Explication : L'expression évalue d'abord 1 + "2" en "12", puis "12" + "2" en "122", puis "122" + 1 en "1221", et enfin "1221" - 1 en 1220 (conversion en nombre).</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-red-900 bg-opacity-30 border border-red-800 rounded-lg p-4 mb-6 hidden" id="feedbackIncorrect">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="font-bold text-red-400 mb-1">Réponse incorrecte</h4>
                                <p class="text-red-300">La bonne réponse est <span class="font-bold">C. 121</span>. L'expression évalue d'abord 1 + "2" en "12", puis "12" + "2" en "122", puis "122" + 1 en "1221", et enfin "1221" - 1 en 1220 (conversion en nombre).</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation Buttons -->
                    <div class="flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-4">
                        <button class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg glow-on-hover btn-press transition-all duration-300 flex-1 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Question précédente
                        </button>
                        <button id="nextQuestionBtn" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-3 rounded-lg glow-on-hover btn-press transition-all duration-300 flex-1 flex items-center justify-center hidden">
                            Question suivante
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <button id="validateBtn" class="bg-purple-600 hover:bg-purple-500 text-white px-6 py-3 rounded-lg glow-on-hover btn-press transition-all duration-300 flex-1 flex items-center justify-center animate-pulse">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Valider la réponse
                        </button>
                    </div>
                </div>
                
                <!-- Quiz Tips -->
                <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 mt-6 card-hover">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Astuce pour cette question
                    </h3>
                    <p class="text-gray-400">En JavaScript, l'opérateur + peut faire une concaténation de chaînes ou une addition numérique, selon le type des opérandes. L'opérateur - tente toujours de convertir les opérandes en nombres.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Confetti Container (hidden) -->
    <div id="confettiContainer" class="fixed inset-0 pointer-events-none overflow-hidden hidden"></div>

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
        // Quiz Interaction Logic
        document.addEventListener('DOMContentLoaded', function() {
            const options = document.querySelectorAll('.option-card');
            const validateBtn = document.getElementById('validateBtn');
            const nextQuestionBtn = document.getElementById('nextQuestionBtn');
            const feedbackCorrect = document.getElementById('feedbackCorrect');
            const feedbackIncorrect = document.getElementById('feedbackIncorrect');
            const confettiContainer = document.getElementById('confettiContainer');
            
            let selectedOption = null;
            const correctAnswerIndex = 2; // Option C is correct (0-based index)
            
            // Option selection
            options.forEach((option, index) => {
                option.addEventListener('click', function() {
                    // Remove selection from all options
                    options.forEach(opt => {
                        opt.classList.remove('border-blue-500', 'bg-blue-900', 'bg-opacity-30');
                        opt.querySelector('span').classList.remove('bg-blue-500', 'text-white');
                        opt.querySelector('span').classList.add('bg-gray-600', 'text-gray-200');
                    });
                    
                    // Add selection to clicked option
                    this.classList.add('border-blue-500', 'bg-blue-900', 'bg-opacity-30');
                    this.querySelector('span').classList.remove('bg-gray-600', 'text-gray-200');
                    this.querySelector('span').classList.add('bg-blue-500', 'text-white');
                    
                    selectedOption = index;
                });
            });
            
            // Validate answer
            validateBtn.addEventListener('click', function() {
                if (selectedOption === null) return;
                
                // Disable all options
                options.forEach(option => {
                    option.classList.remove('cursor-pointer');
                    option.classList.add('pointer-events-none');
                });
                
                // Show feedback
                if (selectedOption === correctAnswerIndex) {
                    options[selectedOption].classList.add('correct');
                    feedbackCorrect.classList.remove('hidden');
                    feedbackCorrect.classList.add('animate__animated', 'animate__fadeIn');
                    
                    // Show confetti for correct answer
                    showConfetti();
                } else {
                    options[selectedOption].classList.add('incorrect');
                    options[correctAnswerIndex].classList.add('correct');
                    feedbackIncorrect.classList.remove('hidden');
                    feedbackIncorrect.classList.add('animate__animated', 'animate__fadeIn');
                }
                
                // Hide validate button, show next question button
                validateBtn.classList.add('hidden');
                nextQuestionBtn.classList.remove('hidden');
                nextQuestionBtn.classList.add('animate__animated', 'animate__bounceIn');
            });
            
            // Confetti effect
            function showConfetti() {
                confettiContainer.classList.remove('hidden');
                confettiContainer.innerHTML = '';
                
                const colors = ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6'];
                
                for (let i = 0; i < 100; i++) {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.left = Math.random() * 100 + 'vw';
                    confetti.style.top = -10 + 'px';
                    confetti.style.width = Math.random() * 10 + 5 + 'px';
                    confetti.style.height = Math.random() * 10 + 5 + 'px';
                    confetti.style.opacity = Math.random() + 0.5;
                    confetti.style.transform = 'rotate(' + Math.random() * 360 + 'deg)';
                    
                    const animationDuration = Math.random() * 3 + 2;
                    confetti.style.animation = `fall ${animationDuration}s linear forwards`;
                    
                    confettiContainer.appendChild(confetti);
                    
                    // Add animation
                    const keyframes = `
                        @keyframes fall {
                            to {
                                transform: translateY(100vh) rotate(360deg);
                            }
                        }
                    `;
                    
                    const style = document.createElement('style');
                    style.innerHTML = keyframes;
                    document.head.appendChild(style);
                }
                
                // Hide confetti after animation
                setTimeout(() => {
                    confettiContainer.classList.add('hidden');
                }, 3000);
            }
            
            // Update progress ring
            function updateProgressRing(percent) {
                const circle = document.querySelector('.progress-ring__circle');
                const radius = circle.r.baseVal.value;
                const circumference = radius * 2 * Math.PI;
                const offset = circumference - (percent / 100) * circumference;
                circle.style.strokeDashoffset = offset;
            }
            
            // Initialize progress ring
            updateProgressRing(60); // 3/5 questions = 60%
            
            // Simulate timer countdown
            let minutes = 8;
            let seconds = 42;
            const timerElement = document.querySelector('.font-mono');
            
            const timerInterval = setInterval(() => {
                seconds--;
                if (seconds < 0) {
                    seconds = 59;
                    minutes--;
                }
                
                if (minutes < 0) {
                    clearInterval(timerInterval);
                    // Time's up logic
                }
                
                timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }, 1000);
        });
    </script>
</body>
</html>