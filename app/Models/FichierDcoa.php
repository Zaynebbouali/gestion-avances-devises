<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichierDcoa extends Model
{
    protected $table = 'fichiers_dcoa';

    protected $fillable = [
        'nom_fichier',
        'chemin',
        'statut'
    ];
}