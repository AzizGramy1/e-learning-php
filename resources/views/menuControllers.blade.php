<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        /* Custom animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        .glow-on-hover {
            transition: box-shadow 0.3s ease;
        }
        .glow-on-hover:hover {
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.7);
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
            border-color: #3B82F6;
        }
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar-link {
            transition: all 0.2s ease;
        }
        .sidebar-link:hover {
            background-color: rgba(59, 130, 246, 0.2);
            transform: translateX(5px);
        }
        .sidebar-link.active {
            background-color: rgba(59, 130, 246, 0.4);
            border-left: 4px solid #3B82F6;
        }
        .menu-category {
            color: #9CA3AF;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
            padding-left: 1rem;
        }
        .content-section {
            display: none;
        }
        .content-section.active {
            display: block;
            animation: fadeInUp 0.5s ease-out;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 50;
                height: 100vh;
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }
            .sidebar-overlay.open {
                display: block;
            }
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 flex">
    <!-- Overlay for mobile sidebar -->
    <div id="sidebarOverlay" class="sidebar-overlay"></div>

    <!-- Sidebar Navigation -->
    <div id="sidebar" class="sidebar w-64 bg-gray-800 p-4 flex-shrink-0 h-screen sticky top-0 overflow-y-auto">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-blue-400">API Manager</h2>
            <button id="closeSidebar" class="md:hidden text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <nav>
            <div class="menu-category">Général</div>
            <ul class="space-y-1">
                <li>
                    <a href="#dashboard" class="sidebar-link flex items-center p-3 rounded-lg text-gray-300 hover:text-white active">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Tableau de bord
                    </a>
                </li>
            </ul>

            <div class="menu-category">Gestion des Cours</div>
            <ul class="space-y-1">
                <li>
                    <a href="#all-courses" class="sidebar-link flex items-center p-3 rounded-lg text-gray-300 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Tous les cours
                    </a>
                </li>
                <li>
                    <a href="#create-course" class="sidebar-link flex items-center p-3 rounded-lg text-gray-300 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Créer un cours
                    </a>
                </li>
                
            </ul>

            <div class="menu-category">Gestion des Utilisateurs</div>
            <ul class="space-y-1">
                <li>
                    <a href="#all-users" class="sidebar-link flex items-center p-3 rounded-lg text-gray-300 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Tous les utilisateurs
                    </a>
                </li>
                <li>
                    <a href="#create-user" class="sidebar-link flex items-center p-3 rounded-lg text-gray-300 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Créer un utilisateur
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-x-hidden">
        <!-- Mobile header with menu button -->
        <header class="md:hidden bg-gray-800 p-4 flex items-center justify-between sticky top-0 z-30">
            <h1 class="text-xl font-bold text-blue-400">API Manager</h1>
            <button id="openSidebar" class="text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </header>

        <div class="container mx-auto px-4 py-8">
            <!-- Dashboard Section -->
            <div id="dashboard" class="content-section active">
                <h1 class="text-3xl font-bold text-center mb-8 text-blue-400 animate__animated animate__fadeInDown">Tableau de bord</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-800 rounded-xl shadow-lg p-6 card-hover">
                        <h2 class="text-xl font-semibold mb-4 text-blue-300">Statistiques des cours</h2>
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-blue-400">24</div>
                                <div class="text-sm text-gray-400">Cours actifs</div>
                            </div>
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-green-400">156</div>
                                <div class="text-sm text-gray-400">Inscriptions</div>
                            </div>
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-purple-400">3</div>
                                <div class="text-sm text-gray-400">Niveaux</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-800 rounded-xl shadow-lg p-6 card-hover">
                        <h2 class="text-xl font-semibold mb-4 text-green-300">Statistiques des utilisateurs</h2>
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-blue-400">42</div>
                                <div class="text-sm text-gray-400">Utilisateurs</div>
                            </div>
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-yellow-400">12</div>
                                <div class="text-sm text-gray-400">Administrateurs</div>
                            </div>
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-green-400">30</div>
                                <div class="text-sm text-gray-400">Étudiants</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-800 rounded-xl shadow-lg p-6 card-hover">
                    <h2 class="text-xl font-semibold mb-4 text-purple-300">Activité récente</h2>
                    <div class="space-y-4">
                        <div class="flex items-start p-3 bg-gray-700 rounded-lg">
                            <div class="bg-blue-500 rounded-full p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">Nouveau cours créé</p>
                                <p class="text-sm text-gray-400">"Apprendre React Avancé" a été ajouté</p>
                                <p class="text-xs text-gray-500 mt-1">Il y a 2 heures</p>
                            </div>
                        </div>
                        <div class="flex items-start p-3 bg-gray-700 rounded-lg">
                            <div class="bg-green-500 rounded-full p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">Nouvel utilisateur</p>
                                <p class="text-sm text-gray-400">"Jean Dupont" s'est inscrit</p>
                                <p class="text-xs text-gray-500 mt-1">Il y a 5 heures</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- All Courses Section -->
            <div id="all-courses" class="content-section">
                <h1 class="text-3xl font-bold text-center mb-8 text-blue-400 animate__animated animate__fadeInDown">Tous les cours</h1>
                <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-8 card-hover">
                    <h2 class="text-xl font-semibold mb-4 text-blue-300">Lister tous les cours (GET /api/cours)</h2>
                    <button onclick="getAllCours()" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-6 rounded-lg glow-on-hover transition-all duration-300 transform hover:scale-105">
                        Tester
                    </button>
                    <div id="getAllResult" class="mt-4 p-4 bg-gray-700 rounded-lg hidden overflow-hidden transition-all duration-500 max-h-0">
                        <pre class="response text-green-200 overflow-auto max-h-96"></pre>
                    </div>
                </div>
            </div>

            <!-- Create Course Section -->
            <div id="create-course" class="content-section">
                <h1 class="text-3xl font-bold text-center mb-8 text-green-400 animate__animated animate__fadeInDown">Créer un cours</h1>
                <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-8 card-hover">
                    <h2 class="text-xl font-semibold mb-4 text-green-300">Créer un nouveau cours (POST /api/cours)</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-300 mb-1">Titre</label>
                            <input type="text" id="titre" class="w-full p-3 border border-gray-600 rounded-lg bg-gray-700 text-white input-focus transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-gray-300 mb-1">Description</label>
                            <input type="text" id="description" class="w-full p-3 border border-gray-600 rounded-lg bg-gray-700 text-white input-focus transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-gray-300 mb-1">Durée (heures)</label>
                            <input type="number" id="duree" class="w-full p-3 border border-gray-600 rounded-lg bg-gray-700 text-white input-focus transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-gray-300 mb-1">Niveau</label>
                            <select id="niveau" class="w-full p-3 border border-gray-600 rounded-lg bg-gray-700 text-white input-focus transition-all duration-200">
                                <option value="débutant">Débutant</option>
                                <option value="intermédiaire">Intermédiaire</option>
                                <option value="avancé">Avancé</option>
                            </select>
                        </div>
                    </div>
                    <button onclick="createCours()" class="bg-green-600 hover:bg-green-500 text-white font-bold py-3 px-6 rounded-lg glow-on-hover transition-all duration-300 transform hover:scale-105">
                        Créer
                    </button>
                    <div id="createResult" class="mt-4 p-4 bg-gray-700 rounded-lg hidden overflow-hidden transition-all duration-500 max-h-0">
                        <pre class="response text-green-200 overflow-auto max-h-96"></pre>
                    </div>
                </div>
            </div>

            <!-- All Users Section -->
            <div id="all-users" class="content-section">
                <h1 class="text-3xl font-bold text-center mb-8 text-purple-400 animate__animated animate__fadeInDown">Tous les utilisateurs</h1>
                <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-8 card-hover">
                    <h2 class="text-xl font-semibold mb-4 text-purple-300">Lister tous les utilisateurs (GET /api/users)</h2>
                    <button onclick="getAllUsers()" class="bg-purple-600 hover:bg-purple-500 text-white font-bold py-3 px-6 rounded-lg glow-on-hover transition-all duration-300 transform hover:scale-105">
                        Tester
                    </button>
                    <div id="getAllUsersResult" class="mt-4 p-4 bg-gray-700 rounded-lg hidden overflow-hidden transition-all duration-500 max-h-0">
                        <pre class="response text-green-200 overflow-auto max-h-96"></pre>
                    </div>
                </div>
            </div>

            <!-- Create User Section -->
            <div id="create-user" class="content-section">
                <h1 class="text-3xl font-bold text-center mb-8 text-yellow-400 animate__animated animate__fadeInDown">Créer un utilisateur</h1>
                <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-8 card-hover">
                    <h2 class="text-xl font-semibold mb-4 text-yellow-300">Créer un nouvel utilisateur (POST /api/users)</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-300 mb-1">Nom</label>
                            <input type="text" id="userNom" class="w-full p-3 border border-gray-600 rounded-lg bg-gray-700 text-white input-focus transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-gray-300 mb-1">Prénom</label>
                            <input type="text" id="userPrenom" class="w-full p-3 border border-gray-600 rounded-lg bg-gray-700 text-white input-focus transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-gray-300 mb-1">Email</label>
                            <input type="email" id="userEmail" class="w-full p-3 border border-gray-600 rounded-lg bg-gray-700 text-white input-focus transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-gray-300 mb-1">Rôle</label>
                            <select id="userRole" class="w-full p-3 border border-gray-600 rounded-lg bg-gray-700 text-white input-focus transition-all duration-200">
                                <option value="student">Étudiant</option>
                                <option value="teacher">Professeur</option>
                                <option value="admin">Administrateur</option>
                            </select>
                        </div>
                    </div>
                    <button onclick="createUser()" class="bg-yellow-600 hover:bg-yellow-500 text-white font-bold py-3 px-6 rounded-lg glow-on-hover transition-all duration-300 transform hover:scale-105">
                        Créer
                    </button>
                    <div id="createUserResult" class="mt-4 p-4 bg-gray-700 rounded-lg hidden overflow-hidden transition-all duration-500 max-h-0">
                        <pre class="response text-green-200 overflow-auto max-h-96"></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const baseUrl = '/api/cours';
        const usersBaseUrl = '/api/users';

        // Navigation functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Set up sidebar navigation
            const links = document.querySelectorAll('.sidebar-link');
            const sections = document.querySelectorAll('.content-section');
            
            // Activate dashboard by default
            document.querySelector('.sidebar-link').click();
            
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all links and sections
                    links.forEach(l => l.classList.remove('active'));
                    sections.forEach(s => s.classList.remove('active'));
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // Show corresponding section
                    const targetId = this.getAttribute('href').substring(1);
                    document.getElementById(targetId).classList.add('active');
                    
                    // Close sidebar on mobile
                    if (window.innerWidth < 768) {
                        document.getElementById('sidebar').classList.remove('open');
                        document.getElementById('sidebarOverlay').classList.remove('open');
                    }
                });
            });
            
            // Mobile sidebar toggle
            document.getElementById('openSidebar').addEventListener('click', function() {
                document.getElementById('sidebar').classList.add('open');
                document.getElementById('sidebarOverlay').classList.add('open');
            });
            
            document.getElementById('closeSidebar').addEventListener('click', function() {
                document.getElementById('sidebar').classList.remove('open');
                document.getElementById('sidebarOverlay').classList.remove('open');
            });
            
            document.getElementById('sidebarOverlay').addEventListener('click', function() {
                document.getElementById('sidebar').classList.remove('open');
                this.classList.remove('open');
            });
            
            // Add animation to all cards on page load
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });

        function displayResponse(elementId, data) {
            const container = document.getElementById(elementId);
            const preElement = container.querySelector('.response');
            
            // Format and highlight JSON
            let jsonString = JSON.stringify(data, null, 2);
            // Simple syntax highlighting
            jsonString = jsonString.replace(/("[\w]+":)/g, '<span class="text-blue-300">$1</span>');
            jsonString = jsonString.replace(/: ("[^"]+")/g, ': <span class="text-green-300">$1</span>');
            jsonString = jsonString.replace(/: (\d+)/g, ': <span class="text-yellow-300">$1</span>');
            
            preElement.innerHTML = jsonString;
            
            // Animate opening
            container.style.maxHeight = '500px';
            container.classList.remove('hidden');
            
            // Add pulse animation temporarily
            container.classList.add('animate__animated', 'animate__fadeIn');
            setTimeout(() => {
                container.classList.remove('animate__animated', 'animate__fadeIn');
            }, 1000);
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

        // Courses functions
        function getAllCours() {
            const btn = event.target;
            btn.classList.add('animate__animated', 'animate__pulse');
            setTimeout(() => btn.classList.remove('animate__animated', 'animate__pulse'), 1000);
            
            axios.get(baseUrl)
                .then(response => displayResponse('getAllResult', response.data))
                .catch(error => handleError(error, 'getAllResult'));
        }

        function createCours() {
            const btn = event.target;
            btn.classList.add('animate__animated', 'animate__pulse');
            setTimeout(() => btn.classList.remove('animate__animated', 'animate__pulse'), 1000);
            
            const coursData = {
                titre: document.getElementById('titre').value,
                description: document.getElementById('description').value,
                duree: document.getElementById('duree').value,
                niveau: document.getElementById('niveau').value
            };

            axios.post(baseUrl, coursData)
                .then(response => {
                    displayResponse('createResult', response.data);
                    // Reset form
                    document.getElementById('titre').value = '';
                    document.getElementById('description').value = '';
                    document.getElementById('duree').value = '';
                })
                .catch(error => handleError(error, 'createResult'));
        }

        // Users functions
        function getAllUsers() {
            const btn = event.target;
            btn.classList.add('animate__animated', 'animate__pulse');
            setTimeout(() => btn.classList.remove('animate__animated', 'animate__pulse'), 1000);
            
            axios.get(usersBaseUrl)
                .then(response => displayResponse('getAllUsersResult', response.data))
                .catch(error => handleError(error, 'getAllUsersResult'));
        }

        function createUser() {
            const btn = event.target;
            btn.classList.add('animate__animated', 'animate__pulse');
            setTimeout(() => btn.classList.remove('animate__animated', 'animate__pulse'), 1000);
            
            const userData = {
                nom: document.getElementById('userNom').value,
                prenom: document.getElementById('userPrenom').value,
                email: document.getElementById('userEmail').value,
                role: document.getElementById('userRole').value
            };

            axios.post(usersBaseUrl, userData)
                .then(response => {
                    displayResponse('createUserResult', response.data);
                    // Reset form
                    document.getElementById('userNom').value = '';
                    document.getElementById('userPrenom').value = '';
                    document.getElementById('userEmail').value = '';
                })
                .catch(error => handleError(error, 'createUserResult'));
        }
    </script>
</body>
</html>