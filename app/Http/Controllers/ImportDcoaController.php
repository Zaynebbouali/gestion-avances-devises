<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\FichierDcoa;

class ImportDcoaController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'fichier' => 'required|file'
        ]);


        $file = $request->file('fichier');


        $path = $file->store('fichiers_dcoa');


        FichierDcoa::create([
            'nom_fichier' => $file->getClientOriginalName(),
            'chemin' => $path,
            'statut' => 'En attente'
        ]);


        return back()->with(
            'success',
            'Fichier envoyé à l Admin avec succès'
        );

    }
    public function destroy($id)
{
    $fichier = FichierDcoa::findOrFail($id);

    if (Storage::exists($fichier->chemin)) {
        Storage::delete($fichier->chemin);
    }

    $fichier->delete();

    return back()->with('success', 'Fichier supprimé avec succès.');
}
}