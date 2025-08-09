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

Route::get('/', function () {
    return view('welcome');
});


