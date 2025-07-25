<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
        'password',     // Note: 'mot_de_passe' is the French equivalent of 'password'
        'role',         // Rôle de l'utilisateur (étudiant, formateur, administrateur)
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
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


    public function forums()
    {
        return $this->hasMany(Forum::class, 'user_id'); // Relation inverse ajoutée
    }



    
}
