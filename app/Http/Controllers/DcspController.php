<?php

namespace App\Http\Controllers;

use App\Models\FichierDcsp;

class DcspController extends Controller
{
    public function index()
    {
        $fichiers = FichierDcsp::latest()->get();

        return view('dcsp.dashboard', compact('fichiers'));
    }
}