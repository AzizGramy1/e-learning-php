<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - EduTech</title>
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
        .signup-card {
            background: linear-gradient(135deg, rgba(45, 55, 72, 0.8) 0%, rgba(26, 32, 44, 0.9) 100%);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            overflow: hidden;
        }
        .input-field {
            background: rgba(31, 41, 55, 0.5);
            border: 1px solid rgba(74, 85, 104, 0.5);
            transition: all 0.3s ease;
        }
        .input-field:focus {
            border-color: #3B82F6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
        .password-strength {
            height: 4px;
            transition: all 0.3s ease;
        }
        .strength-0 {
            width: 20%;
            background-color: #EF4444;
        }
        .strength-1 {
            width: 40%;
            background-color: #F59E0B;
        }
        .strength-2 {
            width: 60%;
            background-color: #F59E0B;
        }
        .strength-3 {
            width: 80%;
            background-color: #10B981;
        }
        .strength-4 {
            width: 100%;
            background-color: #10B981;
        }
        .checkmark {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: rgba(16, 185, 129, 0.2);
            border-radius: 50%;
            margin-right: 8px;
            position: relative;
            transition: all 0.3s ease;
        }
        .checkmark.valid {
            background-color: rgba(16, 185, 129, 0.5);
        }
        .checkmark.valid::after {
            content: "✓";
            position: absolute;
            color: #10B981;
            font-size: 12px;
            left: 4px;
            top: 2px;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .animate-pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .tab-indicator {
            transition: all 0.3s ease;
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
                <a href="#" class="text-blue-400 font-medium transition-colors duration-300">S'inscrire</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="login.html" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-300">
                    Connexion
                </a>
                <button class="md:hidden text-gray-300 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row items-center">
            <!-- Left Column - Illustration -->
            <div class="lg:w-1/2 mb-12 lg:mb-0 lg:pr-12">
                <div class="relative w-full h-64 lg:h-96">
                    <div class="absolute inset-0 bg-blue-500 rounded-full opacity-20 blur-xl animate-pulse"></div>
                    <img src="https://cdn-icons-png.flaticon.com/512/3130/3130313.png" alt="Inscription Illustration" class="relative z-10 w-full h-full object-contain animate-float">
                </div>
                <div class="mt-8 text-center lg:text-left">
                    <h2 class="text-2xl font-bold mb-4">Rejoignez notre communauté d'apprenants</h2>
                    <p class="text-gray-400 mb-6">Accédez à des centaines de cours, quiz interactifs et obtenez des certifications reconnues.</p>
                    <div class="flex flex-wrap justify-center lg:justify-start gap-2">
                        <div class="flex items-center bg-gray-800 bg-opacity-50 px-3 py-1 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-xs">+50 000 apprenants</span>
                        </div>
                        <div class="flex items-center bg-gray-800 bg-opacity-50 px-3 py-1 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-xs">+200 cours</span>
                        </div>
                        <div class="flex items-center bg-gray-800 bg-opacity-50 px-3 py-1 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-xs">Certifications reconnues</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Signup Form -->
            <div class="lg:w-1/2">
                <div class="signup-card p-8 animate__animated animate__fadeInUp">
                    <div class="flex border-b border-gray-700 mb-6 relative">
                        <div class="w-1/2 text-center pb-4 font-medium text-blue-400">
                            Créer un compte
                        </div>
                        <div class="w-1/2 text-center pb-4 text-gray-400">
                            <a href="login.html" class="hover:text-white">Déjà membre ?</a>
                        </div>
                        <div class="tab-indicator absolute bottom-0 left-0 h-0.5 bg-blue-500 w-1/2"></div>
                    </div>
                    
                    <form id="signup-form">
                        <!-- Social Login -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <button type="button" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-300 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                                GitHub
                            </button>
                            <button type="button" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-300 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/>
                                </svg>
                                LinkedIn
                            </button>
                        </div>
                        
                        <div class="relative flex items-center my-6">
                            <div class="flex-grow border-t border-gray-700"></div>
                            <span class="flex-shrink mx-4 text-gray-400">ou</span>
                            <div class="flex-grow border-t border-gray-700"></div>
                        </div>
                        
                        <!-- Form Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="first-name" class="block text-sm font-medium mb-2">Prénom</label>
                                <input type="text" id="first-name" class="w-full input-field rounded-lg px-4 py-3 focus:outline-none" required>
                            </div>
                            <div>
                                <label for="last-name" class="block text-sm font-medium mb-2">Nom</label>
                                <input type="text" id="last-name" class="w-full input-field rounded-lg px-4 py-3 focus:outline-none" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium mb-2">Email</label>
                            <input type="email" id="email" class="w-full input-field rounded-lg px-4 py-3 focus:outline-none" required>
                            <p class="text-xs text-gray-500 mt-1">Nous ne partagerons jamais votre email.</p>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium mb-2">Mot de passe</label>
                            <div class="relative">
                                <input type="password" id="password" class="w-full input-field rounded-lg px-4 py-3 focus:outline-none pr-10" required>
                                <button type="button" id="toggle-password" class="absolute right-3 top-3 text-gray-400 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            <div id="password-strength" class="password-strength strength-0 mt-2 rounded-full"></div>
                        </div>
                        
                        <div class="mb-6">
                            <label for="confirm-password" class="block text-sm font-medium mb-2">Confirmer le mot de passe</label>
                            <input type="password" id="confirm-password" class="w-full input-field rounded-lg px-4 py-3 focus:outline-none" required>
                        </div>
                        
                        <div class="mb-6">
                            <div class="space-y-2 text-sm">
                                <div class="flex items-center">
                                    <span id="length-check" class="checkmark"></span>
                                    <span class="text-gray-400">8 caractères minimum</span>
                                </div>
                                <div class="flex items-center">
                                    <span id="uppercase-check" class="checkmark"></span>
                                    <span class="text-gray-400">1 lettre majuscule</span>
                                </div>
                                <div class="flex items-center">
                                    <span id="number-check" class="checkmark"></span>
                                    <span class="text-gray-400">1 chiffre</span>
                                </div>
                                <div class="flex items-center">
                                    <span id="special-check" class="checkmark"></span>
                                    <span class="text-gray-400">1 caractère spécial</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center mb-6">
                            <input type="checkbox" id="terms" class="rounded text-blue-600 focus:ring-blue-500" required>
                            <label for="terms" class="ml-2 text-sm text-gray-400">
                                J'accepte les <a href="#" class="text-blue-400 hover:underline">Conditions d'utilisation</a> et la <a href="#" class="text-blue-400 hover:underline">Politique de confidentialité</a>
                            </label>
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white py-3 px-6 rounded-lg glow-on-hover btn-press transition-all duration-300 flex items-center justify-center animate-pulse">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            S'inscrire
                        </button>
                    </form>
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
        // Password toggle
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');
        
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' ? 
                '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>' :
                '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>';
        });
        
        // Password strength checker
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            // Check password length
            if (password.length >= 8) {
                strength++;
                document.getElementById('length-check').classList.add('valid');
            } else {
                document.getElementById('length-check').classList.remove('valid');
            }
            
            // Check for uppercase letters
            if (/[A-Z]/.test(password)) {
                strength++;
                document.getElementById('uppercase-check').classList.add('valid');
            } else {
                document.getElementById('uppercase-check').classList.remove('valid');
            }
            
            // Check for numbers
            if (/[0-9]/.test(password)) {
                strength++;
                document.getElementById('number-check').classList.add('valid');
            } else {
                document.getElementById('number-check').classList.remove('valid');
            }
            
            // Check for special characters
            if (/[^A-Za-z0-9]/.test(password)) {
                strength++;
                document.getElementById('special-check').classList.add('valid');
            } else {
                document.getElementById('special-check').classList.remove('valid');
            }
            
            // Update strength meter
            const strengthMeter = document.getElementById('password-strength');
            strengthMeter.className = 'password-strength strength-' + strength + ' mt-2 rounded-full';
        });
        
        // Form validation
        document.getElementById('signup-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic validation
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            if (password !== confirmPassword) {
                alert('Les mots de passe ne correspondent pas');
                return;
            }
            
            if (!document.getElementById('terms').checked) {
                alert('Veuillez accepter les conditions d\'utilisation');
                return;
            }
            
            // Form is valid - simulate submission
            alert('Inscription réussie ! Redirection...');
            // In a real app, you would submit the form to a server here
        });
        
        // Animate form on load
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.signup-card');
            form.classList.add('animate__animated', 'animate__fadeInUp');
        });
    </script>
</body>
</html>