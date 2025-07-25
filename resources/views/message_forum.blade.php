<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie - EduTech</title>
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
        .conversation-item {
            transition: all 0.3s ease;
        }
        .conversation-item:hover {
            background: rgba(59, 130, 246, 0.1);
        }
        .conversation-item.active {
            background: rgba(59, 130, 246, 0.2);
        }
        .message-in {
            animation: fadeInLeft 0.3s ease-out;
        }
        .message-out {
            animation: fadeInRight 0.3s ease-out;
        }
        .typing-indicator {
            display: inline-flex;
            align-items: center;
        }
        .typing-dot {
            width: 6px;
            height: 6px;
            background-color: #9CA3AF;
            border-radius: 50%;
            margin: 0 2px;
            animation: typingAnimation 1.4s infinite ease-in-out;
        }
        .typing-dot:nth-child(1) {
            animation-delay: 0s;
        }
        .typing-dot:nth-child(2) {
            animation-delay: 0.2s;
        }
        .typing-dot:nth-child(3) {
            animation-delay: 0.4s;
        }
        @keyframes typingAnimation {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-5px); }
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
<body class="gradient-bg text-gray-100 min-h-screen flex overflow-hidden">
    <!-- Sidebar -->
    <div class="sidebar-bg w-80 min-h-screen flex flex-col border-r border-gray-700 z-50">
        <div class="p-6 flex items-center space-x-3 border-b border-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            <span class="text-2xl font-bold text-gradient">Messagerie</span>
        </div>
        
        <!-- Search -->
        <div class="p-4 border-b border-gray-700">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input 
                    type="text" 
                    class="bg-gray-700 w-full pl-10 pr-4 py-2 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    placeholder="Rechercher des messages..."
                >
            </div>
        </div>
        
        <!-- Conversation List -->
        <div class="flex-1 overflow-y-auto scrollbar-thin">
            <!-- Conversation Group 1 -->
            <div class="px-2 py-3">
                <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 mb-2">En ligne</h4>
                
                <div class="space-y-1">
                    <!-- Conversation 1 -->
                    <div class="conversation-item active flex items-center space-x-3 px-4 py-3 rounded-lg cursor-pointer">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-800"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium truncate">Asma Zoghlami</h4>
                            <p class="text-sm text-gray-400 truncate">Salut, comment vas-tu ?</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-gray-400">12:30</span>
                            <span class="block w-5 h-5 bg-blue-500 text-white text-xs rounded-full flex items-center justify-center ml-auto mt-1">3</span>
                        </div>
                    </div>
                    
                    <!-- Conversation 2 -->
                    <div class="conversation-item flex items-center space-x-3 px-4 py-3 rounded-lg cursor-pointer">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-800"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium truncate">Jean Dupont</h4>
                            <p class="text-sm text-gray-400 truncate">J'ai terminé le projet</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-gray-400">11:45</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Conversation Group 2 -->
            <div class="px-2 py-3">
                <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 mb-2">Récemment</h4>
                
                <div class="space-y-1">
                    <!-- Conversation 3 -->
                    <div class="conversation-item flex items-center space-x-3 px-4 py-3 rounded-lg cursor-pointer">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-gray-500 rounded-full border-2 border-gray-800"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium truncate">Groupe React</h4>
                            <p class="text-sm text-gray-400 truncate">Pierre: J'ai un problème avec...</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-gray-400">Hier</span>
                            <span class="block w-5 h-5 bg-blue-500 text-white text-xs rounded-full flex items-center justify-center ml-auto mt-1">12</span>
                        </div>
                    </div>
                    
                    <!-- Conversation 4 -->
                    <div class="conversation-item flex items-center space-x-3 px-4 py-3 rounded-lg cursor-pointer">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-gray-500 rounded-full border-2 border-gray-800"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium truncate">Mentorat</h4>
                            <p class="text-sm text-gray-400 truncate">Notre prochaine session est...</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-gray-400">Lun.</span>
                        </div>
                    </div>
                    
                    <!-- Conversation 5 -->
                    <div class="conversation-item flex items-center space-x-3 px-4 py-3 rounded-lg cursor-pointer">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-gray-500 rounded-full border-2 border-gray-800"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium truncate">Thomas Leroy</h4>
                            <p class="text-sm text-gray-400 truncate">Merci pour ton aide !</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-gray-400">Sam.</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Conversation Group 3 -->
            <div class="px-2 py-3">
                <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 mb-2">Anciens messages</h4>
                
                   
                    <!-- Conversation 7 -->
                    <div class="conversation-item flex items-center space-x-3 px-4 py-3 rounded-lg cursor-pointer">
                        <div class="relative">
                            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-medium">DS</div>
                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-gray-500 rounded-full border-2 border-gray-800"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium truncate">Data Science FR</h4>
                            <p class="text-sm text-gray-400 truncate">Nouveau dataset disponible</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-gray-400">5 juin</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Chat Header -->
        <div class="bg-gray-800 bg-opacity-90 backdrop-filter backdrop-blur-lg border-b border-gray-700 flex items-center justify-between px-6 py-4">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-800"></span>
                </div>
                <div>
                    <h3 class="font-bold">Sophie Martin</h3>
                    <p class="text-xs text-gray-400">En ligne</p>
                </div>
            </div>
            
            <div class="flex items-center space-x-4">
                <button class="text-gray-400 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </button>
                <button class="text-gray-400 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </button>
                <button class="text-gray-400 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Messages -->
        <div class="flex-1 overflow-y-auto p-6 scrollbar-thin bg-gray-900 bg-opacity-50">
            <!-- Date separator -->
            <div class="flex items-center my-6">
                <div class="flex-1 border-t border-gray-700"></div>
                <span class="px-3 text-gray-400 text-sm">Aujourd'hui</span>
                <div class="flex-1 border-t border-gray-700"></div>
            </div>
            
            <!-- Incoming message -->
            <div class="flex mb-4 message-in">
                <div class="flex-shrink-0 mr-3">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                </div>
                <div class="max-w-xs md:max-w-md lg:max-w-lg">
                    <div class="bg-gray-700 rounded-lg p-3">
                        <p>Salut Marie ! Comment avance ton projet React ?</p>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">12:30</p>
                </div>
            </div>
            
            <!-- Outgoing message -->
            <div class="flex justify-end mb-4 message-out">
                <div class="max-w-xs md:max-w-md lg:max-w-lg">
                    <div class="bg-blue-600 rounded-lg p-3">
                        <p>Ça avance bien ! J'ai presque terminé les composants principaux. Je bloque un peu sur le système de routage dynamique.</p>
                    </div>
                    <p class="text-xs text-gray-400 mt-1 text-right">12:32 <i class="fas fa-check ml-1 text-blue-400"></i></p>
                </div>
            </div>
            
            <!-- Incoming message -->
            <div class="flex mb-4 message-in">
                <div class="flex-shrink-0 mr-3">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                </div>
                <div class="max-w-xs md:max-w-md lg:max-w-lg">
                    <div class="bg-gray-700 rounded-lg p-3">
                        <p>Ah oui, c'est un point délicat. Tu utilises React Router ? Je peux t'envoyer un exemple de code si tu veux.</p>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">12:33</p>
                </div>
            </div>
            
            <!-- Outgoing message -->
            <div class="flex justify-end mb-4 message-out">
                <div class="max-w-xs md:max-w-md lg:max-w-lg">
                    <div class="bg-blue-600 rounded-lg p-3">
                        <p>Oui, ce serait super merci ! J'utilise la v6 de React Router.</p>
                    </div>
                    <p class="text-xs text-gray-400 mt-1 text-right">12:34 <i class="fas fa-check ml-1 text-blue-400"></i></p>
                </div>
            </div>
            
            <!-- Incoming message with typing indicator -->
            <div class="flex mb-4 message-in">
                <div class="flex-shrink-0 mr-3">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                </div>
                <div class="max-w-xs md:max-w-md lg:max-w-lg">
                    <div class="bg-gray-700 rounded-lg p-3">
                        <div class="typing-indicator">
                            <span class="typing-dot"></span>
                            <span class="typing-dot"></span>
                            <span class="typing-dot"></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Incoming message with attachment -->
            <div class="flex mb-4 message-in">
                <div class="flex-shrink-0 mr-3">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                </div>
                <div class="max-w-xs md:max-w-md lg:max-w-lg">
                    <div class="bg-gray-700 rounded-lg overflow-hidden">
                        <div class="p-3 border-b border-gray-600">
                            <p>Voici un exemple de configuration de routes dynamiques :</p>
                        </div>
                        <div class="p-3 bg-gray-800">
                            <div class="flex items-center">
                                <div class="bg-blue-500 bg-opacity-20 p-2 rounded-lg mr-3">
                                    <i class="fas fa-file-code text-blue-400"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium truncate">exemple-routes.js</p>
                                    <p class="text-xs text-gray-400">Fichier JavaScript · 2.1KB</p>
                                </div>
                                <button class="text-blue-400 hover:text-blue-300 ml-3">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">12:36</p>
                </div>
            </div>
            
            <!-- Outgoing message -->
            <div class="flex justify-end mb-4 message-out">
                <div class="max-w-xs md:max-w-md lg:max-w-lg">
                    <div class="bg-blue-600 rounded-lg p-3">
                        <p>Merci beaucoup ! Je regarde ça tout de suite.</p>
                    </div>
                    <p class="text-xs text-gray-400 mt-1 text-right">12:37 <i class="fas fa-check ml-1 text-blue-400"></i></p>
                </div>
            </div>
            
            <!-- Outgoing message with read receipt -->
            <div class="flex justify-end mb-4 message-out">
                <div class="max-w-xs md:max-w-md lg:max-w-lg">
                    <div class="bg-blue-600 rounded-lg p-3">
                        <p>Je te fais un retour dès que j'ai testé.</p>
                    </div>
                    <p class="text-xs text-gray-400 mt-1 text-right">12:37 <i class="fas fa-check-double ml-1 text-blue-400"></i></p>
                </div>
            </div>
        </div>
        
        <!-- Message Input -->
        <div class="bg-gray-800 bg-opacity-90 backdrop-filter backdrop-blur-lg border-t border-gray-700 p-4">
            <div class="flex items-center">
                <button class="text-gray-400 hover:text-white mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                    </svg>
                </button>
                <div class="flex-1 relative">
                    <input 
                        type="text" 
                        class="bg-gray-700 w-full pl-4 pr-12 py-3 rounded-full text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                        placeholder="Écrire un message..."
                    >
                    <div class="absolute right-3 top-3 flex space-x-2">
                        <button class="text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                        <button class="text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <button class="ml-3 bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-full glow-on-hover btn-press">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Conversation item click handler
            const conversationItems = document.querySelectorAll('.conversation-item');
            conversationItems.forEach(item => {
                item.addEventListener('click', function() {
                    conversationItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Simulate loading new conversation
                    const messagesContainer = document.querySelector('.bg-gray-900');
                    messagesContainer.innerHTML = `
                        <div class="flex justify-center items-center h-full">
                            <div class="text-center">
                                <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500 mb-2"></div>
                                <p class="text-gray-400">Chargement de la conversation...</p>
                            </div>
                        </div>
                    `;
                    
                    // Simulate loaded messages after delay
                    setTimeout(() => {
                        messagesContainer.innerHTML = `
                            <div class="flex items-center my-6">
                                <div class="flex-1 border-t border-gray-700"></div>
                                <span class="px-3 text-gray-400 text-sm">Aujourd'hui</span>
                                <div class="flex-1 border-t border-gray-700"></div>
                            </div>
                            
                            <div class="flex mb-4 message-in">
                                <div class="flex-shrink-0 mr-3">
                                    <img src="${this.querySelector('img').src}" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                                </div>
                                <div class="max-w-xs md:max-w-md lg:max-w-lg">
                                    <div class="bg-gray-700 rounded-lg p-3">
                                        <p>Nouvelle conversation avec ${this.querySelector('h4').textContent}</p>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-1">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</p>
                                </div>
                            </div>
                        `;
                    }, 1000);
                });
            });
            
            // Simulate incoming message after delay
            setTimeout(() => {
                const messagesContainer = document.querySelector('.bg-gray-900');
                const typingIndicator = messagesContainer.querySelector('.typing-indicator');
                if (typingIndicator) {
                    typingIndicator.closest('.flex').remove();
                    
                    const newMessage = document.createElement('div');
                    newMessage.className = 'flex mb-4 message-in';
                    newMessage.innerHTML = `
                        <div class="flex-shrink-0 mr-3">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                        </div>
                        <div class="max-w-xs md:max-w-md lg:max-w-lg">
                            <div class="bg-gray-700 rounded-lg p-3">
                                <p>Avec plaisir ! N'hésite pas si tu as d'autres questions.</p>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</p>
                        </div>
                    `;
                    messagesContainer.appendChild(newMessage);
                    newMessage.scrollIntoView({ behavior: 'smooth' });
                }
            }, 3000);
            
            // Message input focus effect
            const messageInput = document.querySelector('input[type="text"]');
            messageInput.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-blue-500', 'rounded-full');
            });
            
            messageInput.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-blue-500', 'rounded-full');
            });
            
            // Send message handler
            const sendButton = document.querySelector('.btn-press.bg-blue-600');
            sendButton.addEventListener('click', function() {
                const messageText = messageInput.value.trim();
                if (messageText) {
                    const messagesContainer = document.querySelector('.bg-gray-900');
                    
                    const newMessage = document.createElement('div');
                    newMessage.className = 'flex justify-end mb-4 message-out';
                    newMessage.innerHTML = `
                        <div class="max-w-xs md:max-w-md lg:max-w-lg">
                            <div class="bg-blue-600 rounded-lg p-3">
                                <p>${messageText}</p>
                            </div>
                            <p class="text-xs text-gray-400 mt-1 text-right">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})} <i class="fas fa-check ml-1 text-blue-400"></i></p>
                        </div>
                    `;
                    messagesContainer.appendChild(newMessage);
                    messageInput.value = '';
                    newMessage.scrollIntoView({ behavior: 'smooth' });
                    
                    // Simulate reply after delay
                    setTimeout(() => {
                        const typingMessage = document.createElement('div');
                        typingMessage.className = 'flex mb-4 message-in';
                        typingMessage.innerHTML = `
                            <div class="flex-shrink-0 mr-3">
                                <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                            </div>
                            <div class="max-w-xs md:max-w-md lg:max-w-lg">
                                <div class="bg-gray-700 rounded-lg p-3">
                                    <div class="typing-indicator">
                                        <span class="typing-dot"></span>
                                        <span class="typing-dot"></span>
                                        <span class="typing-dot"></span>
                                    </div>
                                </div>
                            </div>
                        `;
                        messagesContainer.appendChild(typingMessage);
                        typingMessage.scrollIntoView({ behavior: 'smooth' });
                        
                        // Replace typing with actual message after delay
                        setTimeout(() => {
                            typingMessage.remove();
                            
                            const replyMessage = document.createElement('div');
                            replyMessage.className = 'flex mb-4 message-in';
                            replyMessage.innerHTML = `
                                <div class="flex-shrink-0 mr-3">
                                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                                </div>
                                <div class="max-w-xs md:max-w-md lg:max-w-lg">
                                    <div class="bg-gray-700 rounded-lg p-3">
                                        <p>Merci pour ton message ! Je te réponds dès que possible.</p>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-1">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</p>
                                </div>
                            `;
                            messagesContainer.appendChild(replyMessage);
                            replyMessage.scrollIntoView({ behavior: 'smooth' });
                        }, 2000);
                    }, 1000);
                }
            });
            
            // Also send message on Enter key
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendButton.click();
                }
            });
        });
    </script>
</body>
</html>