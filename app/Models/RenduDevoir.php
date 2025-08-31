<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RenduDevoir extends Model
{
    use HasFactory;

    protected $fillable = [
        'devoir_id',        // 🔗 Référence au devoir
        'user_id',          // 🔗 Étudiant qui a soumis
        'fichier_url',      // 📎 Lien vers le fichier rendu
        'note',             // 📝 Note attribuée
        'commentaire',      // 💬 Feedback du prof
        'date_soumission',  // ⏰ Date de soumission
        'etat',             // ⚡ statut du rendu: en_attente, corrige, en_retard...
    ];

    protected $casts = [
        'date_soumission' => 'datetime',
        'note' => 'decimal:2', // deux décimales c’est plus réaliste pour les notes
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    // 🔗 Un rendu appartient à un devoir
    public function devoir()
    {
        return $this->belongsTo(Devoir::class, 'devoir_id');
    }

    // 🔗 Un rendu appartient à un étudiant (User)
    public function etudiant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 🔗 Optionnel : si tu veux tracer quel professeur corrige
    public function correcteur()
    {
        return $this->belongsTo(User::class, 'correcteur_id');
    }
}
