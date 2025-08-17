<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être remplis en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titre',                // Titre du cours
        'description',          // Description du cours
        'image',                // Image du cours

        'categorie',            // Catégorie (Développement, Data Science, Programmation...)
        'difficulte',           // Niveau (Débutant, Intermédiaire, Avancé)
        'note',                 // Note moyenne du cours (ex: 4.8)
        'statut',               // Statut (En cours, Terminé, Nouveau, Favori)

        'duree_totale',         // Durée totale du cours (ex: "32h")
        'chapitres_total',      // Nombre total de chapitres
        'chapitres_completes',  // Nombre de chapitres complétés
        'progression',          // Progression en % (calculé ou stocké directement)

        'certificat_obtenu',    // true/false
        'auteur',               // Nom de l’instructeur
        'tags'                  // Liste des mots-clés (JSON ou string)
    ];

    /**
     * Cast des attributs.
     */
    protected $casts = [
        'certificat_obtenu' => 'boolean',
        'note' => 'decimal:1',
        'progression' => 'integer',
        'chapitres_total' => 'integer',
        'chapitres_completes' => 'integer',
        'tags' => 'array' // Stocké en JSON si besoin
    ];



    // Un cours peut avoir plusieurs étudiants (relation many-to-many entre Course et User)
    public function etudiants()
    {
    return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')
                ->withTimestamps()
                ->withPivot('progression', 'date_inscription');
}
}
