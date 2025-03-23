<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificat extends Model
{
    /**
    * Les attributs assignables en masse.
    *
    * @var array
    */
   protected $fillable = [
       'utilisateur_id',  // ID de l'utilisateur qui reçoit le certificat
       'cours_id',        // ID du cours pour lequel le certificat est émis
       'date_emission',   // Date d'émission du certificat (correction du nom de l'attribut)
       'code_certificat', // Code unique du certificat (ex. pour vérification)
   ];

   /**
    * Les attributs qui doivent être convertis en types natifs.
    *
    * @var array
    */
   protected $casts = [
       'date_emission' => 'datetime', // Correction du nom de l'attribut pour éviter les erreurs SQL
   ];}
