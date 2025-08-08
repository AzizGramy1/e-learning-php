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

// Routes d'authentification
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('jwt.auth');
    Route::get('/me', [AuthController::class, 'me'])->middleware('jwt.auth');
});

// Routes publiques (sans authentification)
Route::middleware('api')->group(function () {
    Route::apiResource('cours', CoursController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('certificats', CertificatController::class);
    Route::apiResource('messages', MessageController::class);
    Route::apiResource('paiements', PaiementController::class);
    Route::apiResource('rapports', RapportController::class);
    Route::apiResource('forums', ForumController::class);
    Route::apiResource('quizzes', QuizController::class);
});

// Routes protégées avec rôles
Route::middleware('jwt.auth')->group(function () {
    // Routes admin
    Route::middleware('role:administrateur')->group(function () {
        Route::get('/admin/dashboard', [UserController::class, 'adminDashboard']);
        Route::post('/users/{id}/promote', [UserController::class, 'promoteUser']);
    });

    // Routes formateur
    Route::middleware('role:formateur')->group(function () {
        Route::post('/cours', [CoursController::class, 'store']);
        Route::post('/quizzes', [QuizController::class, 'store']);
    });

    // Routes pour tous les utilisateurs authentifiés
    Route::get('/users/{userId}/certificats', [CertificatController::class, 'byUser']);
    Route::get('/users/{userId}/paiements', [PaiementController::class, 'byUser']);
    Route::get('/forums/{forumId}/messages', [ForumController::class, 'showMessages']);







    Route::get('/test/role', function () {
    return response()->json(['message' => 'Rôle valide']);
    })->middleware('jwt.auth', 'role:administrateur');
});