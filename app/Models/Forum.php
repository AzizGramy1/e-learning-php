<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
     /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cours_id',       // ID du cours auquel le forum est associé
        'titre',          // Titre du forum
        'description',    // Description du forum
        'utilisateur_id', // ID de l'utilisateur qui a créé le forum
    ];

    /**
     * Relation avec le cours.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cours()
    {
        return $this->belongsTo(Cours::class, 'cours_id');
    }

    /**
     * Relation avec l'utilisateur qui a créé le forum.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    /**
     * Relation avec les messages du forum.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'forum_id');
    }
}
