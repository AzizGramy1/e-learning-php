<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificatController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\QuizController; 
use App\Http\Controllers\RapportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| API Routes (version corrigée)
|--------------------------------------------------------------------------
*/

// Version 1 : Routes API basiques (sans auth)
Route::prefix('api')->group(function () {
    Route::apiResource('certificats', CertificatController::class);

    // Nouvelles routes pour les cours
    Route::apiResource('cours', CoursController::class);

    
     // Routes pour les messages
    Route::apiResource('messages', MessageController::class);
    Route::apiResource('messagesEditCreate', MessageController::class)->except(['create', 'edit']);
    // Pour obtenir les messages d'un forum spécifique
    Route::get('forums/{forum}/messages', [MessageController::class, 'forumMessages']);




      // Routes pour les quizzes
    Route::apiResource('quizzes', QuizController::class); 

      //Routes pour les rapports
    Route::apiResource('rapports', RapportController::class);   

      

    
    Route::get('forums/{forum}/messages', [MessageController::class, 'forumMessages']);




    // Authentification
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes protégées
Route::middleware(['auth:sanctum'])->group(function () {
    
    // Gestion du profil utilisateur
    Route::prefix('profile')->group(function () {
        Route::get('/', [UserController::class, 'showProfile']);
        Route::put('/', [UserController::class, 'updateProfile']);
        Route::delete('/', [UserController::class, 'deleteProfile']);
    });

    // Administration des utilisateurs (admin seulement)
    Route::middleware(['admin'])->prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{user}', [UserController::class, 'show']);
        Route::put('/{user}', [UserController::class, 'update']);
        Route::delete('/{user}', [UserController::class, 'destroy']);
        
        // Relations
        Route::get('/{user}/certificats', [UserController::class, 'getUserCertificats']);
        Route::get('/{user}/messages', [UserController::class, 'getUserMessages']);
        Route::get('/{user}/paiements', [UserController::class, 'getUserPaiements']);
        Route::get('/{user}/rapports', [UserController::class, 'getUserRapports']);
    });

    // Déconnexion
    Route::post('/logout', [AuthController::class, 'logout']);
});

});




