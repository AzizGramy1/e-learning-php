<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Categorie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'couleur',
        'icone',
        'est_active',
        'ordre_affichage',
        'nombre_reunions',
        'parent_id'
    ];

    protected $casts = [
        'est_active' => 'boolean',
        'ordre_affichage' => 'integer',
        'nombre_reunions' => 'integer',
    ];

    protected $appends = [
        'nombre_reunions_actives',
        'couleur_fond',
        'couleur_texte',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function reunions(): HasMany
    {
        return $this->hasMany(Reunion::class);
    }

    public function reunionsActives(): HasMany
    {
        return $this->hasMany(Reunion::class)
                    ->whereIn('statut', [
                        Reunion::STATUT_PLANIFIE,
                        Reunion::STATUT_EN_COURS
                    ])
                    ->where('date_fin', '>=', now());
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'parent_id');
    }

    public function enfants(): HasMany
    {
        return $this->hasMany(Categorie::class, 'parent_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Boot & Events
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($categorie) {
            if (empty($categorie->slug)) {
                $categorie->slug = Str::slug($categorie->nom);
            }
        });

        static::updating(function ($categorie) {
            if ($categorie->isDirty('nom') && empty($categorie->slug)) {
                $categorie->slug = Str::slug($categorie->nom);
            }
        });

        // mettre à jour le compteur de réunions après sauvegarde
        static::saved(function ($categorie) {
            $categorie->mettreAJourCompteurReunions();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Attributs calculés
    |--------------------------------------------------------------------------
    */
    public function getNombreReunionsActivesAttribute(): int
    {
        return $this->reunionsActives()->count();
    }

    public function getCouleurFondAttribute(): string
    {
        return $this->couleur ?: '#3B82F6';
    }

    public function getCouleurTexteAttribute(): string
    {
        return $this->getContrastColor($this->couleur_fond);
    }

    /*
    |--------------------------------------------------------------------------
    | Méthodes utilitaires
    |--------------------------------------------------------------------------
    */
    public function mettreAJourCompteurReunions(): void
    {
        $this->updateQuietly(['nombre_reunions' => $this->reunions()->count()]);
    }

    public function aReunionsAVenir(): bool
    {
        return $this->reunions()
            ->aVenir()
            ->exists();
    }

    public function aReunionsEnDirect(): bool
    {
        return $this->reunions()
            ->enDirect()
            ->exists();
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    public function scopeActive($query)
    {
        return $query->where('est_active', true);
    }

    public function scopeAvecReunionsAVenir($query)
    {
        return $query->whereHas('reunions', function ($q) {
            $q->aVenir();
        });
    }

    public function scopeAvecReunionsEnDirect($query)
    {
        return $query->whereHas('reunions', function ($q) {
            $q->enDirect();
        });
    }

    public function scopePopulaires($query, $limit = 10)
    {
        return $query->orderByDesc('nombre_reunions')
                     ->limit($limit);
    }

    public function scopePrincipales($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeEnfantsDe($query, $parentId)
    {
        return $query->where('parent_id', $parentId);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('ordre_affichage')
                     ->orderBy('nom');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */
    private function getContrastColor($hexColor): string
    {
        $hexColor = ltrim($hexColor ?? '#000000', '#');

        if (strlen($hexColor) === 3) {
            $hexColor = str_repeat($hexColor[0], 2) .
                        str_repeat($hexColor[1], 2) .
                        str_repeat($hexColor[2], 2);
        }

        $r = hexdec(substr($hexColor, 0, 2));
        $g = hexdec(substr($hexColor, 2, 2));
        $b = hexdec(substr($hexColor, 4, 2));

        $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;

        return $luminance > 0.5 ? '#000000' : '#FFFFFF';
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function pourAffichage(): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'slug' => $this->slug,
            'description' => $this->description,
            'couleur' => $this->couleur,
            'icone' => $this->icone_complete,
            'nombre_reunions' => $this->nombre_reunions,
            'nombre_reunions_actives' => $this->nombre_reunions_actives,
            'est_active' => $this->est_active,
            'has_children' => $this->enfants()->exists(),
            'couleur_fond' => $this->couleur_fond,
            'couleur_texte' => $this->couleur_texte,
        ];
    }

    public function getIconeCompleteAttribute(): string
    {
        $icone = $this->icone ?: 'video';
        if (!preg_match('/^(fa[srb]?|fas|far|fab)\s/', $icone)) {
            return 'fas fa-' . $icone;
        }
        return $icone;
    }


    public function courses()
    {
        return $this->hasMany(Course::class, 'categorie_id');
    }
}
