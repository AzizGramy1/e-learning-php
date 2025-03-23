<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    /*
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'utilisateur_id', // ID de l'utilisateur qui effectue le paiement
        'montant',        // Montant du paiement
        'statut',         // Statut du paiement (ex. en_attente, complété, échoué)
        'date_paiement',  // Date du paiement
        'méthode_paiement', // Méthode de paiement (ex. carte de crédit, PayPal)
    ];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'date_paiement' => 'datetime', // Convertit la date de paiement en objet Carbon
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
}
