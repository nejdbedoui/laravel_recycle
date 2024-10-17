<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCentreCollecteController;
use App\Http\Controllers\AdminCentreRecyclageController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\SocieteController;
use App\Http\Controllers\EvenementCommunautaireController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\ZoneCollecteController;
use App\Http\Controllers\TypeDechetController;
use App\Http\Controllers\CentreCollecteController;
use App\Http\Controllers\CentreRecyclageController;
use App\Http\Controllers\DechetController;
use App\Http\Controllers\MatierePremiereController;
use App\Http\Controllers\TypeRecyclageController;
use App\Http\Controllers\DemandeMatierePremiereController;
use App\Http\Controllers\DemandeDechetController;
use App\Http\Controllers\DeplacementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [EvenementCommunautaireController::class, 'index'])->name('home.home');
Route::get('/detailEvenementCommunautaire/{id}', [EvenementCommunautaireController::class, 'show'])->name('home.detailEvenementCommunautaire');
Route::post('/addCommentaire/{evenementId}', [CommentaireController::class, 'store'])->name('home.storeCommentaire');

Route::get('/getAvailableDrivers', [ChauffeurController::class, 'getAvailableDrivers']);
Route::get('/getAvailableDriversUpdate', [ChauffeurController::class, 'getAvailableDriversUpdate']);


Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'adminDashboard'])->name('backOffice.adminDashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [AdminController::class, 'edit'])->name('backOffice.adminProfile.edit');
        Route::patch('/profile', [AdminController::class, 'update'])->name('backOffice.adminProfile.update');
        Route::delete('/profile', [AdminController::class, 'destroy'])->name('backOffice.adminProfile.destroy');
    });

    Route::get('/listSociete', [AdminController::class, 'listSociete'])->name('backOffice.listSociete');
    Route::get('/detailSociete/{id}', [AdminController::class, 'detailSociete'])->name('backOffice.detailSociete');

    Route::post('/addChauffeur', [AdminController::class, 'addChauffeur'])->name('backOffice.addChauffeur');
    Route::get('/listChauffeur', [AdminController::class, 'listChauffeur'])->name('backOffice.listChauffeur');
    Route::get('/detailChauffeur/{id}', [AdminController::class, 'detailChauffeur'])->name('backOffice.detailChauffeur');

    Route::post('/addAdminCentreCollecte', [AdminController::class, 'addAdminCentreCollecte'])->name('backOffice.addAdminCentreCollecte');
    Route::get('/listAdminCentreCollecte', [AdminController::class, 'listAdminCentreCollecte'])->name('backOffice.listAdminCentreCollecte');
    Route::get('/detailAdminCentreCollecte/{id}', [AdminController::class, 'detailAdminCentreCollecte'])->name('backOffice.detailAdminCentreCollecte');

    Route::post('/addAdminCentreRecyclage', [AdminController::class, 'addAdminCentreRecyclage'])->name('backOffice.addAdminCentreRecyclage');
    Route::get('/listAdminCentreRecyclage', [AdminController::class, 'listAdminCentreRecyclage'])->name('backOffice.listAdminCentreRecyclage');
    Route::get('/detailAdminCentreRecyclage/{id}', [AdminController::class, 'detailAdminCentreRecyclage'])->name('backOffice.detailAdminCentreRecyclage');

    Route::post('/enableUser/{id}', [AdminController::class, 'enableUser'])->name('user.enable');
    Route::post('/disableUser/{id}', [AdminController::class, 'disableUser'])->name('user.disable');

    Route::post('/addEvenementCommunautaire', [EvenementCommunautaireController::class, 'store'])->name('backOffice.storeEvenementCommunautaire');
    Route::get('/listEvenementCommunautaire', [EvenementCommunautaireController::class, 'indexAdmin'])->name('backOffice.listEvenementCommunautaire');
    Route::get('/detailEvenementCommunautaire/{id}', [EvenementCommunautaireController::class, 'showAdmin'])->name('backOffice.detailEvenementCommunautaire');
    Route::get('/editEvenementCommunautaire/{id}', [EvenementCommunautaireController::class, 'edit'])->name('backOffice.editEvenementCommunautaire');
    Route::put('/updateEvenementCommunautaire/{id}', [EvenementCommunautaireController::class, 'update'])->name('backOffice.updateEvenementCommunautaire');
    Route::delete('/deleteEvenementCommunautaire/{id}', [EvenementCommunautaireController::class, 'destroy'])->name('backOffice.deleteEvenementCommunautaire');

    Route::delete('/deleteCommentaire/{id}', [CommentaireController::class, 'destroy'])->name('backOffice.deleteCommentaire');

    Route::post('/addZoneCollecte', [ZoneCollecteController::class, 'store'])->name('backOffice.storeZoneCollecte');
    Route::get('/listZoneCollecte', [ZoneCollecteController::class, 'index'])->name('backOffice.listZoneCollecte');
    Route::get('/detailZoneCollecte/{id}', [ZoneCollecteController::class, 'show'])->name('backOffice.detailZoneCollecte');
    Route::get('/editZoneCollecte/{id}', [ZoneCollecteController::class, 'edit'])->name('backOffice.editZoneCollecte');
    Route::put('/updateZoneCollecte/{id}', [ZoneCollecteController::class, 'update'])->name('backOffice.updateZoneCollecte');
    Route::delete('/deleteZoneCollecte/{id}', [ZoneCollecteController::class, 'destroy'])->name('backOffice.deleteZoneCollecte');
    Route::post('/assignChauffeurs/{id}', [ZoneCollecteController::class, 'assignChauffeursToZone'])->name('backOffice.assignChauffeursToZone');
    Route::post('/unassignChauffeurs/{id}', [ZoneCollecteController::class, 'unassignChauffeursFromZone'])->name('backOffice.unassignChauffeursFromZone');

    Route::post('/addTypeDechet', [TypeDechetController::class, 'store'])->name('backOffice.storeTypeDechet');
    Route::get('/listTypeDechet', [TypeDechetController::class, 'index'])->name('backOffice.listTypeDechet');
    Route::get('/editTypeDechet/{id}', [TypeDechetController::class, 'edit'])->name('backOffice.editTypeDechet');
    Route::put('/updateTypeDechet/{id}', [TypeDechetController::class, 'update'])->name('backOffice.updateTypeDechet');
    Route::delete('/deleteTypeDechet/{id}', [TypeDechetController::class, 'destroy'])->name('backOffice.deleteTypeDechet');

    Route::get('/listDemandeDechet', [DemandeDechetController::class, 'index'])->name('backOffice.listDemandeDechet');

    Route::get('/listTrips', [DeplacementController::class, 'index'])->name('backOffice.listTrips');
    Route::post('/addTrip/{demandeDechetId}', [DeplacementController::class, 'store'])->name('backOffice.storeTrip');
    Route::put('/updateTrip/{id}', [DeplacementController::class, 'update'])->name('backOffice.updateTrip');
    Route::delete('/deleteTrip/{id}', [DeplacementController::class, 'destroy'])->name('backOffice.deleteTrip');

});

Route::prefix('adminCentreCollecte')->middleware(['auth', 'verified', 'role:adminCentreCollecte'])->group(function () {
    Route::get('/', [AdminCentreCollecteController::class, 'adminCentreCollecteDashboard'])->name('frontOffice.adminCentreCollecteDashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [AdminCentreCollecteController::class, 'edit'])->name('frontOffice.adminCentreCollecteProfile.edit');
        Route::patch('/profile', [AdminCentreCollecteController::class, 'update'])->name('frontOffice.adminCentreCollecteProfile.update');
        Route::delete('/profile', [AdminCentreCollecteController::class, 'destroy'])->name('frontOffice.adminCentreCollecteProfile.destroy');
    });

    Route::post('/addCentreCollecte', [CentreCollecteController::class, 'store'])->name('frontOffice.adminCentreCollecte.storeCentreCollecte');
    Route::get('/listCentreCollecte', [CentreCollecteController::class, 'index'])->name('frontOffice.adminCentreCollecte.listCentreCollecte');
    Route::get('/detailCentreCollecte', [CentreCollecteController::class, 'show'])->name('frontOffice.adminCentreCollecte.detailCentreCollecte');
    Route::get('/editCentreCollecte/{id}', [CentreCollecteController::class, 'edit'])->name('frontOffice.adminCentreCollecte.editCentreCollecte');
    Route::put('/updateCentreCollecte/{id}', [CentreCollecteController::class, 'update'])->name('frontOffice.adminCentreCollecte.updateCentreCollecte');
    Route::delete('/deleteCentreCollecte/{id}', [CentreCollecteController::class, 'destroy'])->name('frontOffice.adminCentreCollecte.deleteCentreCollecte');

    Route::get('/listTypeDechet', [TypeDechetController::class, 'indexAdminCentreCollecte'])->name('frontOffice.adminCentreCollecte.listTypeDechet');

    Route::post('/addDechet', [DechetController::class, 'store'])->name('frontOffice.adminCentreCollecte.storeDechet');
    Route::get('/listDechet', [DechetController::class, 'index'])->name('frontOffice.adminCentreCollecte.listDechet');
    Route::get('/detailDechet', [DechetController::class, 'show'])->name('frontOffice.adminCentreCollecte.detailDechet');
    Route::get('/editDechet/{id}', [DechetController::class, 'edit'])->name('frontOffice.adminCentreCollecte.editDechet');
    Route::put('/updateDechet/{id}', [DechetController::class, 'update'])->name('frontOffice.adminCentreCollecte.updateDechet');
    Route::delete('/deleteDechet/{id}', [DechetController::class, 'destroy'])->name('frontOffice.adminCentreCollecte.deleteDechet');

    Route::get('/listDemandeDechet', [DemandeDechetController::class, 'indexForAdminCentreCollecte'])->name('frontOffice.adminCentreCollecte.listDemandeDechet');
    Route::put('/confirmDemandeDechet/{id}', [DemandeDechetController::class, 'confirmDemandeDechet'])->name('frontOffice.adminCentreCollecte.confirmDemandeDechet');

    Route::get('/listTrips', [DeplacementController::class, 'indexForAdminCentreCollecte'])->name('frontOffice.adminCentreCollecte.listTrips');
});

Route::prefix('adminCentreRecyclage')->middleware(['auth', 'verified', 'role:adminCentreRecyclage'])->group(function () {
    Route::get('/', [AdminCentreRecyclageController::class, 'adminCentreRecyclageDashboard'])->name('frontOffice.adminCentreRecyclageDashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [AdminCentreRecyclageController::class, 'edit'])->name('frontOffice.adminCentreRecyclageProfile.edit');
        Route::patch('/profile', [AdminCentreRecyclageController::class, 'update'])->name('frontOffice.adminCentreRecyclageProfile.update');
        Route::delete('/profile', [AdminCentreRecyclageController::class, 'destroy'])->name('frontOffice.adminCentreRecyclageProfile.destroy');
    });

    Route::post('/addCentreRecyclage', [CentreRecyclageController::class, 'store'])->name('frontOffice.adminCentreRecyclage.storeCentreRecyclage');
    Route::get('/listCentreRecyclage', [CentreRecyclageController::class, 'index'])->name('frontOffice.adminCentreRecyclage.listCentreRecyclage');
    Route::get('/detailCentreRecyclage', [CentreRecyclageController::class, 'show'])->name('frontOffice.adminCentreRecyclage.detailCentreRecyclage');
    Route::get('/editCentreRecyclage/{id}', [CentreRecyclageController::class, 'edit'])->name('frontOffice.adminCentreRecyclage.editCentreRecyclage');
    Route::put('/updateCentreRecyclage/{id}', [CentreRecyclageController::class, 'update'])->name('frontOffice.adminCentreRecyclage.updateCentreRecyclage');
    Route::delete('/deleteCentreRecyclage/{id}', [CentreRecyclageController::class, 'destroy'])->name('frontOffice.adminCentreRecyclage.deleteCentreRecyclage');

    Route::post('/addMatierePremiere', [MatierePremiereController::class, 'store'])->name('frontOffice.adminCentreRecyclage.storeMatierePremiere');
    Route::get('/listMatierePremiere', [MatierePremiereController::class, 'index'])->name('frontOffice.adminCentreRecyclage.listMatierePremiere');
    Route::get('/detailMatierePremiere', [MatierePremiereController::class, 'show'])->name('frontOffice.adminCentreRecyclage.detailMatierePremiere');
    Route::get('/editMatierePremiere/{id}', [MatierePremiereController::class, 'edit'])->name('frontOffice.adminCentreRecyclage.editMatierePremiere');
    Route::put('/updateMatierePremiere/{id}', [MatierePremiereController::class, 'update'])->name('frontOffice.adminCentreRecyclage.updateMatierePremiere');
    Route::delete('/deleteMatierePremiere/{id}', [MatierePremiereController::class, 'destroy'])->name('frontOffice.adminCentreRecyclage.deleteMatierePremiere');

    Route::post('/addTypeRecyclage', [TypeRecyclageController::class, 'store'])->name('frontOffice.adminCentreRecyclage.storeTypeRecyclage');
    Route::get('/listTypeRecyclage', [TypeRecyclageController::class, 'index'])->name('frontOffice.adminCentreRecyclage.listTypeRecyclage');
    Route::get('/detailTypeRecyclage', [TypeRecyclageController::class, 'show'])->name('frontOffice.adminCentreRecyclage.detailTypeRecyclage');
    Route::get('/editTypeRecyclage/{id}', [TypeRecyclageController::class, 'edit'])->name('frontOffice.adminCentreRecyclage.editTypeRecyclage');
    Route::put('/updateTypeRecyclage/{id}', [TypeRecyclageController::class, 'update'])->name('frontOffice.adminCentreRecyclage.updateTypeRecyclage');
    Route::delete('/deleteTypeRecyclage/{id}', [TypeRecyclageController::class, 'destroy'])->name('frontOffice.adminCentreRecyclage.deleteTypeRecyclage');

    Route::get('/listCentreCollecte', [CentreCollecteController::class, 'indexForAdminCentreRecyclage'])->name('frontOffice.adminCentreRecyclage.listCentreCollecte');
    Route::get('/detailCentreCollecte/{idt}', [CentreCollecteController::class, 'showForAdminCentreRecyclage'])->name('frontOffice.adminCentreRecyclage.detailCentreCollecte');

    Route::get('/listDemandeMatierePremiere', [DemandeMatierePremiereController::class, 'indexForAdminCentreRecyclage'])->name('frontOffice.adminCentreRecyclage.listDemandeMatierePremiere');
    Route::put('/confirmDemandeMatierePremiere/{id}', [DemandeMatierePremiereController::class, 'confirmDemandeMatierePremiere'])->name('frontOffice.adminCentreRecyclage.confirmDemandeMatierePremiere');

    Route::post('/addDemandeDechet', [DemandeDechetController::class, 'store'])->name('frontOffice.adminCentreRecyclage.storeDemandeDechet');
    Route::get('/listDemandeDechet', [DemandeDechetController::class, 'indexForAdminCentreRecyclage'])->name('frontOffice.adminCentreRecyclage.listDemandeDechet');
    Route::put('/updateDemandeDechet/{id}', [DemandeDechetController::class, 'update'])->name('frontOffice.adminCentreRecyclage.updateDemandeDechet');
    Route::delete('/deleteDemandeDechet/{id}', [DemandeDechetController::class, 'destroy'])->name('frontOffice.adminCentreRecyclage.deleteDemandeDechet');

    Route::get('/listTrips', [DeplacementController::class, 'indexForAdminCentreRecyclage'])->name('frontOffice.adminCentreRecyclage.listTrips');
});

Route::prefix('chauffeur')->middleware(['auth', 'verified', 'role:chauffeur'])->group(function () {
    Route::get('/', [ChauffeurController::class, 'chauffeurDashboard'])->name('frontOffice.chauffeurDashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ChauffeurController::class, 'edit'])->name('frontOffice.chauffeurProfile.edit');
        Route::patch('/profile', [ChauffeurController::class, 'update'])->name('frontOffice.chauffeurProfile.update');
        Route::delete('/profile', [ChauffeurController::class, 'destroy'])->name('frontOffice.chauffeurProfile.destroy');
    });

    Route::get('/listZoneCollecte', [ZoneCollecteController::class, 'listForChauffeur'])->name('frontOffice.chauffeur.listZoneCollecte');

    Route::get('/listTrips', [DeplacementController::class, 'indexForChauffeur'])->name('frontOffice.chauffeur.listTrips');
    Route::put('/deliveredDeplacement/{id}', [DeplacementController::class, 'deliveredDeplacement'])->name('frontOffice.chauffeur.deliveredDeplacement');
});

Route::prefix('societe')->middleware(['auth', 'verified', 'role:societe'])->group(function () {
    Route::get('/', [SocieteController::class, 'societeDashboard'])->name('frontOffice.societeDashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [SocieteController::class, 'edit'])->name('frontOffice.societeProfile.edit');
        Route::patch('/profile', [SocieteController::class, 'update'])->name('frontOffice.societeProfile.update');
        Route::delete('/profile', [SocieteController::class, 'destroy'])->name('frontOffice.societeProfile.destroy');
    });

    Route::get('/listCentreRecyclage', [CentreRecyclageController::class, 'indexForCompany'])->name('frontOffice.societe.listCentreRecyclage');
    Route::get('/detailCentreRecyclage/{id}', [CentreRecyclageController::class, 'showForCompany'])->name('frontOffice.societe.detailCentreRecyclage');

    Route::post('/addDemandeMatierePremiere', [DemandeMatierePremiereController::class, 'store'])->name('frontOffice.societe.storeDemandeMatierePremiere');
    Route::get('/listDemandeMatierePremiere', [DemandeMatierePremiereController::class, 'indexForCompany'])->name('frontOffice.societe.listDemandeMatierePremiere');
    Route::put('/updateDemandeMatierePremiere/{id}', [DemandeMatierePremiereController::class, 'update'])->name('frontOffice.societe.updateDemandeMatierePremiere');
    Route::delete('/deleteDemandeMatierePremiere/{id}', [DemandeMatierePremiereController::class, 'destroy'])->name('frontOffice.societe.deleteDemandeMatierePremiere');
});

require __DIR__.'/auth.php';
