<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
     /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */

     use HasFactory; // ← Activer les factories
    // Utilisé pour générer des données de test
    protected $fillable = [
        'forum_id',       // ID du forum auquel le message appartient
        'utilisateur_id', // ID de l'utilisateur qui a posté le message
        'contenu',        // Contenu du message
    ];

    /**
     * Relation avec le forum.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forum()
    {
        return $this->belongsTo(Forum::class, 'forum_id');
    }

    /**
     * Relation avec l'utilisateur qui a posté le message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }
}
