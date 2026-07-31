<?php

namespace App\Http\Controllers;

use App\Models\Avance;
use App\Models\BonPaiement;
use Illuminate\Http\Request;
use App\Models\FichierBancaire;
class BonPaiementController extends Controller
{
    public function index()
    {
        $bons = BonPaiement::latest()->paginate(10);

        return view('admin.bon_paiements.index', compact('bons'));
    }

    public function generer()
    {
        $avances = Avance::whereNull('bon_paiement_id')->get();

        if ($avances->isEmpty()) {
            return redirect()->back()->with('error', 'Aucune avance disponible.');
        }

        $montantTotal = $avances->sum('montAV');

        $bon = BonPaiement::create([
            'date' => now()->toDateString(),
            'montant' => $montantTotal,
        ]);
        foreach ($avances as $avance) {
            $avance->update([
                'bon_paiement_id' => $bon->id,
            ]);
        }

        return redirect()->route('bon.index')
            ->with('success', 'Bon de paiement généré avec succès.');
    }

   public function show($id)
{
    $bon = BonPaiement::findOrFail($id);

    $avances = $bon->avances()
        ->with('personnelNavigant')
        ->paginate(10);

    return view('admin.bon_paiements.show', compact('bon', 'avances'));
}
    public function genererFichier($id)
{
    $bon = BonPaiement::with('avances.personnelNavigant.banque')
        ->findOrFail($id);

    $contenu = "Matricule;Nom;Prenom;Banque;Montant\n";

    foreach ($bon->avances as $avance) {

        $pn = $avance->personnelNavigant;

        $contenu .= 
            $pn->matricule . ";" .
            $pn->nom . ";" .
            $pn->prenom . ";" .
            $pn->banque->nom . ";" .
            $avance->montAV . "\n";
    }

    $nomFichier = "bon_paiement_" . $bon->id . ".txt";

    $path = 'fichiers_bancaires/' . $nomFichier;
    \Storage::disk('local')->put($path, $contenu);

    FichierBancaire::create([
        'date' => now()->toDateString(),
        'nom' => $nomFichier,
        'banque_id' => $bon->avances->first()
            ->personnelNavigant->banque_id,
    ]);
    return response()->download(
    storage_path('app/private/' . $path)
);

}
}