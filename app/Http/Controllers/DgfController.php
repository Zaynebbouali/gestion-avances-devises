<?php

namespace App\Http\Controllers;

use App\Models\TauxDechange;

class DgfController extends Controller
{
    public function dashboard()
    {

        if(session('role') != 'dgf'){
            abort(403);
        }


        $tauxList = TauxDechange::orderBy('date', 'desc')->get();

        return view('dgf.dashboard', compact('tauxList'));

    }
}