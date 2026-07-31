<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PersonnelNavigantImport;

class PersonnelNavigantController extends Controller
{
    public function index()
    {
        return view('personnel.import');
    }

    public function import(Request $request)
{
    $request->validate([
        'fichier' => 'required|file|mimes:xlsx,xls,csv'
    ]);

    Excel::import(
        new PersonnelNavigantImport,
        $request->file('fichier')
    );

    return back()->with(
        'success',
        'Fichier PNC importé avec succès'
    );
}
}