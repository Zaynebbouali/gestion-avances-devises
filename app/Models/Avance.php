<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avance extends Model
{
    use HasFactory;

    protected $fillable = [
        'montAV',
        'montant_euro',
        'montant_dt',
        'deficit',
        'reste',
        'base',
        'date',
        'statut',
        'user_id',
        'personnel_navigant_id',
        'fichier_bancaire_id',
        'bon_paiement_id',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function personnelNavigant()
    {
        return $this->belongsTo(PersonnelNavigant::class);
    }
   public function bonPaiement()
{
    return $this->belongsTo(BonPaiement::class, 'bon_paiement_id');
}
}