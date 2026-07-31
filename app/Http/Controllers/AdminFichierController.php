<?php

namespace App\Http\Controllers;

use App\Models\FichierDcoa;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PersonnelNavigantImport;

class AdminFichierController extends Controller
{
    public function index()
    {
        $fichiers = FichierDcoa::all();

        return view('admin.fichiers', compact('fichiers'));
    }

    public function importer($id)
{
    $fichier = FichierDcoa::findOrFail($id);


    Excel::import(
        new PersonnelNavigantImport,
        storage_path('app/private/' . $fichier->chemin)
    );


    $fichier->update([
        'statut' => 'Importé'
    ]);


    return back()->with(
        'success',
        'Importation terminée avec succès'
    );
}
}