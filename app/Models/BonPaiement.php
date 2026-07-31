<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonPaiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'montant',
    ];

    public function avances()
    {
        return $this->hasMany(Avance::class, 'bon_paiement_id');
    }
}