<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TauxDechange;

class TauxDeChangeController extends Controller
{
    public function index()
    {
        if(session('role') != 'dgf'){
            abort(403);
        }

        $tauxList = TauxDechange::orderBy('date', 'desc')->get();

        return view('dgf.dashboard', compact('tauxList'));
    }

    public function create()
    {
        if(session('role') != 'dgf'){
            abort(403);
        }

        return view('taux.create');
    }

    public function store(Request $request)
    {
        if(session('role') != 'dgf'){
            abort(403);
        }

        $request->validate([
            'devise' => 'required',
            'taux'   => 'required',
            'date'   => 'required'
        ]);

        TauxDechange::create([
            'devise'  => $request->devise,
            'taux'    => $request->taux,
            'date'    => $request->date,
            'statut' => 'envoye',
            'user_id' => session('user_id')
            
        ]);

        return redirect()->route('dgf.dashboard')
            ->with('success', 'Taux envoyé avec succès');
    }
}