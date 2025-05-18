<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forums et Discussions</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
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
    </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <header class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-indigo-400 mb-2">    Discussion</h1>
            <p class="text-gray-400">Partagez vos questions et connaissances</p>
        </header>

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
                        <div class="text-center py-8 text-gray-500">
                            <p>Chargement des forums...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section des messages -->
            <div class="lg:w-2/3">
                <div id="forumDetails" class="bg-gray-800 rounded-xl shadow-xl p-6 mb-6 hidden">
                    <!-- Détails du forum -->
                </div>

                <div id="messagesSection" class="bg-gray-800 rounded-xl shadow-xl p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-blue-300">Messages</h2>
                        <div id="messageCount" class="text-sm text-gray-400">0 message(s)</div>
                    </div>
                    
                    <div id="messagesContainer" class="space-y-4 max-h-[calc(100vh-350px)] overflow-y-auto scrollbar-custom pr-2">
                        <p class="text-gray-400 text-center py-8">Sélectionnez un forum pour voir les messages</p>
                    </div>

                    <!-- Formulaire d'envoi -->
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
        const apiBaseUrl = '/api/forums';
        let currentForumId = null;

        // Chargement initial
        window.addEventListener('DOMContentLoaded', () => loadForums());

        // Fonction principale de chargement des forums
        window.loadForums = async function() {
    const container = document.getElementById('forumsContainer');
    container.innerHTML = '<div>Chargement...</div>';

    try {
        const response = await axios.get(apiBaseUrl);
        
        // Vérification de la structure
        const forums = response.data?.data; // Accès à .data.data
        if (!Array.isArray(forums)) {
            throw new Error("Structure de données inattendue");
        }

        container.innerHTML = '';
        forums.forEach(forum => {
            const forumElement = document.createElement('div');
            forumElement.innerHTML = `
                <h3>${forum.title}</h3>
                <p>${forum.description}</p>
            `;
            container.appendChild(forumElement);
        });

    } catch (error) {
        console.error('Erreur:', error);
        container.innerHTML = '<div>Échec du chargement</div>';
    }
};

        // Affichage des messages d'un forum
        async function showForumMessages(forum) {
            currentForumId = forum.id;
            const detailsContainer = document.getElementById('forumDetails');
            
            try {
                const response = await axios.get(`${apiBaseUrl}/${forum.id}/messages`);
                const messages = response.data;

                // Mise à jour de l'interface
                detailsContainer.classList.remove('hidden');
                detailsContainer.innerHTML = `
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-indigo-300">${forum.title}</h3>
                            <p class="text-gray-300">${forum.description}</p>
                        </div>
                        <button onclick="hideForumDetails()" class="text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="space-y-4">
                        ${messages.map(message => `
                            <div class="message-card p-4 rounded-lg">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="font-medium text-indigo-200">${message.user?.name || 'Anonyme'}</span>
                                    <span class="text-xs text-gray-500">${new Date(message.created_at).toLocaleString()}</span>
                                </div>
                                <p class="text-gray-300">${message.content}</p>
                            </div>
                        `).join('')}
                    </div>
                `;

                document.getElementById('messageForm').classList.remove('hidden');
                document.getElementById('messageCount').textContent = `${messages.length} message(s)`;
                document.getElementById('messagesContainer').scrollTop = 0;
            } catch (error) {
                console.error('Erreur de chargement des messages:', error);
            }
        }

        // Masquer les détails
        function hideForumDetails() {
            document.getElementById('forumDetails').classList.add('hidden');
            document.getElementById('messageForm').classList.add('hidden');
            document.getElementById('messagesContainer').innerHTML = '<p class="text-gray-400 text-center py-8">Sélectionnez un forum pour voir les messages</p>';
            document.getElementById('messageCount').textContent = '0 message(s)';
            currentForumId = null;
        }

        // Envoi de message
        async function postMessage() {
            const content = document.getElementById('newMessageContent').value;
            if (!content || !currentForumId) return;

            try {
                await axios.post(`${apiBaseUrl}/${currentForumId}/messages`, {
                    content,
                    user_id: 1 // À remplacer par l'ID réel de l'utilisateur
                });
                document.getElementById('newMessageContent').value = '';
                await showForumMessages({ id: currentForumId });
            } catch (error) {
                console.error('Erreur lors de l\'envoi:', error);
            }
        }
    </script>
</body>
</html>