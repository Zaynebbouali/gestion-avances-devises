<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeficitCaisse extends Model
{
    use HasFactory;

    protected $table = 'deficit_caisses';

    protected $fillable = [
        'montant',
        'reste',
        'date',
        'personnel_navigant_id',
    ];

    public function personnelNavigant()
    {
        return $this->belongsTo(PersonnelNavigant::class);
    }
}