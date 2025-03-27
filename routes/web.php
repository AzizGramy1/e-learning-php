<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificatController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\UtilisateurController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route d'accueil
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Routes CRUD
|--------------------------------------------------------------------------
*/

// Routes pour les certificats
Route::resource('certificats', CertificatController::class)
    ->except(['show']) // Exclure la route show si non utilisée
    ->middleware('auth'); // Protection par authentification



