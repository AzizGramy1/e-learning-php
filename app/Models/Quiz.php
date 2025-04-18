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
     * Relation avec les questions du quiz.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id');
    }
}
