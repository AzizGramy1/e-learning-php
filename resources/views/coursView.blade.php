<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test API Cours</title>
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
    </style>
</head>
<body class="bg-gray-900 text-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center mb-12 text-blue-400 animate__animated animate__fadeInDown">Test des Endpoints API Cours</h1>
        
        <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-8 card-hover transition-all duration-300 fade-in-up" style="animation-delay: 0.1s">
            <h2 class="text-xl font-semibold mb-4 text-blue-300">1. Lister tous les cours (GET /api/cours)</h2>
            <button onclick="getAllCours()" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-6 rounded-lg glow-on-hover transition-all duration-300 transform hover:scale-105">
                Tester
            </button>
            <div id="getAllResult" class="mt-4 p-4 bg-gray-700 rounded-lg hidden overflow-hidden transition-all duration-500 max-h-0">
                <pre class="response text-green-200 overflow-auto max-h-96"></pre>
            </div>
        </div>

        <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-8 card-hover transition-all duration-300 fade-in-up" style="animation-delay: 0.2s">
            <h2 class="text-xl font-semibold mb-4 text-green-300">2. Créer un nouveau cours (POST /api/cours)</h2>
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

        <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-8 card-hover transition-all duration-300 fade-in-up" style="animation-delay: 0.3s">
            <h2 class="text-xl font-semibold mb-4 text-purple-300">3. Obtenir un cours spécifique (GET /api/cours/{id})</h2>
            <div class="flex items-center mb-4">
                <input type="number" id="coursId" placeholder="ID du cours" class="p-3 border border-gray-600 rounded-lg bg-gray-700 text-white flex-grow mr-3 input-focus transition-all duration-200">
                <button onclick="getCours()" class="bg-purple-600 hover:bg-purple-500 text-white font-bold py-3 px-6 rounded-lg glow-on-hover transition-all duration-300 transform hover:scale-105">
                    Chercher
                </button>
            </div>
            <div id="getOneResult" class="mt-4 p-4 bg-gray-700 rounded-lg hidden overflow-hidden transition-all duration-500 max-h-0">
                <pre class="response text-green-200 overflow-auto max-h-96"></pre>
            </div>
        </div>

        <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-8 card-hover transition-all duration-300 fade-in-up" style="animation-delay: 0.4s">
            <h2 class="text-xl font-semibold mb-4 text-yellow-300">4. Mettre à jour un cours (PUT /api/cours/{id})</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-300 mb-1">ID du cours à modifier</label>
                    <input type="number" id="updateId" class="w-full p-3 border border-gray-600 rounded-lg bg-gray-700 text-white input-focus transition-all duration-200">
                </div>
                <div>
                    <label class="block text-gray-300 mb-1">Nouveau titre</label>
                    <input type="text" id="updateTitre" class="w-full p-3 border border-gray-600 rounded-lg bg-gray-700 text-white input-focus transition-all duration-200">
                </div>
                <div>
                    <label class="block text-gray-300 mb-1">Nouvelle description</label>
                    <input type="text" id="updateDescription" class="w-full p-3 border border-gray-600 rounded-lg bg-gray-700 text-white input-focus transition-all duration-200">
                </div>
                <div>
                    <label class="block text-gray-300 mb-1">Nouvelle durée</label>
                    <input type="number" id="updateDuree" class="w-full p-3 border border-gray-600 rounded-lg bg-gray-700 text-white input-focus transition-all duration-200">
                </div>
            </div>
            <button onclick="updateCours()" class="bg-yellow-600 hover:bg-yellow-500 text-white font-bold py-3 px-6 rounded-lg glow-on-hover transition-all duration-300 transform hover:scale-105">
                Mettre à jour
            </button>
            <div id="updateResult" class="mt-4 p-4 bg-gray-700 rounded-lg hidden overflow-hidden transition-all duration-500 max-h-0">
                <pre class="response text-green-200 overflow-auto max-h-96"></pre>
            </div>
        </div>

        <div class="bg-gray-800 rounded-xl shadow-lg p-6 card-hover transition-all duration-300 fade-in-up" style="animation-delay: 0.5s">
            <h2 class="text-xl font-semibold mb-4 text-red-300">5. Supprimer un cours (DELETE /api/cours/{id})</h2>
            <div class="flex items-center mb-4">
                <input type="number" id="deleteId" placeholder="ID du cours" class="p-3 border border-gray-600 rounded-lg bg-gray-700 text-white flex-grow mr-3 input-focus transition-all duration-200">
                <button onclick="deleteCours()" class="bg-red-600 hover:bg-red-500 text-white font-bold py-3 px-6 rounded-lg glow-on-hover transition-all duration-300 transform hover:scale-105">
                    Supprimer
                </button>
            </div>
            <div id="deleteResult" class="mt-4 p-4 bg-gray-700 rounded-lg hidden overflow-hidden transition-all duration-500 max-h-0">
                <pre class="response text-green-200 overflow-auto max-h-96"></pre>
            </div>
        </div>
    </div>

    <script>
        const baseUrl = '/api/cours';

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

        function getCours() {
            const btn = event.target;
            btn.classList.add('animate__animated', 'animate__pulse');
            setTimeout(() => btn.classList.remove('animate__animated', 'animate__pulse'), 1000);
            
            const id = document.getElementById('coursId').value;
            if (!id) {
                alert('Veuillez entrer un ID');
                return;
            }

            axios.get(`${baseUrl}/${id}`)
                .then(response => displayResponse('getOneResult', response.data))
                .catch(error => handleError(error, 'getOneResult'));
        }

        function updateCours() {
            const btn = event.target;
            btn.classList.add('animate__animated', 'animate__pulse');
            setTimeout(() => btn.classList.remove('animate__animated', 'animate__pulse'), 1000);
            
            const id = document.getElementById('updateId').value;
            if (!id) {
                alert('Veuillez entrer un ID');
                return;
            }

            const updateData = {};
            if (document.getElementById('updateTitre').value) updateData.titre = document.getElementById('updateTitre').value;
            if (document.getElementById('updateDescription').value) updateData.description = document.getElementById('updateDescription').value;
            if (document.getElementById('updateDuree').value) updateData.duree = document.getElementById('updateDuree').value;

            axios.put(`${baseUrl}/${id}`, updateData)
                .then(response => displayResponse('updateResult', response.data))
                .catch(error => handleError(error, 'updateResult'));
        }

        function deleteCours() {
            const btn = event.target;
            btn.classList.add('animate__animated', 'animate__pulse');
            setTimeout(() => btn.classList.remove('animate__animated', 'animate__pulse'), 1000);
            
            const id = document.getElementById('deleteId').value;
            if (!id) {
                alert('Veuillez entrer un ID');
                return;
            }

            if (confirm(`Êtes-vous sûr de vouloir supprimer le cours #${id}?`)) {
                axios.delete(`${baseUrl}/${id}`)
                    .then(response => displayResponse('deleteResult', response.data))
                    .catch(error => handleError(error, 'deleteResult'));
            }
        }

        // Add animation to all cards on page load
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.fade-in-up');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>