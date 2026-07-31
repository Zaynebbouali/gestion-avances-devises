<?php

namespace App\Http\Controllers;

use App\Models\FichierDcsp;
use App\Imports\DeficitCaisseImport;
use Maatwebsite\Excel\Facades\Excel;
class AdminDcspController extends Controller
{
    public function index()
    {
        $fichiers = FichierDcsp::latest()->get();

        return view('admin.dcsp', compact('fichiers'));
    }


    public function importer($id)
{
    $fichier = FichierDcsp::findOrFail($id);

    Excel::import(
        new DeficitCaisseImport(),
        storage_path('app/private/' . $fichier->chemin)
    );

    $fichier->update([
        'statut' => 'Importé'
    ]);

    return back()->with(
        'success',
        'Fichier DCSP importé avec succès'
    );
}
}