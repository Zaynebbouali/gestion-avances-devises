<?php

namespace App\Http\Controllers;

use App\Models\Avance;
use App\Models\PersonnelNavigant;
use App\Models\TauxDechange;
use App\Models\DeficitCaisse;

class AvanceController extends Controller
{
    public function index()
    {
        $avances = Avance::with('personnelNavigant')
            ->paginate(10);

        return view('admin.avance', compact('avances'));
    }


    public function calculer()
    {
        $taux = TauxDechange::latest()->first();

        if (!$taux) {
            return back()->with(
                'error',
                'Aucun taux de change disponible'
            );
        }


        $personnels = PersonnelNavigant::all();


        foreach ($personnels as $pn) {


            if ($pn->type == 'PNT') {


                $deviseFinal = 250;


                $montantTnd = $deviseFinal * $taux->taux;



                Avance::updateOrCreate(

                    [
                        'personnel_navigant_id' => $pn->id
                    ],

                    [
                        'montant_euro' => $deviseFinal,
                        'montAV' => $montantTnd,
                        'deficit' => 0,
                        'reste' => 0,
                        'base' => $pn->base,
                        'date' => now(),
                        'statut' => 'validee',
                        'user_id' => 5
                    ]

                );



            } else {


                $devise = $pn->devise_totale;

                $deficitTotal = DeficitCaisse::where('personnel_navigant_id', $pn->id)->whereMonth('date', now()->month)->whereYear('date', now()->year)->sum('montant');

                $resteAncien = DeficitCaisse::where('personnel_navigant_id', $pn->id)->whereMonth('date', now()->subMonth()->month)->whereYear('date', now()->subMonth()->year)->value('reste') ?? 0;



               $totalDeficit = $deficitTotal + $resteAncien;


                $deductionTnd = floor($totalDeficit / 5) * 5;



                $reste = $totalDeficit % 5;


$montantInitialTnd = $devise * $taux->taux;

$montantTnd = $montantInitialTnd - $deductionTnd;

if ($montantTnd < 0) {
    $montantTnd = 0;
}

$deviseFinal = $montantTnd / $taux->taux;

DeficitCaisse::where('personnel_navigant_id', $pn->id)->whereMonth('date', now()->month)->whereYear('date', now()->year)->update([
        'reste' => $reste
    ]);



                Avance::updateOrCreate(

                    [
                        'personnel_navigant_id' => $pn->id
                    ],

                    [

                        'montant_euro' => $deviseFinal,

                        'montAV' => $montantTnd,

                        'deficit' => $deductionTnd,

                        'reste' => $reste,

                        'base' => $pn->base,

                        'date' => now(),

                        'statut' => 'en_attente',

                        'user_id' => 5

                    ]

                );

            }

        }



        return back()->with(
            'success',
            'Calcul des avances terminé avec succès'
        );
    }
}