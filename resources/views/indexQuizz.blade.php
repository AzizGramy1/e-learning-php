<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Quiz</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --success-color: #2ecc71;
            --danger-color: #e74c3c;
            --light-gray: #f8f9fa;
        }
        
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
        }
        
        .card-header {
            background-color: var(--secondary-color);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }
        
        .table th {
            background-color: var(--light-gray);
            font-weight: 600;
        }
        
        .badge {
            font-size: 0.85em;
            padding: 5px 10px;
            font-weight: 500;
        }
        
        .badge-success {
            background-color: var(--success-color);
        }
        
        .badge-secondary {
            background-color: #95a5a6;
        }
        
        .btn-action {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 3px;
        }
        
        .modal-content {
            border-radius: 10px;
        }
        
        .form-control, .form-select {
            border-radius: 5px;
            padding: 10px;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .pagination .page-link {
            color: var(--secondary-color);
        }
        
        #quizzesTable tbody tr {
            transition: all 0.2s ease;
        }
        
        #quizzesTable tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
            transform: translateY(-1px);
        }
        
        .status-badge {
            font-size: 0.8em;
            padding: 4px 8px;
            border-radius: 4px;
        }
        
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            .btn-action {
                width: 30px;
                height: 30px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-primary fw-bold">
                <i class="fas fa-question-circle me-2"></i>Gestion des Quiz
            </h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quizModal">
                <i class="fas fa-plus me-2"></i>Nouveau Quiz
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Liste des Quiz</h5>
                    <div class="d-flex">
                        <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Rechercher...">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="quizzesTable">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Cours</th>
                                <th>Durée</th>
                                <th>Dates</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Les données seront chargées via JavaScript -->
                        </tbody>
                    </table>
                </div>
                <nav class="mt-3" id="paginationContainer">
                    <ul class="pagination justify-content-center">
                        <!-- La pagination sera générée via JavaScript -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal pour créer/éditer un quiz -->
    <div class="modal fade" id="quizModal" tabindex="-1" aria-labelledby="quizModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="quizModalLabel"><i class="fas fa-question-circle me-2"></i>Nouveau Quiz</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="quizForm">
                    <div class="modal-body">
                        <input type="hidden" id="quiz_id" name="id">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre du quiz" required>
                                    <label for="titre">Titre du quiz</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="cours_id" name="cours_id" required>
                                        <option value="" selected disabled>Sélectionner un cours</option>
                                        <!-- Les options seront chargées via JavaScript -->
                                    </select>
                                    <label for="cours_id">Cours associé</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="description" name="description" placeholder="Description" style="height: 100px"></textarea>
                                    <label for="description">Description</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="duree" name="duree" min="1" placeholder="Durée (minutes)" required>
                                    <label for="duree">Durée (minutes)</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="passage_max" name="passage_max" min="1" placeholder="Nombre de tentatives" required>
                                    <label for="passage_max">Nombre de tentatives</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="note_minimale" name="note_minimale" min="0" max="100" step="0.1" placeholder="Note minimale (%)" required>
                                    <label for="note_minimale">Note minimale (%)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="datetime-local" class="form-control" id="date_ouverture" name="date_ouverture" required>
                                    <label for="date_ouverture">Date d'ouverture</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="datetime-local" class="form-control" id="date_fermeture" name="date_fermeture" required>
                                    <label for="date_fermeture">Date de fermeture</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="est_actif" name="est_actif" value="1" checked>
                                    <label class="form-check-label" for="est_actif">Quiz actif</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="aleatoire_questions" name="aleatoire_questions" value="1">
                                    <label class="form-check-label" for="aleatoire_questions">Questions aléatoires</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="correction_auto" name="correction_auto" value="1" checked>
                                    <label class="form-check-label" for="correction_auto">Correction automatique</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select" id="certificat_id" name="certificat_id">
                                        <option value="" selected>Aucun certificat</option>
                                        <!-- Les options seront chargées via JavaScript -->
                                    </select>
                                    <label for="certificat_id">Certificat associé (optionnel)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Fermer</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Confirmation</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer ce quiz ? Cette action est irréversible.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete"><i class="fas fa-trash me-2"></i>Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    
    <script>
        $(document).ready(function() {
            // Configuration de Toastr
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000"
            };

            // Variables globales
            let currentPage = 1;
            let totalPages = 1;
            let quizzes = [];
            let courses = [];
            let certificates = [];
            let quizToDelete = null;

            // Initialisation
            init();

            // Fonction d'initialisation
            async function init() {
                await loadCourses();
                await loadCertificates();
                await loadQuizzes();
                setupEventListeners();
            }

            // Charger les cours
            async function loadCourses() {
                try {
                    const response = await fetch('/api/cours');
                    if (!response.ok) throw new Error('Erreur de chargement des cours');
                    courses = await response.json();
                    populateCourseSelect();
                } catch (error) {
                    console.error(error);
                    toastr.error('Erreur lors du chargement des cours');
                }
            }

            // Charger les certificats
            async function loadCertificates() {
                try {
                    const response = await fetch('/api/certificats');
                    if (!response.ok) throw new Error('Erreur de chargement des certificats');
                    certificates = await response.json();
                    populateCertificateSelect();
                } catch (error) {
                    console.error(error);
                    toastr.error('Erreur lors du chargement des certificats');
                }
            }

            // Charger les quiz
            async function loadQuizzes(page = 1, search = '') {
                try {
                    let url = `/api/quizz?page=${page}`;
                    if (search) url += `&search=${encodeURIComponent(search)}`;
                    
                    const response = await fetch(url);
                    if (!response.ok) throw new Error('Erreur de chargement des quiz');
                    
                    const data = await response.json();
                    quizzes = data.data;
                    currentPage = data.current_page;
                    totalPages = data.last_page;
                    
                    renderQuizzes();
                    renderPagination();
                } catch (error) {
                    console.error(error);
                    toastr.error('Erreur lors du chargement des quiz');
                }
            }

            // Afficher les quiz dans le tableau
            function renderQuizzes() {
                const tbody = $('#quizzesTable tbody');
                tbody.empty();
                
                if (quizzes.length === 0) {
                    tbody.append(`
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-info-circle me-2"></i>Aucun quiz trouvé
                            </td>
                        </tr>
                    `);
                    return;
                }
                
                quizzes.forEach(quiz => {
                    const startDate = new Date(quiz.date_ouverture);
                    const endDate = new Date(quiz.date_fermeture);
                    const now = new Date();
                    
                    const isActive = quiz.est_actif;
                    const isAvailable = isActive && startDate <= now && endDate >= now;
                    
                    tbody.append(`
                        <tr>
                            <td>${quiz.titre}</td>
                            <td>${quiz.cours ? quiz.cours.titre : 'N/A'}</td>
                            <td>${quiz.duree} min</td>
                            <td>
                                <small class="text-muted">
                                    <i class="far fa-calendar-alt me-1"></i>${formatDate(startDate)}<br>
                                    <i class="far fa-calendar-times me-1"></i>${formatDate(endDate)}
                                </small>
                            </td>
                            <td>
                                <span class="status-badge badge ${isAvailable ? 'bg-success' : 'bg-secondary'}">
                                    ${isAvailable ? 'Disponible' : 'Indisponible'}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info btn-action edit-quiz" data-id="${quiz.id}" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger btn-action delete-quiz" data-id="${quiz.id}" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <a href="/quizzes/${quiz.id}" class="btn btn-sm btn-primary btn-action" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    `);
                });
            }

            // Afficher la pagination
            function renderPagination() {
                const pagination = $('#paginationContainer ul');
                pagination.empty();
                
                if (totalPages <= 1) return;
                
                // Bouton Précédent
                pagination.append(`
                    <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                        <a class="page-link" href="#" data-page="${currentPage - 1}">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                `);
                
                // Pages
                for (let i = 1; i <= totalPages; i++) {
                    pagination.append(`
                        <li class="page-item ${i === currentPage ? 'active' : ''}">
                            <a class="page-link" href="#" data-page="${i}">${i}</a>
                        </li>
                    `);
                }
                
                // Bouton Suivant
                pagination.append(`
                    <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                        <a class="page-link" href="#" data-page="${currentPage + 1}">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                `);
            }

            // Remplir le select des cours
            function populateCourseSelect() {
                const select = $('#cours_id');
                select.empty();
                select.append('<option value="" selected disabled>Sélectionner un cours</option>');
                
                courses.forEach(course => {
                    select.append(`<option value="${course.id}">${course.titre}</option>`);
                });
            }

            // Remplir le select des certificats
            function populateCertificateSelect() {
                const select = $('#certificat_id');
                select.empty();
                select.append('<option value="" selected>Aucun certificat</option>');
                
                certificates.forEach(cert => {
                    select.append(`<option value="${cert.id}">${cert.nom}</option>`);
                });
            }

            // Configurer les écouteurs d'événements
            function setupEventListeners() {
                // Recherche
                $('#searchInput').on('input', function() {
                    const search = $(this).val();
                    loadQuizzes(1, search);
                });
                
                // Pagination
                $('#paginationContainer').on('click', '.page-link', function(e) {
                    e.preventDefault();
                    const page = $(this).data('page');
                    if (page && page !== currentPage) {
                        loadQuizzes(page, $('#searchInput').val());
                    }
                });
                
                // Soumission du formulaire
                $('#quizForm').on('submit', async function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    const quizId = $('#quiz_id').val();
                    const method = quizId ? 'PUT' : 'POST';
                    const url = quizId ? `/api/quizzes/${quizId}` : '/api/quizzes';
                    
                    try {
                        const response = await fetch(url, {
                            method: method,
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: formData
                        });
                        
                        const data = await response.json();
                        
                        if (!response.ok) {
                            throw new Error(data.message || 'Erreur lors de la sauvegarde');
                        }
                        
                        $('#quizModal').modal('hide');
                        toastr.success(quizId ? 'Quiz mis à jour avec succès' : 'Quiz créé avec succès');
                        loadQuizzes(currentPage, $('#searchInput').val());
                    } catch (error) {
                        console.error(error);
                        toastr.error(error.message || 'Erreur lors de la sauvegarde du quiz');
                    }
                });
                
                // Édition d'un quiz
                $('#quizzesTable').on('click', '.edit-quiz', async function() {
                    const quizId = $(this).data('id');
                    
                    try {
                        const response = await fetch(`/api/quizzes/${quizId}`);
                        if (!response.ok) throw new Error('Erreur de chargement du quiz');
                        
                        const quiz = await response.json();
                        
                        $('#quizModalLabel').html(`<i class="fas fa-edit me-2"></i>Modifier le quiz`);
                        $('#quiz_id').val(quiz.id);
                        $('#titre').val(quiz.titre);
                        $('#description').val(quiz.description);
                        $('#cours_id').val(quiz.cours_id);
                        $('#duree').val(quiz.duree);
                        $('#passage_max').val(quiz.passage_max);
                        $('#note_minimale').val(quiz.note_minimale);
                        $('#est_actif').prop('checked', quiz.est_actif);
                        $('#aleatoire_questions').prop('checked', quiz.aleatoire_questions);
                        $('#correction_auto').prop('checked', quiz.correction_auto);
                        $('#certificat_id').val(quiz.certificat_id);
                        
                        // Formatage des dates pour l'input datetime-local
                        const startDate = new Date(quiz.date_ouverture);
                        const endDate = new Date(quiz.date_fermeture);
                        
                        $('#date_ouverture').val(formatDateTimeLocal(startDate));
                        $('#date_fermeture').val(formatDateTimeLocal(endDate));
                        
                        $('#quizModal').modal('show');
                    } catch (error) {
                        console.error(error);
                        toastr.error('Erreur lors du chargement du quiz');
                    }
                });
                
                // Suppression d'un quiz
                $('#quizzesTable').on('click', '.delete-quiz', function() {
                    quizToDelete = $(this).data('id');
                    $('#confirmModal').modal('show');
                });
                
                $('#confirmDelete').on('click', async function() {
                    if (!quizToDelete) return;
                    
                    try {
                        const response = await fetch(`/api/quizzes/${quizToDelete}`, {
                            method: 'DELETE',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });
                        
                        if (!response.ok) {
                            throw new Error('Erreur lors de la suppression');
                        }
                        
                        $('#confirmModal').modal('hide');
                        toastr.success('Quiz supprimé avec succès');
                        loadQuizzes(currentPage, $('#searchInput').val());
                    } catch (error) {
                        console.error(error);
                        toastr.error(error.message || 'Erreur lors de la suppression du quiz');
                    } finally {
                        quizToDelete = null;
                    }
                });
                
                // Réinitialisation du modal
                $('#quizModal').on('hidden.bs.modal', function() {
                    $('#quizModalLabel').html(`<i class="fas fa-question-circle me-2"></i>Nouveau Quiz`);
                    $('#quizForm')[0].reset();
                    $('#quiz_id').val('');
                });
            }

            // Helper pour formater la date
            function formatDate(date) {
                return date.toLocaleDateString('fr-FR', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }

            // Helper pour formater la date pour datetime-local
            function formatDateTimeLocal(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                const hours = String(date.getHours()).padStart(2, '0');
                const minutes = String(date.getMinutes()).padStart(2, '0');
                
                return `${year}-${month}-${day}T${hours}:${minutes}`;
            }
        });
    </script>
</body>
</html>