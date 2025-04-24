<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Ajouter cette ligne
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\Relation;

class Forum extends Model
{


    

     /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */

     use HasFactory; // Nécessaire pour utiliser les factories
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
        return $this->belongsTo(Course::class, 'cours_id');
    }

    /**
     * Relation avec l'utilisateur qui a créé le forum.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id'); // Ajout explicite de la clé étrangère
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
