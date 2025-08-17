<?php

namespace App\Models;
use App\Models\Certificat;
use App\Models\Message;
use App\Models\Paiement;
use App\Models\Courses;
use App\Models\Rapport;
use App\Models\Forum;
use App\Models\Abonnement;
use App\Models\Quiz;
use App\Models\Reclamation;



// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\UserRole; // Assurez-vous que l'énum UserRole est correctement importée

use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{   
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'nom',
    'email',
    'password',
    'role',
    'avatar_url',
    'adresse',
    'niveau',
    'telephone',
    'date_naissance',
    'langues',
    'progression',
    'heures',
    'skills',
    'badges',
    'social_links',
    'activities',
    'education',
    'experience',
    'goals' 
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
    'role' => UserRole::class,
    'date_naissance' => 'date',
    'skills' => 'array',
    'badges' => 'array',
    'social_links' => 'array',
    'activities' => 'array',
    'education' => 'array',
    'experience' => 'array',
    'goals' => 'array'
];


    // Un étudiant peut s’inscrire à plusieurs cours  (une relation many-to-many entre User et Course)
    // App\Models\User.php
public function courses()
{
    return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id')
                ->withTimestamps()
                ->withPivot('progression', 'date_inscription');
}


    // Un utilisateur peut avoir plusieurs certificats
    public function certificats()
    {
        return $this->hasMany(Certificat::class, 'user_id');
    }

    // Un utilisateur peut avoir plusieurs messages dans le forum
    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id');
    }

    // Un utilisateur peut effectuer plusieurs paiements
    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'user_id');
    }

    // Un utilisateur peut générer plusieurs rapports
    public function rapports()
    {
        return $this->hasMany(Rapport::class, 'user_id');
    }

    // Un utilisateur peut être associé à plusieurs forums (relation inverse)
    public function forums()
    {
        return $this->hasMany(Forum::class, 'user_id');
    }

    ////////////////////////// Méthodes de chargement des relations //////////////////////////
    public function loadAllRelations()
    {
        return $this->load(['certificats', 'messages.forum', 'paiements', 'rapports']);
    }

    public static function scopeWithAllRelations($query)
    {
        return $query->with(['certificats', 'messages.forum', 'paiements', 'rapports']);
    }

    ////////////////////////// Méthodes JWTSubject ///////////////////////////
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Retourne l'ID de l'utilisateur (sub claim)
    }

    public function getJWTCustomClaims()
    {
        return [
            'role' => $this->role, // Bonne pratique pour la gestion des accès
            'nom' => $this->nom,   // Optionnel mais utile pour le frontend
        ];
    }
    
}
