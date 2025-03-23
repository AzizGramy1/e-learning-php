<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
     /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    
        protected $fillable = [
            'titre',       // Titre du cours
            'description', // Description du cours
            'image',       // Image du cours (optionnelle)
        ];
}


