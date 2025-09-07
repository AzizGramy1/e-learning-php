<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Capsule;


class Unity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',        // titre de l'unité
        'type',         // pdf, video, image, code
        'content',      // chemin du fichier ou contenu du code
        'course_id',    // référence vers le cours parent
    ];


    // Une unité appartient à une capsule
    public function capsule()
    {
        return $this->belongsTo(Capsule::class);
    }
}
