<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RessourceDevoir extends Model
{
    use HasFactory;

    protected $fillable = [
        'devoir_id', // 🔗 clé étrangère
        'name',
        'description',
        'icon',
        'iconType',
        'linkName',
        'linkDescription'
    ];

    // 🔹 Relation inverse : une ressource appartient à un devoir
    public function devoir()
    {
        return $this->belongsTo(Devoir::class);
    }
}
