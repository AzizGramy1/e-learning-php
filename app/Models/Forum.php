<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    /**
     * Les attributs qui sont mass assignables.
     *
     * @var array
     */
    protected $fillable = [
        'cours_id',       // ID du cours auquel le forum est associé
        'titre',          // Titre du forum
        'description',    // Description du forum
        'utilisateur_id', // ID de l'utilisateur qui a créé le forum
    ];
}
