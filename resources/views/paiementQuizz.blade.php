<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement - EduTech</title>
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
        .payment-card {
            background: linear-gradient(135deg, rgba(45, 55, 72, 0.8) 0%, rgba(26, 32, 44, 0.9) 100%);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            overflow: hidden;
        }
        .payment-method {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .payment-method:hover {
            transform: translateY(-3px);
            border-color: #3B82F6;
        }
        .payment-method.active {
            border-color: #3B82F6;
            background: rgba(59, 130, 246, 0.1);
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
        .credit-card {
            perspective: 1000px;
            transform-style: preserve-3d;
            transition: all 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .credit-card.flipped {
            transform: rotateY(180deg);
        }
        .card-front, .card-back {
            backface-visibility: hidden;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .card-back {
            transform: rotateY(180deg);
        }
        .card-logo {
            filter: brightness(0) invert(1);
            opacity: 0.8;
        }
        .card-chip {
            background: linear-gradient(135deg, #dddddd 0%, #aaaaaa 100%);
        }
        .card-cvv {
            background: repeating-linear-gradient(45deg, #f5f5f5, #f5f5f5 5px, #e0e0e0 5px, #e0e0e0 10px);
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
                <a href="#" class="text-blue-400 font-medium transition-colors duration-300">Abonnements</a>
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
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Progress Steps -->
            <div class="flex justify-between items-center mb-12 relative">
                <div class="flex-1 border-t-2 border-blue-600 absolute top-1/2 left-0 right-0 -z-10"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-sm text-blue-400">Choix de l'abonnement</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center mb-2">
                        <span class="text-white font-medium">2</span>
                    </div>
                    <span class="text-sm text-white">Méthode de paiement</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center mb-2">
                        <span class="text-gray-400 font-medium">3</span>
                    </div>
                    <span class="text-sm text-gray-400">Confirmation</span>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-8">
                <!-- Left Column - Order Summary -->
                <div class="md:w-1/3">
                    <div class="payment-card p-6 mb-6">
                        <h3 class="text-lg font-bold mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Récapitulatif
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center pb-4 border-b border-gray-700">
                                <span class="text-gray-400">Abonnement Premium</span>
                                <span class="font-medium">€19.99/mois</span>
                            </div>
                            <div class="flex justify-between items-center pb-4 border-b border-gray-700">
                                <span class="text-gray-400">Accès illimité</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="flex justify-between items-center pb-4 border-b border-gray-700">
                                <span class="text-gray-400">Certificats</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="flex justify-between items-center pb-4 border-b border-gray-700">
                                <span class="text-gray-400">Support prioritaire</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="flex justify-between items-center pt-2">
                                <span class="font-bold">Total</span>
                                <span class="text-xl font-bold text-blue-400">€19.99</span>
                            </div>
                        </div>
                    </div>

                    <div class="payment-card p-6">
                        <h3 class="text-lg font-bold mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            Paiement sécurisé
                        </h3>
                        <p class="text-sm text-gray-400 mb-4">Toutes les transactions sont sécurisées et cryptées.</p>
                        <div class="flex space-x-4">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/visa/visa-original.svg" class="h-8 opacity-70" alt="Visa">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mastercard/mastercard-original.svg" class="h-8 opacity-70" alt="Mastercard">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/apple/apple-original.svg" class="h-8 opacity-70" alt="Apple Pay">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/paypal/paypal-original.svg" class="h-8 opacity-70" alt="PayPal">
                        </div>
                    </div>
                </div>

                <!-- Right Column - Payment Methods -->
                <div class="md:w-2/3">
                    <div class="payment-card p-6 mb-6">
                        <h2 class="text-2xl font-bold mb-6">Méthode de paiement</h2>
                        
                        <!-- Payment Method Tabs -->
                        <div class="flex border-b border-gray-700 mb-6 relative">
                            <button id="card-tab" class="px-4 py-2 font-medium text-blue-400 focus:outline-none">
                                Carte bancaire
                            </button>
                            <button id="link-tab" class="px-4 py-2 font-medium text-gray-400 hover:text-white focus:outline-none">
                                Lien de paiement
                            </button>
                            <button id="direct-debit-tab" class="px-4 py-2 font-medium text-gray-400 hover:text-white focus:outline-none">
                                Prélèvement automatique
                            </button>
                            <div id="tab-indicator" class="absolute bottom-0 left-0 h-0.5 bg-blue-500 transition-all duration-300" style="width: 33.33%"></div>
                        </div>

                        <!-- Card Payment Form (Default Visible) -->
                        <div id="card-payment" class="payment-method-content">
                            <div class="mb-8">
                                <!-- Credit Card Visualization -->
                                <div class="credit-card relative w-full h-48 mb-8 mx-auto" id="credit-card">
                                    <div class="card-front absolute w-full h-full bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl p-6 shadow-lg">
                                        <div class="flex justify-between items-start mb-8">
                                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/visa/visa-original.svg" class="h-8 card-logo">
                                            <span class="text-white text-sm">Carte</span>
                                        </div>
                                        <div class="mb-6">
                                            <div class="card-chip w-12 h-8 rounded-md mb-2"></div>
                                            <div class="text-white text-xl tracking-widest mb-1" id="card-number-display">•••• •••• •••• ••••</div>
                                        </div>
                                        <div class="flex justify-between items-center text-white text-sm">
                                            <div>
                                                <div class="text-xs text-blue-200 mb-1">Titulaire de la carte</div>
                                                <div id="card-name-display">NOM PRÉNOM</div>
                                            </div>
                                            <div>
                                                <div class="text-xs text-blue-200 mb-1">Expire le</div>
                                                <div id="card-expiry-display">••/••</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-back absolute w-full h-full bg-gradient-to-r from-blue-700 to-blue-600 rounded-xl p-6 shadow-lg">
                                        <div class="h-8 bg-black w-full mb-4"></div>
                                        <div class="card-cvv h-10 rounded flex items-center justify-end px-4 mb-6">
                                            <span class="text-black font-bold" id="card-cvv-display">•••</span>
                                        </div>
                                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/visa/visa-original.svg" class="h-8 card-logo ml-auto">
                                    </div>
                                </div>

                                <!-- Card Form -->
                                <form id="payment-form">
                                    <div class="mb-4">
                                        <label for="card-number" class="block text-sm font-medium mb-2">Numéro de carte</label>
                                        <input type="text" id="card-number" class="w-full input-field rounded-lg px-4 py-3 focus:outline-none" placeholder="1234 5678 9012 3456" maxlength="19">
                                    </div>
                                    <div class="mb-4">
                                        <label for="card-name" class="block text-sm font-medium mb-2">Nom sur la carte</label>
                                        <input type="text" id="card-name" class="w-full input-field rounded-lg px-4 py-3 focus:outline-none" placeholder="Jean Dupont">
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 mb-6">
                                        <div>
                                            <label for="card-expiry" class="block text-sm font-medium mb-2">Date d'expiration</label>
                                            <input type="text" id="card-expiry" class="w-full input-field rounded-lg px-4 py-3 focus:outline-none" placeholder="MM/AA" maxlength="5">
                                        </div>
                                        <div>
                                            <label for="card-cvv" class="block text-sm font-medium mb-2">CVV</label>
                                            <div class="relative">
                                                <input type="text" id="card-cvv" class="w-full input-field rounded-lg px-4 py-3 focus:outline-none" placeholder="123" maxlength="3">
                                                <button type="button" onclick="document.getElementById('credit-card').classList.toggle('flipped')" class="absolute right-3 top-3 text-gray-400 hover:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center mb-6">
                                        <input type="checkbox" id="save-card" class="rounded text-blue-600 focus:ring-blue-500">
                                        <label for="save-card" class="ml-2 text-sm text-gray-400">Enregistrer cette carte pour des paiements futurs</label>
                                    </div>
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white py-3 px-6 rounded-lg glow-on-hover btn-press transition-all duration-300 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Payer €19.99
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Link Payment Form (Hidden by Default) -->
                        <div id="link-payment" class="payment-method-content hidden">
                            <div class="mb-6">
                                <div class="bg-gray-700 bg-opacity-50 rounded-lg p-6 mb-6">
                                    <h3 class="text-lg font-bold mb-3 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                        </svg>
                                        Envoyer un lien de paiement
                                    </h3>
                                    <p class="text-gray-400 mb-4">Un lien sécurisé sera envoyé à votre adresse email pour compléter le paiement.</p>
                                    <div class="mb-4">
                                        <label for="email" class="block text-sm font-medium mb-2">Adresse email</label>
                                        <input type="email" id="email" class="w-full input-field rounded-lg px-4 py-3 focus:outline-none" placeholder="votre@email.com" value="marie@example.com">
                                    </div>
                                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white py-3 px-6 rounded-lg glow-on-hover btn-press transition-all duration-300 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Envoyer le lien de paiement
                                    </button>
                                </div>
                                <div class="text-center text-gray-400 text-sm">
                                    <p>Vous recevrez un email avec un lien pour compléter votre paiement.</p>
                                    <p>Le lien expirera dans 24 heures.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Direct Debit Form (Hidden by Default) -->
                        <div id="direct-debit" class="payment-method-content hidden">
                            <div class="mb-6">
                                <div class="bg-gray-700 bg-opacity-50 rounded-lg p-6 mb-6">
                                    <h3 class="text-lg font-bold mb-3 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                        </svg>
                                        Prélèvement automatique
                                    </h3>
                                    <p class="text-gray-400 mb-4">Autorisez le prélèvement automatique mensuel de €19.99 sur votre compte bancaire.</p>
                                    
                                    <div class="mb-4">
                                        <label for="iban" class="block text-sm font-medium mb-2">IBAN</label>
                                        <input type="text" id="iban" class="w-full input-field rounded-lg px-4 py-3 focus:outline-none" placeholder="FR76 3000 1000 0100 0000 0000 123">
                                    </div>
                                    <div class="mb-4">
                                        <label for="bic" class="block text-sm font-medium mb-2">BIC/SWIFT</label>
                                        <input type="text" id="bic" class="w-full input-field rounded-lg px-4 py-3 focus:outline-none" placeholder="BNPAFRPPXXX">
                                    </div>
                                    <div class="mb-4">
                                        <label for="account-name" class="block text-sm font-medium mb-2">Nom du titulaire du compte</label>
                                        <input type="text" id="account-name" class="w-full input-field rounded-lg px-4 py-3 focus:outline-none" placeholder="Jean Dupont">
                                    </div>
                                    
                                    <div class="flex items-center mb-6">
                                        <input type="checkbox" id="accept-mandate" class="rounded text-blue-600 focus:ring-blue-500" required>
                                        <label for="accept-mandate" class="ml-2 text-sm text-gray-400">J'autorise EduTech à prélever €19.99 chaque mois jusqu'à résiliation. Je peux annuler à tout moment.</label>
                                    </div>
                                    
                                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white py-3 px-6 rounded-lg glow-on-hover btn-press transition-all duration-300 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Activer le prélèvement automatique
                                    </button>
                                </div>
                                <div class="text-center text-gray-400 text-sm">
                                    <p>Le premier prélèvement aura lieu aujourd'hui, puis le même jour chaque mois.</p>
                                    <p>Vous pouvez annuler à tout moment depuis votre espace membre.</p>
                                </div>
                            </div>
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
        // Payment Method Tabs
        const tabs = {
            'card-tab': 'card-payment',
            'link-tab': 'link-payment',
            'direct-debit-tab': 'direct-debit'
        };

        Object.keys(tabs).forEach(tabId => {
            document.getElementById(tabId).addEventListener('click', function() {
                // Hide all content
                document.querySelectorAll('.payment-method-content').forEach(content => {
                    content.classList.add('hidden');
                });
                
                // Show selected content
                document.getElementById(tabs[tabId]).classList.remove('hidden');
                
                // Update tab indicator position
                const tabIndex = Array.from(document.querySelectorAll('[id$="-tab"]')).indexOf(this);
                document.getElementById('tab-indicator').style.transform = `translateX(${tabIndex * 100}%)`;
                
                // Update tab colors
                document.querySelectorAll('[id$="-tab"]').forEach(tab => {
                    tab.classList.remove('text-blue-400');
                    tab.classList.add('text-gray-400', 'hover:text-white');
                });
                this.classList.remove('text-gray-400', 'hover:text-white');
                this.classList.add('text-blue-400');
            });
        });

        // Credit Card Input Formatting
        document.getElementById('card-number').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formatted = '';
            
            for (let i = 0; i < value.length && i < 16; i++) {
                if (i > 0 && i % 4 === 0) formatted += ' ';
                formatted += value[i];
            }
            
            e.target.value = formatted;
            document.getElementById('card-number-display').textContent = formatted || '•••• •••• •••• ••••';
        });

        document.getElementById('card-name').addEventListener('input', function(e) {
            document.getElementById('card-name-display').textContent = e.target.value.toUpperCase() || 'NOM PRÉNOM';
        });

        document.getElementById('card-expiry').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\//g, '').replace(/[^0-9]/gi, '');
            let formatted = '';
            
            for (let i = 0; i < value.length && i < 4; i++) {
                if (i === 2) formatted += '/';
                formatted += value[i];
            }
            
            e.target.value = formatted;
            document.getElementById('card-expiry-display').textContent = formatted || '••/••';
        });

        document.getElementById('card-cvv').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/gi, '').substring(0, 3);
            e.target.value = value;
            document.getElementById('card-cvv-display').textContent = value || '•••';
        });

        // Flip card when CVV field is focused
        document.getElementById('card-cvv').addEventListener('focus', function() {
            document.getElementById('credit-card').classList.add('flipped');
        });

        document.getElementById('card-cvv').addEventListener('blur', function() {
            document.getElementById('credit-card').classList.remove('flipped');
        });

        // Form submission
        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Here you would typically process the payment
            alert('Paiement en cours de traitement...');
        });
    </script>
</body>
</html>