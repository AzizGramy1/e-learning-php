<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
     /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'forum_id',       // ID du forum auquel le message appartient
        'utilisateur_id', // ID de l'utilisateur qui a posté le message
        'contenu',        // Contenu du message
    ];

    
}
