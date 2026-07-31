<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FichierDcsp extends Model
{
    use HasFactory;
    protected $table = 'fichier_dcsp';
    protected $fillable = [
        'nom_fichier',
        'chemin',
        'statut',
    ];
}