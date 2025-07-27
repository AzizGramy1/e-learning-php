<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificatController;
use App\Http\Controllers\UserController; 

use App\Http\Controllers\CoursController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\QuizController; 
use App\Http\Controllers\RapportController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\AuthController;


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




//////////////////////////////////////////////// Routes de test pour l'authentification web//////////////////////////////


Route::get('/login-backend', function () {
    return view('loginViewTestForLaravel'); // remplace par ta vraie vue
})->name('loginBackend');

// Ajoutez cette route pour le traitement du formulaire
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Routes de test pour l'authentification web
Route::middleware('guest')->group(function () {
    // Vue de test pour l'inscription
    Route::get('/test/register', function () {
        return view('test_register');
    })->name('test.register.view');
    
    // Vue de test pour la connexion
    Route::get('/test/login', function () {
        return view('test_login');
    })->name('test.login.view');
});

Route::middleware(['auth', 'active'])->group(function () {
    // Page de test protégée - Accès utilisateur normal
    Route::get('/test/protected', function () {
        return response()->json([
            'message' => 'Vous êtes authentifié (web)',
            'user' => auth()->user()
        ]);
    })->name('test.protected');
    
    // Page de test protégée - Accès admin seulement
    Route::get('/test/admin-only', function () {
        return response()->json([
            'message' => 'Vous êtes admin (web)',
            'user' => auth()->user()
        ]);
    })->middleware('role:admin')->name('test.admin.only');
    
    // Page pour voir les informations de session
    Route::get('/test/session-info', function (Request $request) {
        return response()->json([
            'session' => $request->session()->all(),
            'user' => $request->user(),
            'authenticated' => Auth::check()
        ]);
    });
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


















Route::get('/welcomeDadh', function () {
    return view('dashboard_welcome');
})->name('welcomeDadh'); // Ajoutez cette partie

Route::get('/messageForum', function () {
    return view('message_forum');
});

Route::get('/videoConference', function () {
    return view('videoConference_1');
});

Route::get('/certificat_par_user', function () {
    return view('certificats_par_user');
});


Route::get('/profil_details', function () {
    return view('profil_details');
});

Route::get('/quiz_details', function () {
    return view('quiz_details');
});


Route::get('/quiz_menu', function () {
    return view('quiz_menu');
});



Route::get('/mySpace', function () {
    return view('myspace');
});


Route::get('/paiementQuiz', function () {
    return view('paiementQuizz');
});

Route::get('/assistantAI', function () {
    return view('assistanAI');
});


Route::get('/calendrier_user', function () {
    return view('calendrier_user');
});


Route::get('/inscrption_page', function () {
    return view('inscriptionBackend');
});


Route::get('/lesSallesDeReunion', function () {
    return view('lesSalleDeReunions');
});

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});


//////////////////////////////// authentification routes /////////////////////////

// Routes publiques (sans authentification)

Route::middleware('User')->group(function () {
    Route::post('/loginUser', [AuthController::class, 'login'])->name('login');
});

// Routes protégées (nécessitent une authentification)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logoutUser', [AuthController::class, 'logout'])->name('logout');
    Route::get('/me', [AuthController::class, 'me'])->name('user.profile');
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

        Route::post('/loginTest', [AuthController::class, 'login']);

        
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
        Route::get('/quizz', [QuizController::class, 'index'])->name('quizzes.index');

        // POST /quizzes : Création d’un nouveau quiz
        Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');

        // GET /quizzes/{id} : Détails d’un quiz
        Route::get('/quizzes/{id}', [QuizController::class, 'show'])->name('quizzes.show');

        // PUT /quizzes/{id} : Mise à jour d’un quiz
        Route::put('/quizzes/{id}', [QuizController::class, 'update'])->name('quizzes.update');

        /// DELETE /quizzes/{id} : Suppression d’un quiz
        Route::delete('/quizzes/{id}', [QuizController::class, 'destroy'])->name('quizzes.destroy');



                
        








    

});





