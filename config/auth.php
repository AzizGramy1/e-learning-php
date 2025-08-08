<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Ici, on définit le "guard" par défaut. Dans ton cas, l'authentification se
    | fait principalement via l'API donc on utilise le guard 'api' qui est basé
    | sur JWT.
    |
    */

    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Définition des différents "guards" d'authentification. Le guard 'web' est
    | pour les sessions Laravel classiques. Le guard 'api' est celui utilisé par
    | les requêtes HTTP avec JWT.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Détermine comment les utilisateurs sont récupérés depuis la base de données.
    | Ici, on utilise Eloquent avec le modèle App\Models\User.
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Configuration de la réinitialisation de mot de passe.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60, // Le lien expire au bout de 60 minutes
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Temps avant qu'une confirmation de mot de passe ne soit redemandée.
    |
    */

    'password_timeout' => 10800,

];
