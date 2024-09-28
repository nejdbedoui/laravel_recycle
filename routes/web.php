<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCentreCollecteController;
use App\Http\Controllers\AdminCentreRecyclageController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\SocieteController;
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

Route::redirect('/', '/login');

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

    // Route::get('/child1', [ChildController::class, 'child1'])->name('admin.child1');
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
