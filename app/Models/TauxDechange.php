<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TauxDechange extends Model
{
    use HasFactory;

    protected $fillable = [
        'taux',
        'devise',
        'date',
        'user_id',
        'statut',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}