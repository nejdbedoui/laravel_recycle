<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCentreCollecteController;
use App\Http\Controllers\AdminCentreRecyclageController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\SocieteController;
use App\Http\Controllers\EvenementCommunautaireController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\DechetController;
use App\Http\Controllers\TypeDechetController;
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



// Routes CRUD pour les Déchets

    Route::get('/dechetlist', [DechetController::class, 'index'])->name('backOffice.listDechet');

    // Afficher le formulaire d'ajout de déchet
    Route::get('/dechetcreate', [DechetController::class, 'create'])->name('backOffice.createDechet');

    // Ajouter un nouveau déchet
    Route::post('/dechetstore', [DechetController::class, 'store'])->name('backOffice.storeDechet');

    // Afficher le formulaire d'édition d'un déchet existant
    Route::get('/dechetedit/{id}', [DechetController::class, 'edit'])->name('backOffice.editDechet');

    // Mettre à jour un déchet existant
    Route::put('/dechetupdate/{id}', [DechetController::class, 'update'])->name('backOffice.updateDechet');

    // Supprimer un déchet
    Route::delete('/dechetdelete/{id}', [DechetController::class, 'destroy'])->name('backOffice.deleteDechet');
    // Route::get('/child1', [ChildController::class, 'child1'])->name('admin.child1');



    // Routes CRUD pour les Types de Déchets
    Route::get('/typeDechetlist', [TypeDechetController::class, 'index'])->name('backOffice.listTypeDechet');

// Afficher le formulaire d'ajout de type de déchet
    Route::get('/typeDechetcreate', [TypeDechetController::class, 'create'])->name('backOffice.createTypeDechet');

// Ajouter un nouveau type de déchet
    Route::post('/typeDechetstore', [TypeDechetController::class, 'store'])->name('backOffice.storeTypeDechet');

// Afficher le formulaire d'édition d'un type de déchet existant
    Route::get('/typeDechetedit/{id}', [TypeDechetController::class, 'edit'])->name('backOffice.editTypeDechet');

// Mettre à jour un type de déchet existant
    Route::put('/typeDechetupdate/{id}', [TypeDechetController::class, 'update'])->name('backOffice.updateTypeDechet');

// Supprimer un type de déchet
    Route::delete('/typeDechetdelete/{id}', [TypeDechetController::class, 'destroy'])->name('backOffice.deleteTypeDechet');


    Route::post('/addZone', [AdminController::class, 'addZone'])->name('backOffice.addZone');
    Route::get('/listZone', [AdminController::class, 'listZone'])->name('backOffice.listZone');
    Route::get('/detailZone/{id}', [AdminController::class, 'detailZone'])->name('backOffice.detailZone');
    Route::post('/deleteZone/{id}', [AdminController::class, 'deletezone'])->name('zone.delete');
    
    Route::post('/addCentreCollecte', [AdminController::class, 'addCentreCollecte'])->name('backOffice.addCentreCollecte');
    Route::get('/listCentreCollecte', [AdminController::class, 'listCentreCollecte'])->name('backOffice.listCentreCollecte');
    Route::get('/detailCentreCollecte{id}', [AdminController::class, 'detailCentreCollecte'])->name('backOffice.detailCentreCollecte');
    Route::post('/deleteCentreCollecte/{id}', [AdminController::class, 'deleteCentreCollecte'])->name('CentreCollecte.delete');
    

});

Route::prefix('adminCentreCollecte')->middleware(['auth', 'verified', 'role:adminCentreCollecte'])->group(function () {
    Route::get('/', [AdminCentreCollecteController::class, 'adminCentreCollecteDashboard'])->name('frontOffice.adminCentreCollecteDashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [AdminCentreCollecteController::class, 'edit'])->name('frontOffice.adminCentreCollecteProfile.edit');
        Route::patch('/profile', [AdminCentreCollecteController::class, 'update'])->name('frontOffice.adminCentreCollecteProfile.update');
        Route::delete('/profile', [AdminCentreCollecteController::class, 'destroy'])->name('frontOffice.adminCentreCollecteProfile.destroy');
    });

    // Route::get('/child1', [ChildController::class, 'child1'])->name('admin.child1');
});

Route::prefix('adminCentreRecyclage')->middleware(['auth', 'verified', 'role:adminCentreRecyclage'])->group(function () {
    Route::get('/', [AdminCentreRecyclageController::class, 'adminCentreRecyclageDashboard'])->name('frontOffice.adminCentreRecyclageDashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [AdminCentreRecyclageController::class, 'edit'])->name('frontOffice.adminCentreRecyclageProfile.edit');
        Route::patch('/profile', [AdminCentreRecyclageController::class, 'update'])->name('frontOffice.adminCentreRecyclageProfile.update');
        Route::delete('/profile', [AdminCentreRecyclageController::class, 'destroy'])->name('frontOffice.adminCentreRecyclageProfile.destroy');
    });

    // Route::get('/child1', [ChildController::class, 'child1'])->name('admin.child1');
});

Route::prefix('chauffeur')->middleware(['auth', 'verified', 'role:chauffeur'])->group(function () {
    Route::get('/', [ChauffeurController::class, 'chauffeurDashboard'])->name('frontOffice.chauffeurDashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ChauffeurController::class, 'edit'])->name('frontOffice.chauffeurProfile.edit');
        Route::patch('/profile', [ChauffeurController::class, 'update'])->name('frontOffice.chauffeurProfile.update');
        Route::delete('/profile', [ChauffeurController::class, 'destroy'])->name('frontOffice.chauffeurProfile.destroy');
    });

    // Route::get('/child1', [ChildController::class, 'child1'])->name('admin.child1');
});

Route::prefix('societe')->middleware(['auth', 'verified', 'role:societe'])->group(function () {
    Route::get('/', [SocieteController::class, 'societeDashboard'])->name('frontOffice.societeDashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [SocieteController::class, 'edit'])->name('frontOffice.societeProfile.edit');
        Route::patch('/profile', [SocieteController::class, 'update'])->name('frontOffice.societeProfile.update');
        Route::delete('/profile', [SocieteController::class, 'destroy'])->name('frontOffice.societeProfile.destroy');
    });

    // Route::get('/child1', [ChildController::class, 'child1'])->name('admin.child1');
});

require __DIR__.'/auth.php';
