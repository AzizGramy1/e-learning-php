<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificatController;
use App\Http\Controllers\UserController; // ← Ajoutez cette ligne

use App\Http\Controllers\CoursController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\QuizController; 
use App\Http\Controllers\RapportController;
use App\Http\Controllers\ForumController;



Route::get('/', function () {
    return view('welcome');
});



//Routes pour les courses

Route::get('/coursView', function () {
    return view('coursView');
});


Route::get('/indexQuizz', function () {
    return view('indexQuizz');
});


Route::get('/userView', function () {
    return view('userView');
});


Route::get('/menuView', function () {
    return view('menuControllers');
});

Route::get('/certificatView', function () {
    return view('certificatView');
});

Route::get('/forumView', function () {
    return view('forumView');
});


Route::get('/backendWelcomePage', function () {
    return view('startView');
});

Route::get('/loginView', function () {
    return view('loginView');
});

Route::get('/addQuizz', function () {
    return view('quizzForm');
});




Route::prefix('api')->group(function() {

        // Routes CRUD pour les cours
        Route::get('/cours', [CoursController::class, 'index']);          // GET /api/cours
        Route::post('/cours', [CoursController::class, 'store']);         // POST /api/cours
        Route::get('/cours/{id}', [CoursController::class, 'show']);      // GET /api/cours/1
        Route::put('/cours/{id}', [CoursController::class, 'update']);    // PUT /api/cours/1
        Route::delete('/cours/{id}', [CoursController::class, 'destroy']);// DELETE /api/cours/1

 

        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::get('/users/{id}', [UserController::class, 'show']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
        
        // Routes de profil
        Route::get('/profile', [UserController::class, 'profile']);
        Route::put('/profile', [UserController::class, 'updateProfile']);
        
        // Routes des relations
        Route::get('/users/{userId}/certificats', [UserController::class, 'getUserCertificats']);
        Route::get('/users/{userId}/messages', [UserController::class, 'getUserMessages']);
        Route::get('/users/{userId}/paiements', [UserController::class, 'getUserPaiements']);
        Route::get('/users/{userId}/rapports', [UserController::class, 'getUserRapports']);



        // Routes CRUD pour les certificats
        Route::get('/certificats', [CertificatController::class, 'index']);
        Route::post('/certificats', [CertificatController::class, 'store']);
        Route::get('/certificats/{id}', [CertificatController::class, 'show']);
        Route::put('/certificats/{id}', [CertificatController::class, 'update']);
        Route::patch('/certificats/{id}', [CertificatController::class, 'update']);
        Route::delete('/certificats/{id}', [CertificatController::class, 'destroy']);

        // Routes supplémentaires pour les certificats
        Route::get('/cours/{courseId}/certificats', [CertificatController::class, 'byCourse']);
        Route::get('/users/{userId}/certificats', [CertificatController::class, 'byUser']);

        // Routes pour les autres contrôleurs (message, paiement, quiz, rapport)
        Route::apiResource('messages', MessageController::class);
        Route::apiResource('paiements', PaiementController::class);
        Route::apiResource('quizzes', QuizController::class);
        Route::apiResource('rapports', RapportController::class);


        // Routes CRUD de base
        Route::get('/forums', [ForumController::class, 'index']);
        Route::post('/forums', [ForumController::class, 'store']);
        Route::get('/forums/{id}', [ForumController::class, 'show']);
        Route::put('/forums/{id}', [ForumController::class, 'update']);
        Route::delete('/forums/{id}', [ForumController::class, 'destroy']);
        
        // Routes supplémentaires
        Route::get('/cours/{coursId}/forums', [ForumController::class, 'byCours']);
        Route::get('/utilisateurs/{utilisateurId}/forums', [ForumController::class, 'byUtilisateur']);


        
        
        // Routes spécifiques pour les paiements
        Route::get('/paiements', [PaiementController::class, 'apiIndex']);
        Route::post('/paiements', [PaiementController::class, 'store']);
        Route::get('/paiements/{id}', [PaiementController::class, 'apiShow']);
        Route::put('/paiements/{id}', [PaiementController::class, 'update']);
        Route::delete('/paiements/{id}', [PaiementController::class, 'destroy']);
        Route::get('/users/{userId}/paiements', [PaiementController::class, 'apiIndex']); // Liste des paiements par utilisateur



        Route::get('/forumView', [ForumController::class, 'index'])->name('forum.view');

        Route::get('/forums/{forum}/messages', [ForumController::class, 'showMessages']);
        Route::post('/forums/{forum}/messages', [ForumController::class, 'store']);
        Route::get('/forums', [ForumController::class, 'indexView'])->name('forums.index');



        // GET /quizzes : Liste paginée des quizzes
        Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');

        // POST /quizzes : Création d’un nouveau quiz
        Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');

        // GET /quizzes/{id} : Détails d’un quiz
        Route::get('/quizzes/{id}', [QuizController::class, 'show'])->name('quizzes.show');

        // PUT /quizzes/{id} : Mise à jour d’un quiz
        Route::put('/quizzes/{id}', [QuizController::class, 'update'])->name('quizzes.update');

        /// DELETE /quizzes/{id} : Suppression d’un quiz
        Route::delete('/quizzes/{id}', [QuizController::class, 'destroy'])->name('quizzes.destroy');



                
        






    

});





