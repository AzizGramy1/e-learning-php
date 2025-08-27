<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany; 
use App\Models\Categorie;
use App\Models\User;

class Reunion extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Les statuts possibles d'une réunion
     */
    const STATUT_PLANIFIE = 'planifie';
    const STATUT_EN_COURS = 'en_cours';
    const STATUT_TERMINE = 'termine';
    const STATUT_ANNULE = 'annule';

    protected $fillable = [
        'titre',
        'description',
        'date_debut',
        'date_fin',
        'statut',
        'lien_video',
        'nombre_participants',
        'max_participants',
        'note',
        'instructeur_id',
        'categorie_id',
        'image_url',
        'est_prive',
        'mot_de_passe',
        'enregistrement_url',
        'duree',
        'course_id'
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'est_prive' => 'boolean',
        'note' => 'decimal:1',
        'nombre_participants' => 'integer',
        'max_participants' => 'integer',
        'duree' => 'integer', // durée en minutes
    ];

    protected $appends = [
        'est_en_direct',
        'est_a_venir',
        'est_termine',
        'duree_formattee',
        'places_disponibles',
        'est_complet',
    ];

    /**
     * Relation avec l'instructeur
     */
    public function instructeur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructeur_id');
    }

    /**
     * Relation avec les participants
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'reunion_user')
                    ->withPivot('statut_participation', 'date_inscription', 'note')
                    ->withTimestamps();
    }

    /**
     * Relation avec la catégorie
     */
    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    /**
     * Relation avec le cours associé
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relation avec les commentaires
     */
    public function commentaires(): HasMany
    {
        return $this->hasMany(Commentaire::class);
    }

    /**
     * Relation avec les commentaires approuvés
     */
    public function commentairesApprouves(): HasMany
    {
        return $this->hasMany(Commentaire::class)->approuves()->principaux();
    }

    /**
     * Vérifie si la réunion est en direct
     */
    public function getEstEnDirectAttribute(): bool
    {
        return $this->statut === self::STATUT_EN_COURS && 
               $this->date_debut <= now() && 
               $this->date_fin >= now();
    }

    /**
     * Vérifie si la réunion est à venir
     */
    public function getEstAVenirAttribute(): bool
    {
        return $this->statut === self::STATUT_PLANIFIE && $this->date_debut > now();
    }

    /**
     * Vérifie si la réunion est terminée
     */
    public function getEstTermineAttribute(): bool
    {
        return $this->statut === self::STATUT_TERMINE || $this->date_fin < now();
    }

    /**
     * Retourne la durée formatée de la réunion
     */
    public function getDureeFormatteeAttribute(): string
    {
        if ($this->duree) {
            $heures = floor($this->duree / 60);
            $minutes = $this->duree % 60;
            
            if ($heures > 0) {
                return "{$heures}h " . ($minutes > 0 ? "{$minutes}min" : "");
            }
            
            return "{$minutes}min";
        }
        
        if ($this->date_debut && $this->date_fin) {
            $diff = $this->date_debut->diff($this->date_fin);
            
            if ($diff->h > 0) {
                return "{$diff->h}h " . ($diff->i > 0 ? "{$diff->i}min" : "");
            }
            
            return "{$diff->i}min";
        }
        
        return 'N/A';
    }

    /**
     * Calculer le nombre de places disponibles
     */
    public function getPlacesDisponiblesAttribute(): ?int
    {
        if ($this->max_participants === null) {
            return null;
        }
        
        return max(0, $this->max_participants - $this->nombre_participants);
    }

    /**
     * Vérifie si la réunion est complète
     */
    public function getEstCompletAttribute(): bool
    {
        if ($this->max_participants === null) {
            return false;
        }
        
        return $this->nombre_participants >= $this->max_participants;
    }

    /**
     * Calculer la note moyenne des commentaires
     */
    public function calculerNoteMoyenne(): float
    {
        $noteMoyenne = $this->commentaires()
            ->approuves()
            ->whereNotNull('note')
            ->avg('note');

        return round($noteMoyenne, 1);
    }

    /**
     * Mettre à jour la note moyenne
     */
    public function mettreAJourNoteMoyenne(): void
    {
        $this->update(['note' => $this->calculerNoteMoyenne()]);
    }

    /**
     * Rejoindre la réunion
     */
    public function rejoindre(): void
    {
        $this->increment('nombre_participants');
    }

    /**
     * Quitter la réunion
     */
    public function quitter(): void
    {
        if ($this->nombre_participants > 0) {
            $this->decrement('nombre_participants');
        }
    }

    /**
     * Démarrer la réunion
     */
    public function demarrer(): void
    {
        $this->update([
            'statut' => self::STATUT_EN_COURS,
            'date_debut' => now(),
        ]);
    }

    /**
     * Terminer la réunion
     */
    public function terminer(): void
    {
        $this->update([
            'statut' => self::STATUT_TERMINE,
            'date_fin' => now(),
            'duree' => $this->date_debut->diffInMinutes(now()),
        ]);
    }

    /**
     * Annuler la réunion
     */
    public function annuler(): void
    {
        $this->update([
            'statut' => self::STATUT_ANNULE,
        ]);
    }

    /**
     * Vérifie si un utilisateur est inscrit à la réunion
     */
    public function estInscrit(User $user): bool
    {
        return $this->participants()->where('user_id', $user->id)->exists();
    }

    /**
     * Vérifie si un utilisateur peut rejoindre la réunion
     */
    public function peutRejoindre(User $user): bool
    {
        // Vérifier si la réunion est complète
        if ($this->est_complet) {
            return false;
        }

        // Vérifier si l'utilisateur est déjà inscrit
        if ($this->estInscrit($user)) {
            return false;
        }

        // Vérifier si la réunion est privée et nécessite un mot de passe
        if ($this->est_prive) {
            // La vérification du mot de passe se fera ailleurs
            return true;
        }

        return true;
    }

    /**
     * Scope pour les réunions en direct
     */
    public function scopeEnDirect($query)
    {
        return $query->where('statut', self::STATUT_EN_COURS)
                    ->where('date_debut', '<=', now())
                    ->where('date_fin', '>=', now());
    }

    /**
     * Scope pour les réunions à venir
     */
    public function scopeAVenir($query)
    {
        return $query->where('statut', self::STATUT_PLANIFIE)
                    ->where('date_debut', '>', now());
    }

    /**
     * Scope pour les réunions terminées
     */
    public function scopeTerminees($query)
    {
        return $query->where('statut', self::STATUT_TERMINE)
                    ->orWhere('date_fin', '<', now());
    }

    /**
     * Scope pour les réunions d'un instructeur
     */
    public function scopeParInstructeur($query, $instructeurId)
    {
        return $query->where('instructeur_id', $instructeurId);
    }

    /**
     * Scope pour les réunions d'une catégorie
     */
    public function scopeParCategorie($query, $categorieId)
    {
        return $query->where('categorie_id', $categorieId);
    }

    /**
     * Scope pour les réunions liées à un cours
     */
    public function scopeParCours($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }

    /**
     * Scope pour les réunions publiques
     */
    public function scopePubliques($query)
    {
        return $query->where('est_prive', false);
    }

    /**
     * Scope pour les réunions populaires
     */
    public function scopePopulaires($query, $limit = 5)
    {
        return $query->orderBy('nombre_participants', 'desc')
                    ->limit($limit);
    }

    /**
     * Scope pour les réunions avec places disponibles
     */
    public function scopeAvecPlaces($query)
    {
        return $query->where(function($q) {
            $q->whereNull('max_participants')
              ->orWhereRaw('nombre_participants < max_participants');
        });
    }}
