<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forums et Discussions</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        /* Animations et styles personnalisés */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in { animation: fadeIn 0.4s ease-out forwards; }
        .forum-card { 
            border-left: 4px solid #6366f1;
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        }
        .message-card {
            border-left: 3px solid #4f46e5;
            background: rgba(31, 41, 55, 0.7);
        }
        .scrollbar-custom::-webkit-scrollbar { width: 6px; }
        .scrollbar-custom::-webkit-scrollbar-track { background: #1f2937; }
        .scrollbar-custom::-webkit-scrollbar-thumb { background: #4f46e5; border-radius: 3px; }
        .grid-forums {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- En-tête -->
        <header class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-indigo-400 mb-2">Forums de Discussion</h1>
            <p class="text-gray-400">Partagez vos questions et connaissances</p>
        </header>

        <!-- Conteneur principal -->
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Section des forums -->
            <div class="lg:w-1/3">
                <div class="bg-gray-800 rounded-xl shadow-xl p-6 sticky top-4">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-indigo-300">Liste des Forums</h2>
                        <button onclick="loadForums()" class="text-indigo-400 hover:text-indigo-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </button>
                    </div>
                    
                    <div id="forumsContainer" class="space-y-4 max-h-[calc(100vh-200px)] overflow-y-auto scrollbar-custom">
                        <!-- Les forums seront chargés ici -->
                        <div class="text-center py-8 text-gray-500">
                            <p>Chargement des forums...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section des messages -->
            <div class="lg:w-2/3">
                <div id="forumDetails" class="bg-gray-800 rounded-xl shadow-xl p-6 mb-6 hidden">
                    <!-- Détails du forum sélectionné -->
                </div>

                <div id="messagesSection" class="bg-gray-800 rounded-xl shadow-xl p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-blue-300">Messages</h2>
                        <div id="messageCount" class="text-sm text-gray-400">0 message(s)</div>
                    </div>
                    
                    <div id="messagesContainer" class="space-y-4 max-h-[calc(100vh-350px)] overflow-y-auto scrollbar-custom pr-2">
                        <p class="text-gray-400 text-center py-8">Sélectionnez un forum pour voir les messages</p>
                    </div>

                    <!-- Formulaire d'envoi de message -->
                    <div id="messageForm" class="mt-6 pt-4 border-t border-gray-700 hidden">
                        <h3 class="text-lg font-semibold text-green-300 mb-3">Nouveau Message</h3>
                        <textarea id="newMessageContent" rows="3" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white mb-3" placeholder="Écrivez votre message ici..."></textarea>
                        <div class="flex justify-end">
                            <button onclick="postMessage()" class="bg-green-600 hover:bg-green-500 text-white py-2 px-6 rounded-lg">
                                Envoyer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Configuration de base
        const apiBaseUrl = '/api/forums';
        let currentForumId = null;
        let currentUserId = 1; // À remplacer par l'ID de l'utilisateur connecté

        // Chargement initial
        document.addEventListener('DOMContentLoaded', function() {
            loadForums();
        });

        // Charger la liste des forums
        function loadForums() {
            const container = document.getElementById('forumsContainer');
            container.innerHTML = '<div class="text-center py-8 text-gray-500"><p>Chargement en cours...</p></div>';

            axios.get(apiBaseUrl)
                .then(response => {
                    if (response.data.data.length === 0) {
                        container.innerHTML = '<div class="text-center py-8 text-gray-500"><p>Aucun forum disponible</p></div>';
                        return;
                    }

                    container.innerHTML = '';
                    response.data.data.forEach(forum => {
                        const forumElement = document.createElement('div');
                        forumElement.className = 'forum-card p-4 rounded-lg cursor-pointer hover:bg-gray-700 transition';
                        forumElement.innerHTML = `
                            <h3 class="font-bold text-indigo-200">${forum.titre}</h3>
                            <p class="text-sm text-gray-400 mt-1 truncate">${forum.description}</p>
                            <div class="flex justify-between items-center mt-3 text-xs text-gray-500">
                                <span>Par utilisateur #${forum.utilisateur_id}</span>
                                <span>${new Date(forum.created_at).toLocaleDateString()}</span>
                            </div>
                        `;
                        forumElement.addEventListener('click', () => showForumMessages(forum));
                        container.appendChild(forumElement);
                    });
                })
                .catch(error => {
                    console.error('Erreur de chargement des forums:', error);
                    container.innerHTML = '<div class="text-center py-8 text-red-400"><p>Erreur de chargement</p></div>';
                });
        }

        // Afficher les messages d'un forum spécifique
        function showForumMessages(forum) {
            currentForumId = forum.id;
            
            // Afficher les détails du forum
            const detailsContainer = document.getElementById('forumDetails');
            detailsContainer.classList.remove('hidden');
            detailsContainer.innerHTML = `
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-indigo-300">${forum.titre}</h3>
                        <p class="text-gray-300">${forum.description}</p>
                    </div>
                    <button onclick="hideForumDetails()" class="text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="grid grid-cols-3 gap-2 text-sm">
                    <div class="bg-gray-700 p-2 rounded">
                        <p class="text-gray-400">Cours</p>
                        <p class="text-indigo-300">#${forum.cours_id}</p>
                    </div>
                    <div class="bg-gray-700 p-2 rounded">
                        <p class="text-gray-400">Créé par</p>
                        <p class="text-indigo-300">#${forum.utilisateur_id}</p>
                    </div>
                    <div class="bg-gray-700 p-2 rounded">
                        <p class="text-gray-400">Date</p>
                        <p class="text-indigo-300">${new Date(forum.created_at).toLocaleDateString()}</p>
                    </div>
                </div>
            `;

            // Activer le formulaire de message
            document.getElementById('messageForm').classList.remove('hidden');
            
            // Charger les messages du forum
            loadMessages();
        }

        // Masquer les détails du forum
        function hideForumDetails() {
            document.getElementById('forumDetails').classList.add('hidden');
            document.getElementById('messageForm').classList.add('hidden');
            document.getElementById('messagesContainer').innerHTML = '<p class="text-gray-400 text-center py-8">Sélectionnez un forum pour voir les messages</p>';
            document.getElementById('messageCount').textContent = '0 message(s)';
            currentForumId = null;
        }

        // Charger les messages du forum sélectionné
        function loadMessages() {
            if (!currentForumId) return;

            const container = document.getElementById('messagesContainer');
            container.innerHTML = '<div class="text-center py-8 text-gray-500"><p>Chargement des messages...</p></div>';

            axios.get(`${apiBaseUrl}/${currentForumId}/messages`)
                .then(response => {
                    const messages = response.data.data;
                    document.getElementById('messageCount').textContent = `${messages.length} message(s)`;

                    if (messages.length === 0) {
                        container.innerHTML = '<div class="text-center py-8 text-gray-500"><p>Aucun message dans ce forum</p></div>';
                        return;
                    }

                    container.innerHTML = '';
                    messages.forEach(message => {
                        const messageElement = document.createElement('div');
                        messageElement.className = 'message-card p-4 rounded-lg';
                        messageElement.innerHTML = `
                            <div class="flex justify-between items-start mb-2">
                                <span class="font-medium text-indigo-200">Utilisateur #${message.utilisateur_id}</span>
                                <span class="text-xs text-gray-500">${new Date(message.created_at).toLocaleString()}</span>
                            </div>
                            <p class="text-gray-300">${message.contenu}</p>
                            ${message.utilisateur_id === currentUserId ? `
                            <div class="flex justify-end space-x-2 mt-3">
                                <button onclick="editMessage(${message.id})" class="text-xs text-yellow-400 hover:text-yellow-300">Modifier</button>
                                <button onclick="deleteMessage(${message.id})" class="text-xs text-red-400 hover:text-red-300">Supprimer</button>
                            </div>
                            ` : ''}
                        `;
                        container.appendChild(messageElement);
                    });
                    
                    // Faire défiler vers le bas pour voir les nouveaux messages
                    container.scrollTop = container.scrollHeight;
                })
                .catch(error => {
                    console.error('Erreur de chargement des messages:', error);
                    container.innerHTML = '<div class="text-center py-8 text-red-400"><p>Erreur de chargement</p></div>';
                });
        }

        // Poster un nouveau message
        function postMessage() {
            if (!currentForumId) return;

            const content = document.getElementById('newMessageContent').value;
            if (!content) {
                alert('Veuillez écrire un message');
                return;
            }

            axios.post('/api/messages', {
                contenu: content,
                forum_id: currentForumId,
                utilisateur_id: currentUserId
            })
            .then(() => {
                document.getElementById('newMessageContent').value = '';
                loadMessages();
            })
            .catch(error => {
                console.error('Erreur lors de l\'envoi du message:', error);
                alert('Erreur lors de l\'envoi du message');
            });
        }

        // Modifier un message
        function editMessage(messageId) {
            const newContent = prompt('Modifier votre message:');
            if (newContent) {
                axios.put(`/api/messages/${messageId}`, {
                    contenu: newContent
                })
                .then(() => {
                    loadMessages();
                })
                .catch(error => {
                    console.error('Erreur lors de la modification:', error);
                    alert('Erreur lors de la modification');
                });
            }
        }

        // Supprimer un message
        function deleteMessage(messageId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce message ?')) {
                axios.delete(`/api/messages/${messageId}`)
                    .then(() => {
                        loadMessages();
                    })
                    .catch(error => {
                        console.error('Erreur lors de la suppression:', error);
                        alert('Erreur lors de la suppression');
                    });
            }
        }
    </script>
</body>
</html>