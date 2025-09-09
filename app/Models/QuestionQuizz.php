<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Quiz;

class QuestionQuizz extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',           // 🔗 Référence au quiz
        'intitule',          // Texte de la question
        'type',              // Type de question (QCM, Vrai/Faux, Texte, etc.)
        'points',            // Nombre de points attribués
        'options',           // Options possibles (JSON si QCM)
        'reponse_correcte',  // Bonne réponse (ou tableau de réponses)
        'reponse_1',         
        'reponse_2',
        'reponse_3',
        'reponse_4',
    ];

    protected $casts = [
        'options' => 'array',           // options stockées en JSON
        'reponse_correcte' => 'array',  // réponses correctes stockées en JSON
    ];

    /**
     * Relation : Une question appartient à un quiz
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}
