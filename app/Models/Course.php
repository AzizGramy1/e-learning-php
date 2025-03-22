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
        'title', 
        'description', 
        'image',
    ];

    /**
     * Les attributs qui doivent être cachés pour la sérialisation.
     *
     * @var array
     */
    protected $hidden = [
        // Ajoute ici les colonnes que tu ne veux pas exposer (ex. mot de passe)
    ];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];



}
