<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test API Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        /* Custom dark theme */
        body {
            background-color: #0f172a;
            color: #e2e8f0;
        }
        .card {
            background-color: #1e293b;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
        }
        input, select, textarea {
            background-color: #334155;
            border-color: #475569;
            color: #e2e8f0;
            transition: all 0.2s ease;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #60a5fa;
            box-shadow: 0 0 0 2px rgba(96, 165, 250, 0.3);
        }
        .btn {
            transition: all 0.3s ease;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .btn:hover {
            transform: translateY(-1px);
        }
        .response-container {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 0.375rem;
            max-height: 300px;
            overflow-y: auto;
        }
        pre.response {
            color: #86efac;
            font-family: 'Courier New', monospace;
            white-space: pre-wrap;
        }
        table {
            border-color: #334155;
        }
        th {
            background-color: #334155;
        }
        tr:nth-child(even) {
            background-color: #1e293b;
        }
        tr:hover {
            background-color: #334155;
        }
        .glow {
            animation: glow 2s infinite alternate;
        }
        @keyframes glow {
            from {
                box-shadow: 0 0 5px -5px #60a5fa;
            }
            to {
                box-shadow: 0 0 10px 2px #60a5fa;
            }
        }
    </style>
</head>
<body class="bg-gray-900">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center mb-8 text-blue-400 animate__animated animate__fadeInDown">Test des Endpoints API Utilisateurs</h1>
        
        <!-- Section Authentification -->
        <div class="card p-6 mb-8 animate__animated animate__fadeIn">
            <h2 class="text-xl font-semibold mb-4 text-blue-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                Authentification
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-300 mb-1">Email</label>
                    <input type="email" id="authEmail" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" value="admin@example.com">
                </div>
                <div>
                    <label class="block text-gray-300 mb-1">Mot de passe</label>
                    <input type="password" id="authPassword" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" value="password">
                </div>
            </div>
            <div class="flex gap-4">
                <button onclick="login()" class="btn bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg glow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Se connecter
                </button>
                <button onclick="logout()" class="btn bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                    </svg>
                    Se déconnecter
                </button>
            </div>
            <div id="authStatus" class="mt-4 p-4 response-container hidden animate__animated animate__fadeIn">
                <pre class="response"></pre>
            </div>
        </div>

        <!-- Section CRUD Utilisateurs -->
        <div class="card p-6 mb-8 animate__animated animate__fadeIn animate__delay-1s">
            <h2 class="text-xl font-semibold mb-4 text-blue-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Gestion des Utilisateurs
            </h2>
            
            <!-- Liste des utilisateurs -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2 text-gray-300">1. Lister tous les utilisateurs</h3>
                <div class="flex gap-4 mb-4">
                    <input type="text" id="searchUsers" placeholder="Rechercher..." class="p-2 border rounded flex-grow focus:ring-2 focus:ring-blue-500">
                    <select id="roleFilter" class="p-2 border rounded focus:ring-2 focus:ring-blue-500">
                        <option value="">Tous les rôles</option>
                        <option value="etudiant">Étudiant</option>
                        <option value="formateur">Formateur</option>
                        <option value="administrateur">Administrateur</option>
                    </select>
                    <button onclick="getAllUsers()" class="btn bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                        Rechercher
                    </button>
                </div>
                <div id="usersList" class="border rounded p-4 bg-gray-800 overflow-x-auto">
                    <!-- Les utilisateurs seront affichés ici -->
                </div>
            </div>

            <!-- Création d'utilisateur -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2 text-gray-300">2. Créer un nouvel utilisateur</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-300 mb-1">Nom</label>
                        <input type="text" id="userNom" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-300 mb-1">Email</label>
                        <input type="email" id="userEmail" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-300 mb-1">Mot de passe</label>
                        <input type="password" id="userPassword" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-300 mb-1">Confirmation</label>
                        <input type="password" id="userPasswordConfirmation" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-300 mb-1">Rôle</label>
                        <select id="userRole" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="etudiant">Étudiant</option>
                            <option value="formateur">Formateur</option>
                            <option value="administrateur">Administrateur</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-300 mb-1">Avatar</label>
                        <input type="file" id="userAvatar" class="w-full p-2 border rounded file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                    </div>
                </div>
                <button onclick="createUser()" class="btn bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                    </svg>
                    Créer l'utilisateur
                </button>
                <div id="createUserResult" class="mt-4 p-4 response-container hidden animate__animated animate__fadeIn">
                    <pre class="response"></pre>
                </div>
            </div>

            <!-- Détails/Mise à jour d'un utilisateur -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2 text-gray-300">3. Voir/Mettre à jour un utilisateur</h3>
                <div class="flex items-center mb-4">
                    <input type="number" id="userId" placeholder="ID de l'utilisateur" class="p-2 border rounded mr-2 focus:ring-2 focus:ring-blue-500">
                    <button onclick="getUser()" class="btn bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                        Chercher
                    </button>
                </div>
                <div id="userDetails" class="hidden animate__animated animate__fadeIn">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-300 mb-1">Nom</label>
                            <input type="text" id="updateNom" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-gray-300 mb-1">Email</label>
                            <input type="email" id="updateEmail" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-gray-300 mb-1">Nouveau mot de passe</label>
                            <input type="password" id="updatePassword" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-gray-300 mb-1">Confirmation</label>
                            <input type="password" id="updatePasswordConfirmation" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-gray-300 mb-1">Rôle</label>
                            <select id="updateRole" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">
                                <option value="etudiant">Étudiant</option>
                                <option value="formateur">Formateur</option>
                                <option value="administrateur">Administrateur</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-300 mb-1">Nouvel avatar</label>
                            <input type="file" id="updateAvatar" class="w-full p-2 border rounded file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <button onclick="updateUser()" class="btn bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Mettre à jour
                        </button>
                        <button onclick="deleteUser()" class="btn bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Supprimer
                        </button>
                    </div>
                </div>
                <div id="userResult" class="mt-4 p-4 response-container hidden animate__animated animate__fadeIn">
                    <pre class="response"></pre>
                </div>
            </div>
        </div>

        <!-- Section Profil -->
        <div class="card p-6 mb-8 animate__animated animate__fadeIn animate__delay-2s">
            <h2 class="text-xl font-semibold mb-4 text-blue-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Profil Utilisateur
            </h2>
            
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2 text-gray-300">1. Voir mon profil</h3>
                <button onclick="getProfile()" class="btn bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    Récupérer mon profil
                </button>
                <div id="profileDetails" class="mt-4 p-4 response-container hidden animate__animated animate__fadeIn">
                    <pre class="response"></pre>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-medium mb-2 text-gray-300">2. Mettre à jour mon profil</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-300 mb-1">Nom</label>
                        <input type="text" id="profileNom" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-300 mb-1">Email</label>
                        <input type="email" id="profileEmail" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-300 mb-1">Nouveau mot de passe</label>
                        <input type="password" id="profilePassword" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-300 mb-1">Confirmation</label>
                        <input type="password" id="profilePasswordConfirmation" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-300 mb-1">Nouvel avatar</label>
                        <input type="file" id="profileAvatar" class="w-full p-2 border rounded file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                    </div>
                </div>
                <button onclick="updateProfile()" class="btn bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    Mettre à jour mon profil
                </button>
                <div id="updateProfileResult" class="mt-4 p-4 response-container hidden animate__animated animate__fadeIn">
                    <pre class="response"></pre>
                </div>
            </div>
        </div>

        <!-- Section Relations -->
        <div class="card p-6 animate__animated animate__fadeIn animate__delay-3s">
            <h2 class="text-xl font-semibold mb-4 text-blue-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Relations Utilisateur
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-300 mb-1">ID de l'utilisateur</label>
                    <input type="number" id="relationUserId" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <button onclick="getUserCertificats()" class="btn bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-lg transition-all duration-300 hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    Certificats
                </button>
                <button onclick="getUserMessages()" class="btn bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg transition-all duration-300 hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" />
                    </svg>
                    Messages
                </button>
                <button onclick="getUserPaiements()" class="btn bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-all duration-300 hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                    </svg>
                    Paiements
                </button>
                <button onclick="getUserRapports()" class="btn bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-lg transition-all duration-300 hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd" />
                    </svg>
                    Rapports
                </button>
            </div>

            <div id="relationsResult" class="mt-4 p-4 response-container hidden animate__animated animate__fadeIn">
                <pre class="response"></pre>
            </div>
        </div>
    </div>

    <script>
        // Configuration de base
        const baseUrl = '/api/users';
        let authToken = localStorage.getItem('authToken') || '';
        
        // Configuration d'Axios pour inclure le token
        axios.defaults.headers.common['Authorization'] = `Bearer ${authToken}`;
        axios.defaults.headers.common['Accept'] = 'application/json';
        axios.defaults.headers.common['Content-Type'] = 'application/json';

        // Fonctions utilitaires
        function displayResponse(elementId, data) {
            const container = document.getElementById(elementId);
            container.querySelector('.response').textContent = JSON.stringify(data, null, 2);
            container.classList.remove('hidden');
            container.classList.add('animate__fadeIn');
        }

        function handleError(error, elementId) {
            let errorMessage = 'Erreur inconnue';
            if (error.response) {
                errorMessage = `Erreur ${error.response.status}: ${JSON.stringify(error.response.data, null, 2)}`;
            } else if (error.request) {
                errorMessage = 'Pas de réponse du serveur';
            } else {
                errorMessage = error.message;
            }
            displayResponse(elementId, { error: errorMessage });
        }

        function formDataToObject(formData) {
            const object = {};
            formData.forEach((value, key) => {
                if (key !== 'avatar' && key !== 'updateAvatar' && key !== 'profileAvatar') {
                    object[key] = value;
                }
            });
            return object;
        }

        // Fonctions d'authentification
        function login() {
            const credentials = {
                email: document.getElementById('authEmail').value,
                password: document.getElementById('authPassword').value
            };

            axios.post('/api/login', credentials)
                .then(response => {
                    authToken = response.data.token;
                    localStorage.setItem('authToken', authToken);
                    axios.defaults.headers.common['Authorization'] = `Bearer ${authToken}`;
                    displayResponse('authStatus', { 
                        status: 'Connecté', 
                        token: authToken,
                        user: response.data.user 
                    });
                })
                .catch(error => handleError(error, 'authStatus'));
        }

        function logout() {
            axios.post('/api/logout')
                .then(() => {
                    authToken = '';
                    localStorage.removeItem('authToken');
                    axios.defaults.headers.common['Authorization'] = '';
                    displayResponse('authStatus', { status: 'Déconnecté' });
                })
                .catch(error => handleError(error, 'authStatus'));
        }

        // Fonctions CRUD utilisateurs
        function getAllUsers() {
            const params = {
                search: document.getElementById('searchUsers').value,
                role: document.getElementById('roleFilter').value
            };

            axios.get(baseUrl, { params })
                .then(response => {
                    const usersList = document.getElementById('usersList');
                    usersList.innerHTML = '';
                    
                    if (response.data.data.length === 0) {
                        usersList.innerHTML = '<p class="text-gray-500">Aucun utilisateur trouvé</p>';
                        return;
                    }

                    const table = document.createElement('table');
                    table.className = 'w-full border-collapse';
                    
                    // En-tête du tableau
                    const thead = document.createElement('thead');
                    thead.innerHTML = `
                        <tr class="bg-gray-700">
                            <th class="p-2 border border-gray-600">ID</th>
                            <th class="p-2 border border-gray-600">Nom</th>
                            <th class="p-2 border border-gray-600">Email</th>
                            <th class="p-2 border border-gray-600">Rôle</th>
                            <th class="p-2 border border-gray-600">Actions</th>
                        </tr>
                    `;
                    table.appendChild(thead);
                    
                    // Corps du tableau
                    const tbody = document.createElement('tbody');
                    response.data.data.forEach(user => {
                        const tr = document.createElement('tr');
                        tr.className = 'hover:bg-gray-700 transition-colors';
                        tr.innerHTML = `
                            <td class="p-2 border border-gray-600">${user.id}</td>
                            <td class="p-2 border border-gray-600">${user.nom}</td>
                            <td class="p-2 border border-gray-600">${user.email}</td>
                            <td class="p-2 border border-gray-600">${user.role}</td>
                            <td class="p-2 border border-gray-600">
                                <button onclick="loadUserForUpdate(${user.id})" class="text-blue-400 hover:text-blue-300 transition-colors">
                                    Modifier
                                </button>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });
                    table.appendChild(tbody);
                    
                    usersList.appendChild(table);
                })
                .catch(error => handleError(error, 'usersList'));
        }

        function loadUserForUpdate(userId) {
            document.getElementById('userId').value = userId;
            getUser();
        }

        function createUser() {
            const formData = new FormData();
            formData.append('nom', document.getElementById('userNom').value);
            formData.append('email', document.getElementById('userEmail').value);
            formData.append('mot_de_passe', document.getElementById('userPassword').value);
            formData.append('mot_de_passe_confirmation', document.getElementById('userPasswordConfirmation').value);
            formData.append('role', document.getElementById('userRole').value);
            
            const avatarFile = document.getElementById('userAvatar').files[0];
            if (avatarFile) {
                formData.append('avatar', avatarFile);
            }

            axios.post(baseUrl, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                displayResponse('createUserResult', response.data);
                getAllUsers(); // Rafraîchir la liste
            })
            .catch(error => handleError(error, 'createUserResult'));
        }

        function getUser() {
            const id = document.getElementById('userId').value;
            if (!id) return alert('Veuillez entrer un ID');

            axios.get(`${baseUrl}/${id}`)
                .then(response => {
                    const user = response.data.data;
                    document.getElementById('updateNom').value = user.nom;
                    document.getElementById('updateEmail').value = user.email;
                    document.getElementById('updateRole').value = user.role;
                    
                    const userDetails = document.getElementById('userDetails');
                    userDetails.classList.remove('hidden');
                    userDetails.classList.add('animate__fadeIn');
                    displayResponse('userResult', response.data);
                })
                .catch(error => handleError(error, 'userResult'));
        }

        function updateUser() {
            const id = document.getElementById('userId').value;
            if (!id) return alert('Veuillez entrer un ID');

            const formData = new FormData();
            formData.append('nom', document.getElementById('updateNom').value);
            formData.append('email', document.getElementById('updateEmail').value);
            formData.append('role', document.getElementById('updateRole').value);
            
            const newPassword = document.getElementById('updatePassword').value;
            if (newPassword) {
                formData.append('mot_de_passe', newPassword);
                formData.append('mot_de_passe_confirmation', document.getElementById('updatePasswordConfirmation').value);
            }
            
            const avatarFile = document.getElementById('updateAvatar').files[0];
            if (avatarFile) {
                formData.append('avatar', avatarFile);
            }

            axios.post(`${baseUrl}/${id}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'X-HTTP-Method-Override': 'PUT'
                }
            })
            .then(response => {
                displayResponse('userResult', response.data);
                getAllUsers(); // Rafraîchir la liste
            })
            .catch(error => handleError(error, 'userResult'));
        }

        function deleteUser() {
            const id = document.getElementById('userId').value;
            if (!id) return alert('Veuillez entrer un ID');

            if (confirm(`Êtes-vous sûr de vouloir supprimer l'utilisateur #${id}?`)) {
                axios.delete(`${baseUrl}/${id}`)
                    .then(response => {
                        displayResponse('userResult', response.data);
                        document.getElementById('userDetails').classList.add('hidden');
                        getAllUsers(); // Rafraîchir la liste
                    })
                    .catch(error => handleError(error, 'userResult'));
            }
        }

        // Fonctions de profil
        function getProfile() {
            axios.get('/api/profile')
                .then(response => {
                    const user = response.data.data;
                    document.getElementById('profileNom').value = user.nom;
                    document.getElementById('profileEmail').value = user.email;
                    displayResponse('profileDetails', response.data);
                })
                .catch(error => handleError(error, 'profileDetails'));
        }

        function updateProfile() {
            const formData = new FormData();
            formData.append('nom', document.getElementById('profileNom').value);
            formData.append('email', document.getElementById('profileEmail').value);
            
            const newPassword = document.getElementById('profilePassword').value;
            if (newPassword) {
                formData.append('mot_de_passe', newPassword);
                formData.append('mot_de_passe_confirmation', document.getElementById('profilePasswordConfirmation').value);
            }
            
            const avatarFile = document.getElementById('profileAvatar').files[0];
            if (avatarFile) {
                formData.append('avatar', avatarFile);
            }

            axios.post('/api/profile', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'X-HTTP-Method-Override': 'PUT'
                }
            })
            .then(response => {
                displayResponse('updateProfileResult', response.data);
                getProfile(); // Rafraîchir les données du profil
            })
            .catch(error => handleError(error, 'updateProfileResult'));
        }

        // Fonctions des relations
        function getUserCertificats() {
            const userId = document.getElementById('relationUserId').value;
            if (!userId) return alert('Veuillez entrer un ID utilisateur');

            axios.get(`${baseUrl}/${userId}/certificats`)
                .then(response => displayResponse('relationsResult', response.data))
                .catch(error => handleError(error, 'relationsResult'));
        }

        function getUserMessages() {
            const userId = document.getElementById('relationUserId').value;
            if (!userId) return alert('Veuillez entrer un ID utilisateur');

            axios.get(`${baseUrl}/${userId}/messages`)
                .then(response => displayResponse('relationsResult', response.data))
                .catch(error => handleError(error, 'relationsResult'));
        }

        function getUserPaiements() {
            const userId = document.getElementById('relationUserId').value;
            if (!userId) return alert('Veuillez entrer un ID utilisateur');

            axios.get(`${baseUrl}/${userId}/paiements`)
                .then(response => displayResponse('relationsResult', response.data))
                .catch(error => handleError(error, 'relationsResult'));
        }

        function getUserRapports() {
            const userId = document.getElementById('relationUserId').value;
            if (!userId) return alert('Veuillez entrer un ID utilisateur');

            axios.get(`${baseUrl}/${userId}/rapports`)
                .then(response => displayResponse('relationsResult', response.data))
                .catch(error => handleError(error, 'relationsResult'));
        }

        // Chargement initial si token existe
        if (authToken) {
            getProfile();
            getAllUsers();
        }
    </script>
</body>
</html>