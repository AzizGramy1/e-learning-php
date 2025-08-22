<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificat extends Model
{
    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'utilisateur_id',        // Référence à l'utilisateur
        'cours_id',              // Référence au cours
        'date_emission',         // Date d'émission (renommé sans accent pour cohérence DB)
        'code_certificat',       // Code unique de vérification
        'note',                  // Note obtenue (ex: 85%)
        'description_obtention', // Texte : "Certificat obtenu pour ..."
        'mention',               // (optionnel) Ex: "Excellent", "Honorable", "Top 10%"
        'heures',                // (optionnel) Heures de formation complétées
    ];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'date_émission' => 'datetime',
    ];

    /**
     * Relation avec l'utilisateur.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    /**
     * Relation avec le cours. //relation avec le cours ou le certificat a été obtenu
     */
    public function cours()
    {
        return $this->belongsTo(Course::class, 'cours_id');
    }
}
