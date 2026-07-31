<?php

namespace App\Http\Controllers;

use App\Models\TauxDechange;

class AdminTauxController extends Controller
{
    public function taux()
    {
        $tauxList = TauxDechange::where('statut','envoye')->orderBy('date','desc')->get();

        return view('admin.taux', compact('tauxList'));
    }
    public function dashboard()
{
        $tauxList = TauxDechange::where('statut','envoye')->orderBy('date','desc')->get();

    return view('admin.dashboard', compact('tauxList'));
}
}