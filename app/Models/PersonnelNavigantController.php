<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonnelNavigant extends Model
{
    protected $fillable = [
    'matricule',
    'nom',
    'prenom',
    'base',
    'banque_id',
    'type'
];
}
