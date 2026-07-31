<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichierBancaire extends Model
{
    protected $fillable = [
        'date',
        'nom',
        'banque_id',
    ];

    public function banque()
    {
        return $this->belongsTo(Banque::class);
    }
}