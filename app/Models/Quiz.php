<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cours_id',       // ID du cours auquel le quiz est associé
        'titre',          // Titre du quiz
        'description',    // Description du quiz
    ];

    
}
