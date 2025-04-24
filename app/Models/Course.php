<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Relations\Relation as EloquentRelation;

class Course extends Model
{
     /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    use HasFactory; // Ajout essentiel

        protected $fillable = [
            'titre',       // Titre du cours
            'description', // Description du cours
            'image',       // Image du cours (optionnelle)
        ];
}


