<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'utilisateur_id', // ID de l'utilisateur qui souscrit à l'abonnement
        'cours_id',       // ID du cours auquel l'utilisateur est abonné
        'date_début',     // Date de début de l'abonnement
        'date_fin',       // Date de fin de l'abonnement
        'statut',         // Statut de l'abonnement (ex. actif, expiré, annulé)
    ];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'date_début' => 'datetime', // Convertit la date de début en objet Carbon
        'date_fin' => 'datetime',   // Convertit la date de fin en objet Carbon
    ];

    /**
     * Relation avec l'utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    /**
     * Relation avec le cours.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cours()
    {
        return $this->belongsTo(Cours::class, 'cours_id');
    }
}
