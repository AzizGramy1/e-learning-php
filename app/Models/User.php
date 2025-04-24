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
        'mot_de_passe',
        'role',         // Rôle de l'utilisateur (étudiant, formateur, administrateur)
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'mot_de_passe',
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
            'mot_de_passe' => 'hashed',
        ];
    }


    // Un utilisateur peut avoir plusieurs certificats
    public function certificats()
    {
        return $this->hasMany(Certificat::class, 'utilisateur_id');
    }

    // Un utilisateur peut avoir plusieurs messages dans le forum
    public function messages()
    {
        return $this->hasMany(Message::class, 'utilisateur_id');
    }

    // Un utilisateur peut effectuer plusieurs paiements
    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'utilisateur_id');
    }

    // Un utilisateur peut générer plusieurs rapports
    public function rapports()
    {
        return $this->hasMany(Rapport::class, 'utilisateur_id');
    }


    public function forums()
    {
        return $this->hasMany(Forum::class, 'utilisateur_id'); // Relation inverse ajoutée
    }



    
}
