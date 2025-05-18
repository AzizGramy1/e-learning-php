<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Cube Sombre</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .cube-container {
            perspective: 1000px;
        }

        .cube {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            transform-style: preserve-3d;
            position: relative;
        }

        .cube:hover {
            transform: rotateX(15deg) rotateY(15deg) translateY(-8px);
        }

        .cube:active {
            transform: rotateX(0deg) rotateY(0deg) translateY(0);
        }

        .cube-face {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 12px;
        }

        .cube-front {
            transform: translateZ(20px);
            background: #1f2937;
        }

        .cube-side {
            background: #111827;
            transform: rotateX(90deg) translateZ(20px);
            height: 20px;
            bottom: -20px;
        }

        .icon-wrapper {
            transition: all 0.3s ease;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.3));
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gray-900 min-h-screen p-8">
    
    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500 mb-12 text-center animate-float">
            Admin Dashboard
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Cube 1 -->
            <div class="cube-container">
                <button onclick="window.location.href='coursView'" class="cube w-full h-48">
                    <div class="cube-face cube-front flex flex-col items-center justify-center p-6 border-2 border-blue-400/20">
                        <div class="icon-wrapper mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-blue-200 mb-2">Cours</h3>
                        <p class="text-gray-400 text-sm text-center">Gestion des cours</p>
                    </div>
                    <div class="cube-face cube-side"></div>
                </button>
            </div>

            <!-- Cube 2 -->
            <div class="cube-container">
                <button onclick="window.location.href='userView'" class="cube w-full h-48">
                    <div class="cube-face cube-front flex flex-col items-center justify-center p-6 border-2 border-purple-400/20">
                        <div class="icon-wrapper mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-purple-200 mb-2">Profils</h3>
                        <p class="text-gray-400 text-sm text-center">Gestion des utilisateurs</p>
                    </div>
                    <div class="cube-face cube-side"></div>
                </button>
            </div>

            <!-- Cube 3 -->
            <div class="cube-container">
                <button onclick="window.location.href='certificatView'" class="cube w-full h-48">
                    <div class="cube-face cube-front flex flex-col items-center justify-center p-6 border-2 border-green-400/20">
                        <div class="icon-wrapper mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-green-200 mb-2">Certificats</h3>
                        <p class="text-gray-400 text-sm text-center">Gestions des certificats</p>
                    </div>
                    <div class="cube-face cube-side"></div>
                </button>
            </div>

            <!-- Cube 4 -->
            <div class="cube-container">
                <button onclick="window.location.href='forumView'" class="cube w-full h-48">
                    <div class="cube-face cube-front flex flex-col items-center justify-center p-6 border-2 border-red-400/20">
                        <div class="icon-wrapper mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-red-200 mb-2">Discussions</h3>
                        <p class="text-gray-400 text-sm text-center">Parametrage des discussions</p>
                    </div>
                    <div class="cube-face cube-side"></div>
                </button>
            </div>

            <!-- Cube 5 -->
            <div class="cube-container">
                <button class="cube w-full h-48">
                    <div class="cube-face cube-front flex flex-col items-center justify-center p-6 border-2 border-yellow-400/20">
                        <div class="icon-wrapper mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-yellow-200 mb-2">Paiements</h3>
                        <p class="text-gray-400 text-sm text-center">Historique des transactions</p>
                    </div>
                    <div class="cube-face cube-side"></div>
                </button>
            </div>

            <!-- Cube 6 -->
            <div class="cube-container">
                <button class="cube w-full h-48">
                    <div class="cube-face cube-front flex flex-col items-center justify-center p-6 border-2 border-pink-400/20">
                        <div class="icon-wrapper mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-pink-200 mb-2">Support</h3>
                        <p class="text-gray-400 text-sm text-center">Assistance technique</p>
                    </div>
                    <div class="cube-face cube-side"></div>
                </button>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.cube').forEach(button => {
            button.addEventListener('click', function() {
                this.style.transform = 'translateZ(-20px) rotateX(30deg)';
                setTimeout(() => {
                    this.style.transform = '';
                    alert(`Action : ${this.querySelector('h3').textContent}`);
                }, 300);
            });
        });
    </script>

</body>
</html> 