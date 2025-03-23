<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'utilisateur_id', // ID de l'utilisateur qui a généré le rapport
        'titre',          // Titre du rapport
        'contenu',        // Contenu du rapport
        'date_génération', // Date de génération du rapport
    ];

    

}
