<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TauxDeChangeController;
use App\Http\Controllers\DgfController;
use App\Http\Controllers\PersonnelNavigantController;
use App\Http\Controllers\ImportDcoaController;
use App\Http\Controllers\AdminFichierController;
use App\Http\Controllers\AdminTauxController;
use App\Http\Controllers\AvanceController;
use App\Models\FichierDcoa;
use App\Http\Controllers\DcspController;
use App\Http\Controllers\ImportDcspController;
use App\Http\Controllers\AdminDcspController;
use App\Http\Controllers\BonPaiementController;

Route::get('/', function () {
    return view('accueil');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/dcsp/dashboard', function () {
    return view('dcsp.dashboard');
});

Route::get('/dcoa/dashboard', function () {

    $fichiers = FichierDcoa::latest()->get();

    return view('dcoa.dashboard', compact('fichiers'));

})->name('dcoa.dashboard');


Route::post('/dcoa/import', [ImportDcoaController::class, 'store'])->name('dcoa.import');

Route::resource('users', UserController::class);

Route::get('/dgf/dashboard', [DgfController::class, 'dashboard'])->name('dgf.dashboard');

Route::get('/dgf/taux', [TauxDeChangeController::class, 'create'])->name('taux.create');

Route::post('/dgf/taux', [TauxDeChangeController::class, 'store'])->name('taux.store');

Route::get('/admin/import-pnt', [PersonnelNavigantController::class, 'index'])->name('personnel.import');

Route::post('/admin/import-pnt', [PersonnelNavigantController::class, 'import'])->name('personnel.importer');

Route::get('/admin/fichiers', [AdminFichierController::class, 'index'])->name('admin.fichiers');

Route::get('/admin/importer-fichier/{id}', [AdminFichierController::class, 'importer'])->name('admin.importer.fichier');

Route::get('/admin/taux', [AdminTauxController::class, 'taux'])->name('admin.taux');

Route::get('/admin/dashboard', [AdminTauxController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/logout', function () {

    session()->flush();

    return redirect('/login');

})->name('logout');

Route::post('/admin/calculer-avances',[AvanceController::class,'calculer'])->name('avances.calculer');
Route::get('/admin/avances',[AvanceController::class,'index'])->name('avances.index');

Route::delete('/dcoa/fichier/{id}', [ImportDcoaController::class, 'destroy'])->name('dcoa.destroy');



Route::get('/dcsp/dashboard',[DcspController::class,'index'])->name('dcsp.dashboard');

Route::post('/dcsp/import',[ImportDcspController::class,'store'])->name('dcsp.import');

Route::delete('/dcsp/fichier/{id}',[ImportDcspController::class,'destroy'])->name('dcsp.destroy');

Route::get('/admin/dcsp',[AdminDcspController::class,'index'])->name('admin.dcsp');

Route::post('/admin/dcsp/import/{id}',[AdminDcspController::class,'importer'])->name('admin.dcsp.import');

Route::get('/bon-paiements', [BonPaiementController::class, 'index'])->name('bon.index');

Route::post('/bon-paiements/generer', [BonPaiementController::class, 'generer'])->name('bon.generer');

Route::get('/bon-paiements/{id}', [BonPaiementController::class, 'show'])->name('bon.show');
Route::get('/bon/{id}/fichier-bancaire',
    [BonPaiementController::class,'genererFichier'])
    ->name('bon.fichier');