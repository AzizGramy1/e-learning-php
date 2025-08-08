<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'administrateur';
    case FORMATEUR = 'formateur';
    case ETUDIANT = 'étudiant';
}