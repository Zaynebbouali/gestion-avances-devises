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
        'type',
        'devise_totale',
    ];

    public function deficitCaisse()
    {
        return $this->hasOne(DeficitCaisse::class);
    }
     public function banque()
    {
        return $this->belongsTo(Banque::class, 'banque_id');
    }
}