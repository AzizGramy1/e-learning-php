<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capsule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'course_id',
    ];

    // Chaque capsule appartient à un cours
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Une capsule peut contenir plusieurs unités
    public function unities()
    {
        return $this->hasMany(Unity::class);
    }

    // Une capsule peut contenir plusieurs quizzes
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    
}
