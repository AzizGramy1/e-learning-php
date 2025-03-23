<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    protected $fillable = [
        'utilisateur_id', // ID de l'utilisateur (sans clé étrangère)
        'cours_id',       // ID du cours (sans clé étrangère)
        'date_début',     // Date de début de l'abonnement
        'date_fin',       // Date de fin de l'abonnement
        'statut',         // Statut de l'abonnement (actif, expiré, annulé)
    ];
}
