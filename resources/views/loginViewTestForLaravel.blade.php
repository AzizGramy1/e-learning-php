<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - EduTech</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        /* Custom animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideInUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
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
        .card-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
        .btn-press {
            transition: all 0.2s ease;
        }
        .btn-press:active {
            transform: scale(0.98);
        }
        .glow-on-hover {
            transition: all 0.3s ease;
        }
        .glow-on-hover:hover {
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.5);
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }
        .shake {
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }
        @keyframes shake {
            10%, 90% { transform: translateX(-1px); }
            20%, 80% { transform: translateX(2px); }
            30%, 50%, 70% { transform: translateX(-4px); }
            40%, 60% { transform: translateX(4px); }
        }
    </style>
</head>
<body class="gradient-bg text-gray-100 min-h-screen flex items-center justify-center p-4">
    <!-- Login Container -->
    <div class="w-full max-w-md mx-auto animate__animated animate__fadeIn">
        <div class="bg-gray-800 bg-opacity-80 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl card-hover border border-gray-700 transition-all duration-500 hover:border-blue-500">
            <!-- Logo Header -->
            <div class="bg-gray-900 py-6 px-8 text-center">
                <div class="flex items-center justify-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                    </svg>
                    <span class="text-3xl font-bold text-gradient">EduTech</span>
                </div>
                <p class="text-gray-400 mt-2">Connectez-vous à votre compte</p>
            </div>
            
            <!-- Login Form -->
<form id="loginForm" method="POST" action="{{ route('login') }}" class="px-8 pt-8 pb-6">
    @csrf
                    <!-- Email Input -->
                <div class="mb-6 animate__animated animate__fadeInUp animate__delay-1s">
                    <label for="email" class="block text-gray-300 text-sm font-medium mb-2">Adresse email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            required
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-3 input-focus transition duration-300"
                            placeholder="votre@email.com"
                        >
                    </div>
                </div>
                
                <!-- Password Input -->
                <div class="mb-6 animate__animated animate__fadeInUp animate__delay-2s">
                    <label for="password" class="block text-gray-300 text-sm font-medium mb-2">Mot de passe</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-3 input-focus transition duration-300"
                            placeholder="••••••••"
                        >
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-blue-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex justify-end mt-2">
                        <a href="#" class="text-sm text-blue-400 hover:text-blue-300 transition-colors">Mot de passe oublié ?</a>
                    </div>
                </div>
                
                <!-- Remember Me & Submit -->
                <div class="mb-6 flex items-center animate__animated animate__fadeInUp animate__delay-3s">
                    <input id="remember" name="remember" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500">
                    <label for="remember" class="ml-2 text-sm text-gray-300">Se souvenir de moi</label>
                </div>
                
                <button 
                    type="submit" 
                    id="submitBtn"
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-medium py-3 px-4 rounded-lg glow-on-hover btn-press transition-all duration-300 mb-4 animate__animated animate__fadeInUp animate__delay-4s"
                >
                    <span id="btnText">Se connecter</span>
                    <span id="btnSpinner" class="hidden">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Connexion...
                    </span>
                </button>
                
                <!-- Social Login -->
                <div class="mb-6 animate__animated animate__fadeInUp animate__delay-5s">
                    <div class="flex items-center mb-4">
                        <div class="flex-1 border-t border-gray-600"></div>
                        <span class="px-3 text-gray-400 text-sm">Ou continuer avec</span>
                        <div class="flex-1 border-t border-gray-600"></div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <button 
                            type="button"
                            class="flex items-center justify-center bg-gray-700 hover:bg-gray-600 text-white py-2 px-4 rounded-lg transition-colors duration-300 btn-press"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 48 48">
                                <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                                <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                                <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                                <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                                <path fill="none" d="M0 0h48v48H0z"/>
                            </svg>
                            Google
                        </button>
                        <button 
                            type="button"
                            class="flex items-center justify-center bg-gray-700 hover:bg-gray-600 text-white py-2 px-4 rounded-lg transition-colors duration-300 btn-press"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24">
                                <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" fill="#3b5998"/>
                            </svg>
                            Facebook
                        </button>
                    </div>
                </div>
                
                <!-- Register Link -->
                <div class="text-center animate__animated animate__fadeInUp animate__delay-5s">
                    <p class="text-gray-400">Pas encore de compte ? 
                        <a href="#" class="text-blue-400 hover:text-blue-300 font-medium transition-colors">S'inscrire</a>
                    </p>
                </div>
            </form>
        </div>
        
        <!-- Floating Elements for Decoration -->
        <div class="absolute top-20 left-10 w-16 h-16 rounded-full bg-blue-500 opacity-10 animate-float hidden md:block"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 rounded-full bg-purple-500 opacity-10 animate-float animation-delay-2000 hidden md:block"></div>
        <div class="absolute top-1/3 right-1/4 w-12 h-12 rounded-full bg-green-500 opacity-10 animate-float animation-delay-3000 hidden md:block"></div>
    </div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    if (togglePassword) {
        const password = document.getElementById('password');
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // Change the icon
            this.innerHTML = type === 'password' ? 
                '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-blue-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>' :
                '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-blue-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>';
        });
    }
    
    // Form submission with AJAX
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');
        
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Clear previous errors
            document.querySelectorAll('.text-red-400, .bg-red-500').forEach(el => el.remove());
            document.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
            
            // Show loading state
            if (btnText && btnSpinner) {
                btnText.classList.add('hidden');
                btnSpinner.classList.remove('hidden');
            }
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('cursor-not-allowed', 'opacity-75');
            }
            
            try {
                const formData = new FormData(loginForm);
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                
                if (!csrfToken) {
                    throw new Error('CSRF token missing');
                }
                
                const response = await fetch(loginForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                
                const data = await response.json();
                
                if (!response.ok) {
                    throw data;
                }
                
                if (data.success) {
                    // Success animation
                    if (submitBtn) {
                        submitBtn.classList.remove('bg-blue-600', 'hover:bg-blue-500');
                        submitBtn.classList.add('bg-green-500', 'hover:bg-green-400');
                    }
                    if (btnSpinner) {
                        btnSpinner.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Connecté avec succès !
                        `;
                    }
                    
                    // Redirect after delay
                    setTimeout(() => {
                        window.location.href = data.redirect || "{{ route('welcomeDadh') }}";
                    }, 1000);
                } else {
                    throw new Error(data.message || 'Une erreur est survenue');
                }
            } catch (error) {
                // Reset button state
                if (btnText && btnSpinner) {
                    btnText.classList.remove('hidden');
                    btnSpinner.classList.add('hidden');
                }
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('cursor-not-allowed', 'opacity-75');
                }
                
                // Show errors
                const errorMessage = error.message || 
                                   (error.errors ? Object.values(error.errors)[0][0] : 'Identifiants incorrects');
                
                const errorElement = document.createElement('div');
                errorElement.className = 'mb-4 p-3 bg-red-500 bg-opacity-20 text-red-300 rounded-lg text-sm';
                errorElement.textContent = errorMessage;
                loginForm.prepend(errorElement);
                
                // Shake form for attention
                loginForm.classList.add('shake');
                setTimeout(() => loginForm.classList.remove('shake'), 500);
            }
        });
    }
    
    // Add animation to form inputs on focus
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement?.classList?.add('ring-2', 'ring-blue-500', 'rounded-lg');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement?.classList?.remove('ring-2', 'ring-blue-500', 'rounded-lg');
        });
    });
});
</script>


</body>
</html>