<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\CertificatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ReunionController; 
use App\Http\Controllers\DevoirController;
use App\Http\Controllers\RenduDevoirControlleur;
use App\Http\Controllers\InstructionDevoirController;
use App\Http\Controllers\RessourceDevoirController;
use App\Http\Controllers\ModuleCourseController;
use App\Http\Controllers\UnityController;
use App\Http\Controllers\CapsuleController;




// Test API
Route::get('/test', function () {
    return response()->json(['message' => 'API OK']);
});

// Routes d'authentification
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('jwt.auth');
    Route::get('/me', [AuthController::class, 'me'])->middleware('jwt.auth');
});








// Routes publiques (sans authentification)
Route::apiResource('cours', CoursController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('certificats', CertificatController::class);
Route::apiResource('messages', MessageController::class);
Route::apiResource('paiements', PaiementController::class);
Route::apiResource('rapports', RapportController::class);
Route::apiResource('forums', ForumController::class);
Route::apiResource('quizzes', QuizController::class);

// Routes protégées avec rôles
Route::middleware('jwt.auth')->group(function () {


    Route::prefix('unities')->group(function () {
    Route::get('/', [UnityController::class, 'index']);
    Route::get('/{id}', [UnityController::class, 'show']);
    Route::post('/', [UnityController::class, 'store']);
    Route::put('/{id}', [UnityController::class, 'update']);
    Route::delete('/{id}', [UnityController::class, 'destroy']);

    // 🔎 Recherche & filtrage
    Route::get('/search', [UnityController::class, 'search']);
    Route::get('/capsule/{capsuleId}', [UnityController::class, 'getByCapsule']);
    Route::get('/capsule/{capsuleId}/count', [UnityController::class, 'countByCapsule']);
    Route::get('/type/{type}', [UnityController::class, 'getByType']);
});


    Route::prefix('capsules')->group(function () {
    Route::get('/', [CapsuleController::class, 'index']);
    Route::get('/{id}', [CapsuleController::class, 'show']);
    Route::post('/', [CapsuleController::class, 'store']);
    Route::put('/{id}', [CapsuleController::class, 'update']);
    Route::delete('/{id}', [CapsuleController::class, 'destroy']);

    // Recherche & filtres
    Route::get('/search', [CapsuleController::class, 'search']);
    Route::get('/course/{courseId}', [CapsuleController::class, 'getByCourse']);

    // Relations
    Route::get('/{id}/unities', [CapsuleController::class, 'getUnities']);
    Route::get('/{id}/quizzes', [CapsuleController::class, 'getQuizzes']);
    Route::get('/{id}/stats', [CapsuleController::class, 'getStats']);
});


    Route::prefix('modules')->group(function () {

    // Lister tous les modules
    Route::get('/', [ModuleCourseController::class, 'index']);

    // Afficher un module spécifique
    Route::get('/{id}', [ModuleCourseController::class, 'show']);

    // Créer un nouveau module
    Route::post('/', [ModuleCourseController::class, 'store']);

    // Mettre à jour un module
    Route::put('/{id}', [ModuleCourseController::class, 'update']);

    // Supprimer un module
    Route::delete('/{id}', [ModuleCourseController::class, 'destroy']);

    // Récupérer tous les modules d’un cours spécifique
    Route::get('/course/{courseId}', [ModuleCourseController::class, 'getModulesByCourse']);

    // Lister tous les quizzes d’un module
    Route::get('/{id}/quizzes', [ModuleCourseController::class, 'getQuizzes']);
});



Route::prefix('courses')->group(function () {
    // CRUD de base
    Route::get('/', [CoursController::class, 'index']);          // Tous les cours
    Route::post('/', [CoursController::class, 'store']);         // Créer un cours
    Route::get('/{id}', [CoursController::class, 'show']);       // Voir un cours par ID
    Route::put('/{id}', [CoursController::class, 'update']);     // Mettre à jour un cours
    Route::delete('/{id}', [CoursController::class, 'destroy']); // Supprimer un cours

    // Relations avec les utilisateurs
    Route::post('/{courseId}/inscrire', [CoursController::class, 'inscrire']);      // Inscrire un utilisateur
    Route::delete('/{courseId}/desinscrire/{userId}', [CoursController::class, 'desinscrire']); // Désinscrire un utilisateur
    Route::get('/{courseId}/etudiants', [CoursController::class, 'getEtudiants']);  // Liste des étudiants du cours
    Route::get('/user/{userId}', [CoursController::class, 'getCoursesByUser']);     // Cours d’un utilisateur

    // Détails complets
    Route::get('/{id}/detail', [CoursController::class, 'detail']); // Détail d’un cours avec état d’inscription
});

    // 🔹 Routes pour InstructionDevoir
Route::prefix('instructions')->group(function () {
    Route::get('/', [InstructionDevoirController::class, 'index']);          // GET toutes les instructions
    Route::post('/', [InstructionDevoirController::class, 'store']);         // POST nouvelle instruction
    Route::get('/{id}', [InstructionDevoirController::class, 'show']);       // GET instruction par ID
    Route::get('/name/{title}', [InstructionDevoirController::class, 'getByName']); // GET par nom
    Route::put('/{id}', [InstructionDevoirController::class, 'update']);     // PUT maj
    Route::delete('/{id}', [InstructionDevoirController::class, 'destroy']); // DELETE
});

// 🔹 Routes pour RessourceDevoir
Route::prefix('ressources')->group(function () {
    Route::get('/', [RessourceDevoirController::class, 'index']);          // GET toutes les ressources
    Route::post('/', [RessourceDevoirController::class, 'store']);         // POST nouvelle ressource
    Route::get('/{id}', [RessourceDevoirController::class, 'show']);       // GET ressource par ID
    Route::get('/name/{name}', [RessourceDevoirController::class, 'getByName']); // GET par nom
    Route::put('/{id}', [RessourceDevoirController::class, 'update']);     // PUT maj
    Route::delete('/{id}', [RessourceDevoirController::class, 'destroy']); // DELETE
});



    Route::apiResource('users', UserController::class);

    // Relations utilisateur CRUD 
    Route::get('/users/{id}/certificats', [UserController::class, 'getUserCertificats']);
    Route::get('/users/{id}/messages', [UserController::class, 'getUserMessages']);
    Route::get('/users/{id}/paiements', [UserController::class, 'getUserPaiements']);
    Route::get('/users/{id}/rapports', [UserController::class, 'getUserRapports']);

    // 🔹 Récupérer les cours d’un utilisateur
    Route::get('/users/{id}/courses', [UserController::class, 'getUserCourses']); // Récupérer les cours d’un utilisateur
    


    // 🔹 Routes spécifiques certificats
    Route::get('/certificats/user/{id}', [CertificatController::class, 'getUserCertificats']);
    Route::get('/certificats/verify/{code}', [CertificatController::class, 'verifyByCode']); // Vérifier certificat par code
    Route::get('/certificats/{id}/download', [CertificatController::class, 'download']); // Télécharger un certificat
    Route::get('/mes-certificats', [CertificatController::class, 'mesCertificats'])->middleware('jwt.auth');


    // Routes admin
    Route::middleware('role:administrateur')->group(function () {
        Route::get('/admin/dashboard', [UserController::class, 'adminDashboard']); // Dashboard admin
        Route::post('/users/{id}/promote', [UserController::class, 'promoteUser']); // Promouvoir un utilisateur
    });

    // Routes formateur
    Route::middleware('role:formateur')->group(function () {
        Route::post('/cours', [CoursController::class, 'store']);
        Route::post('/quizzes', [QuizController::class, 'store']);
    });


    // Routes spécifiques pour les devoirs
Route::prefix('devoirs')->group(function () {

    Route::get('/etudiant/{etudiantId}/a-venir-non-rendus', [DevoirController::class, 'devoirsAVenirNonRendus']);


    
    // Lister les devoirs par professeur
    Route::get('/professeur/{professeurId}', [DevoirController::class, 'getByProfesseur']);

    // Lister les devoirs par étudiant (avec rendus)
    Route::get('/etudiant/{etudiantId}', [DevoirController::class, 'getByEtudiant']);

    // Rechercher par titre
    Route::get('/search/titre', [DevoirController::class, 'searchByTitre']);

    // Rechercher par date limite
    Route::get('/search/date', [DevoirController::class, 'searchByDate']);

    // Devoirs en retard (non rendus)
    Route::get('/en-retard', [DevoirController::class, 'devoirsEnRetard']);

    // Devoirs à venir
    Route::get('/a-venir', [DevoirController::class, 'devoirsAVenir']);

    // Statistiques : nombre de rendus par devoir
    Route::get('/{id}/stats-rendus', [DevoirController::class, 'statsRendus']);

    // Exporter les devoirs en JSON
    Route::get('/export/json', [DevoirController::class, 'exportJson']);

    // Exporter les devoirs en CSV
    Route::get('/export/csv', [DevoirController::class, 'exportCsv']);

    // Supprimer tous les rendus d’un devoir
    Route::delete('/{id}/delete-rendus', [DevoirController::class, 'deleteRendus']);

    // Recherche par ID du devoir 
    Route::get('/search/{id}', [DevoirController::class, 'searchById']);

});



    Route::prefix('reunions')->group(function () {

    // Routes publiques ou filtrables
    Route::get('/', [ReunionController::class, 'index']);
    Route::get('/disponibles', [ReunionController::class, 'disponibles']);
    Route::get('/populaires/{limit?}', [ReunionController::class, 'populaires']);
    Route::get('/statistiques', [ReunionController::class, 'statistiques']);
    Route::get('/mes-reunions', [ReunionController::class, 'mesReunions'])->middleware('jwt.auth');

    // Routes sur une réunion spécifique
    Route::get('/{id}', [ReunionController::class, 'show']);
    Route::post('/', [ReunionController::class, 'store']);
    Route::put('/{id}', [ReunionController::class, 'update']);
    Route::delete('/{id}', [ReunionController::class, 'destroy']);

    // Inscription / désinscription à une réunion
    Route::post('/{reunionId}/rejoindre', [ReunionController::class, 'rejoindreReunion'])->middleware('jwt.auth');
    Route::post('/{reunionId}/quitter', [ReunionController::class, 'quitterReunion'])->middleware('jwt.auth');
    Route::get('/{reunionId}/est-inscrit', [ReunionController::class, 'estInscrit'])->middleware('jwt.auth');

    // Gestion des participants (admin / instructeur)
    Route::post('/{reunionId}/ajouter-participant/{userId}', [ReunionController::class, 'ajouterParticipant']);
    Route::post('/{reunionId}/retirer-participant/{userId}', [ReunionController::class, 'retirerParticipant']);

    // Actions sur la réunion
    Route::post('/{id}/demarrer', [ReunionController::class, 'demarrer']);
    Route::post('/{id}/terminer', [ReunionController::class, 'terminer']);
    Route::post('/{id}/annuler', [ReunionController::class, 'annuler']);



    // ---------------------
// Routes utilisateur
// ---------------------
    Route::prefix('quizzes')->group(function () {

    // Liste des quiz disponibles pour l'utilisateur
    Route::get('/available', [QuizController::class, 'getAvailableQuizzes']);

    // Quiz par module
    Route::get('/module/{moduleId}', [QuizController::class, 'getQuizzesByModule']);

    // Questions d’un quiz
    Route::get('/{id}/questions', [QuizController::class, 'getQuestions']);

    // Correction d’un quiz passé
    Route::get('/{id}/correction', [QuizController::class, 'getCorrection'])->middleware('auth:sanctum');

    // Historique des quiz passés par l'utilisateur
    Route::get('/history', [QuizController::class, 'getHistory'])->middleware('auth:sanctum');
});




    
});


});
