<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Certificats</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        /* Animations personnalisées */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }
        .glow-effect {
            transition: box-shadow 0.3s ease;
        }
        .glow-effect:hover {
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.5);
        }
        .certificate-card {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            border-left: 4px solid #6366f1;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <header class="mb-12 text-center fade-in">
            <h1 class="text-4xl font-bold text-indigo-400 mb-2 animate__animated animate__fadeInDown">Gestion des Certificats</h1>
            <p class="text-gray-400 max-w-2xl mx-auto">Visualisez et gérez tous les certificats délivrés dans votre plateforme</p>
        </header>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Certificats List -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-gray-800 rounded-xl shadow-xl p-6 card-hover fade-in" style="animation-delay: 0.1s">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-indigo-300">Liste des Certificats</h2>
                        <button onclick="loadCertificates()" class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg glow-effect flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                            </svg>
                            Actualiser
                        </button>
                    </div>
                    
                    <div id="certificatesContainer" class="space-y-4">
                        <!-- Certificats will be loaded here -->
                        <div class="text-center py-8 text-gray-500">
                            <p>Chargement des certificats...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions Panel -->
            <div class="space-y-6">
                <!-- Create Certificate -->
                <div class="bg-gray-800 rounded-xl shadow-xl p-6 card-hover fade-in" style="animation-delay: 0.2s">
                    <h2 class="text-2xl font-semibold text-green-300 mb-4">Créer un Certificat</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-400 mb-1">ID Utilisateur</label>
                            <input type="text" id="userId" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-gray-400 mb-1">ID Cours</label>
                            <input type="text" id="courseId" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-gray-400 mb-1">Code Certificat</label>
                            <input type="text" id="certificateCode" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        </div>
                        <button onclick="createCertificate()" class="w-full bg-green-600 hover:bg-green-500 text-white py-3 px-4 rounded-lg glow-effect flex justify-center items-center transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            Générer Certificat
                        </button>
                    </div>
                </div>

                <!-- Certificate Details -->
                <div class="bg-gray-800 rounded-xl shadow-xl p-6 card-hover fade-in" style="animation-delay: 0.3s">
                    <h2 class="text-2xl font-semibold text-purple-300 mb-4">Détails du Certificat</h2>
                    <div id="certificateDetails" class="p-4 bg-gray-700 rounded-lg">
                        <p class="text-gray-400 text-center py-8">Sélectionnez un certificat pour voir les détails</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Base API URL
        const apiBaseUrl = '/api/certificats';

        // Load certificates on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadCertificates();
            
            // Add animation to all fade-in elements
            const fadeElements = document.querySelectorAll('.fade-in');
            fadeElements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
        });

        // Load all certificates
        function loadCertificates() {
            const container = document.getElementById('certificatesContainer');
            container.innerHTML = '<div class="text-center py-8 text-gray-500"><p>Chargement en cours...</p></div>';

            axios.get(apiBaseUrl)
                .then(response => {
                    if (response.data.length === 0) {
                        container.innerHTML = '<div class="text-center py-8 text-gray-500"><p>Aucun certificat trouvé</p></div>';
                        return;
                    }

                    container.innerHTML = '';
                    response.data.forEach(cert => {
                        const certElement = document.createElement('div');
                        certElement.className = 'certificate-card p-4 rounded-lg cursor-pointer transition-all duration-300 hover:bg-gray-700';
                        certElement.innerHTML = `
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-indigo-200">Certificat #${cert.id}</h3>
                                    <p class="text-sm text-gray-400">Code: ${cert.code_certificat}</p>
                                </div>
                                <span class="bg-indigo-900 text-indigo-300 text-xs px-2 py-1 rounded-full">${cert.date_émission}</span>
                            </div>
                            <div class="mt-2">
                                <p class="text-sm"><span class="text-gray-400">Utilisateur:</span> ${cert.utilisateur_id}</p>
                                <p class="text-sm"><span class="text-gray-400">Cours:</span> ${cert.cours_id}</p>
                            </div>
                        `;
                        certElement.addEventListener('click', () => showCertificateDetails(cert));
                        container.appendChild(certElement);
                    });
                })
                .catch(error => {
                    console.error('Error loading certificates:', error);
                    container.innerHTML = '<div class="text-center py-8 text-red-400"><p>Erreur lors du chargement des certificats</p></div>';
                });
        }

        // Show certificate details
        function showCertificateDetails(certificate) {
            const detailsContainer = document.getElementById('certificateDetails');
            detailsContainer.innerHTML = `
                <div class="space-y-3">
                    <h3 class="text-lg font-bold text-indigo-300 border-b border-gray-600 pb-2">Certificat #${certificate.id}</h3>
                    <p><span class="text-gray-400">Code:</span> <span class="font-mono">${certificate.code_certificat}</span></p>
                    <p><span class="text-gray-400">Date d'émission:</span> ${certificate.date_émission}</p>
                    <p><span class="text-gray-400">ID Utilisateur:</span> ${certificate.utilisateur_id}</p>
                    <p><span class="text-gray-400">ID Cours:</span> ${certificate.cours_id}</p>
                    
                    <div class="flex space-x-3 pt-4">
                        <button onclick="deleteCertificate(${certificate.id})" class="flex-1 bg-red-600 hover:bg-red-500 text-white py-2 px-3 rounded-lg text-sm flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Supprimer
                        </button>
                    </div>
                </div>
            `;
            
            // Add animation
            detailsContainer.classList.add('animate__animated', 'animate__fadeIn');
            setTimeout(() => {
                detailsContainer.classList.remove('animate__animated', 'animate__fadeIn');
            }, 1000);
        }

        // Create new certificate
        function createCertificate() {
            const userId = document.getElementById('userId').value;
            const courseId = document.getElementById('courseId').value;
            const code = document.getElementById('certificateCode').value;

            if (!userId || !courseId || !code) {
                alert('Veuillez remplir tous les champs');
                return;
            }

            const btn = event.target;
            btn.innerHTML = 'Création en cours...';
            btn.disabled = true;

            axios.post(apiBaseUrl, {
                utilisateur_id: userId,
                cours_id: courseId,
                code_certificat: code,
                date_émission: new Date().toISOString().split('T')[0] // Current date
            })
            .then(response => {
                loadCertificates();
                document.getElementById('userId').value = '';
                document.getElementById('courseId').value = '';
                document.getElementById('certificateCode').value = '';
                showCertificateDetails(response.data);
                
                // Add success animation
                const detailsContainer = document.getElementById('certificateDetails');
                   detailsContainer.classList.add('animate__animated', 'animate__tada');
                setTimeout(() => {
                    detailsContainer.classList.remove('animate__animated', 'animate__tada');
                }, 1000);
            })
            .catch(error => {
                console.error('Error creating certificate:', error);
                alert('Erreur lors de la création du certificat');
            })
            .finally(() => {
                btn.innerHTML = 'Générer Certificat';
                btn.disabled = false;
            });
        }

        // Delete certificate
        function deleteCertificate(id) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer ce certificat ?')) {
                return;
            }

            axios.delete(`${apiBaseUrl}/${id}`)
                .then(() => {
                    loadCertificates();
                    document.getElementById('certificateDetails').innerHTML = '<p class="text-gray-400 text-center py-8">Certificat supprimé. Sélectionnez un autre certificat.</p>';
                })
                .catch(error => {
                    console.error('Error deleting certificate:', error);
                    alert('Erreur lors de la suppression du certificat');
                });
        }
    </script>
</body>
</html>