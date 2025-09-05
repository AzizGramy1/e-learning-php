<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Cours;
use App\Models\Question;
use App\Models\Certificat;
use App\Models\ModuleCourse;    

class Quiz extends Model
{
    
    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'cours_id',           // ID du cours associé
        'titre',              // Titre du quiz
        'description',        // Description détaillée
        'duree',              // Durée en minutes (nouveau)
        'passage_max',        // Nombre de tentatives autorisées (nouveau)
        'note_minimale',      // Note requise pour validation (nouveau)
        'est_actif',          // Quiz visible ou non (nouveau)
        'date_ouverture',     // Date de disponibilité (nouveau)
        'date_fermeture',     // Date d'expiration (nouveau)
        'aleatoire_questions',// Ordre aléatoire des questions (nouveau)
        'correction_auto',    // Correction automatique (nouveau - cf cahier des charges)
        'certificat_id',      // Référence au certificat (nouveau - cf cahier des charges)
    ];

    /**
     * Les attributs devant être convertis.
     *
     * @var array
     */
    protected $casts = [
        'est_actif' => 'boolean',
        'aleatoire_questions' => 'boolean',
        'correction_auto' => 'boolean',
        'date_ouverture' => 'datetime',
        'date_fermeture' => 'datetime',
    ];

    /**
     * Relation avec le cours.
     */
    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }

    /**
     * Relation avec les questions.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Relation avec le certificat (cf cahier des charges).
     */
    public function certificat()
    {
        return $this->belongsTo(Certificat::class);
    }

    /**
     * Scope pour les quiz actifs.
     */
    public function scopeActif($query)
    {
        return $query->where('est_actif', true);
    }

    /**
     * Vérifie si le quiz est disponible.
     */
    public function estDisponible()
    {
        $now = now();
        return $this->est_actif 
            && ($this->date_ouverture <= $now) 
            && ($this->date_fermeture >= $now);
    }


    // Relation avec le module
    public function module()
    {
        return $this->belongsTo(ModuleCourse::class, 'module_id'); 
        // 'module_id' doit être la colonne dans la table quizzes qui référence module_courses.id
    }
}
