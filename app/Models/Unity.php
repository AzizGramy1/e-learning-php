<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Unity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',        // titre de l'unité
        'type',         // pdf, video, image, code
        'content',      // chemin du fichier ou contenu du code
        'module_id',    // référence vers le module
    ];

    /**
     * Relation : une unité appartient à un module
     */
    public function module()
    {
        return $this->belongsTo(ModuleCourse::class);
    }
}
