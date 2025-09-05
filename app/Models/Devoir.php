<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Devoir extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',        // 🔗 cours lié
        'user_id',          // 🔗 instructeur / créateur du devoir

        'titre',            // titre du devoir
        'description',      // description courte
        'module',           // ex: "Module 3: ES6+"
        'points',           // nombre de points attribués

        'date_limite',      // deadline
        'categorie',        // catégorie (projet, exercice, quiz...)
        'statut',           // état: en_attente, en_retard, terminé, actif

        'instructions',     // consignes détaillées
        'type_remise',      // fichier, lien, fichier_et_lien
        'fichiers_joints',  // ressources (JSON: pdf, zip, etc.)

        'fichier_url',      // fichier principal éventuel
    ];

    protected $casts = [
        'date_limite'     => 'datetime',
        'points'          => 'integer',
        'fichiers_joints' => 'array',
    ];

    /**
     * 🔹 Relation : un devoir appartient à un cours
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * 🔹 Relation : un devoir est créé par un user (instructeur)
     */
    public function createur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * 🔹 Relation : un devoir peut avoir plusieurs Rendu
     */
    public function soumissions()
    {
        return $this->hasMany(RenduDevoir::class);
    }

    // 🔹 Relation : un devoir peut avoir plusieurs instructions
    public function instructions()
    {
        return $this->hasMany(InstructionDevoir::class);
    }

    // 🔹 Relation : un devoir peut avoir plusieurs ressources
    public function ressources()
    {
        return $this->hasMany(RessourceDevoir::class);
    }
}
