<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Course;
use App\Models\Unity;
use App\Models\Quiz;


class ModuleCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'course_id',
    ];

    // 🔗 Chaque module appartient à un cours
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // 🔗 Chaque module contient plusieurs unités
    public function unities()
    {
        return $this->hasMany(Unity::class);
    }


    // Relation vers les quiz
    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'module_id'); 
    }
}
