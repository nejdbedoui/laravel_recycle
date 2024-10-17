<?php

namespace App\Http\Controllers;

use App\Models\AdminCentreCollecte;
use App\Models\AdminCentreRecyclage;
use App\Models\Chauffeur;
use App\Models\DemandeDechet;
use App\Models\Deplacement;
use App\Models\ZoneCollecte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeplacementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deplacements = Deplacement::all();

        // Récupérer tous les chauffeurs
        $chauffeurs = Chauffeur::all();

        return view('backOffice.listTrips', compact('deplacements', 'chauffeurs'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.listTrips');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int demandeDechetId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $demandeDechetId)
    {
        // Valider les données de la requête
        $validated = $request->validate([
            'date' => 'required|date|after:today',
            'chauffeur_id' => 'required|exists:users,id',
        ]);

        // Vérifier si le chauffeur est déjà assigné à un déplacement à cette date
        $deplacementExistant = Deplacement::where('chauffeur_id', $validated['chauffeur_id'])
            ->where('date', $validated['date'])
            ->exists();

        if ($deplacementExistant) {
            return redirect()->back()->with('error', 'This driver is already assigned to another trip on the selected date.');
        }

        // Trouver la demande de déchet par son ID
        $demandeDechet = DemandeDechet::findOrFail($demandeDechetId);

        // Créer un nouveau déplacement (trip) pour cette demande de déchet
        $demandeDechet->deplacement()->create([
            'date' => $validated['date'],
            'chauffeur_id' => $validated['chauffeur_id'],
            'demande_dechet_id' => $demandeDechet->id,
        ]);

        // Rediriger vers la liste des déplacements avec un message de succès
        return redirect()->route('backOffice.listTrips')->with('success', 'Trip created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $deplacement = Deplacement::findOrFail($id);

        return view('backOffice.listTrips', compact('deplacement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Valider les données soumises
        $validated = $request->validate([
            'date' => 'required|date|after:today',
            'chauffeur_id' => 'required|exists:users,id',
        ]);

        // Trouver le déplacement existant
        $deplacement = Deplacement::findOrFail($id);

        // Vérifier si le chauffeur est déjà assigné à un autre déplacement à la même date
        $deplacementExistant = Deplacement::where('chauffeur_id', $validated['chauffeur_id'])
            ->where('date', $validated['date'])
            ->where('id', '!=', $id) // Exclure le déplacement actuel
            ->exists();

        if ($deplacementExistant) {
            return redirect()->back()->with('error', 'This driver is already assigned to another trip on the selected date.');
        }

        // Mettre à jour le déplacement
        $deplacement->update([
            'date' => $validated['date'],
            'chauffeur_id' => $validated['chauffeur_id'],
        ]);

        return redirect()->route('backOffice.listTrips')->with('success', 'Trip updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deplacement = Deplacement::findOrFail($id);

        $deplacement->delete();

        return redirect()->route('backOffice.listTrips')->with('success', 'Trip deleted successfully.');
    }


    public function indexForAdminCentreCollecte()
    {
        $zoneCollectes = ZoneCollecte::all();

        $adminCentreCollecte = AdminCentreCollecte::findOrFail(Auth::user()->id);

        $centreCollecte = $adminCentreCollecte->centreCollecte;
        $dechets = $centreCollecte->dechets;
        $demandesDechets = DemandeDechet::whereIn('dechet_id', $dechets->pluck('id'))->get();

        $deplacements = Deplacement::whereIn('demande_dechet_id', $demandesDechets->pluck('id'))->get();

        return view('frontOffice.adminCentreCollecte.listTrips', compact('deplacements', 'centreCollecte', 'zoneCollectes'));
    }

    public function indexForAdminCentreRecyclage()
    {
        $adminCentreRecyclage = AdminCentreRecyclage::findOrFail(Auth::user()->id);

        $centreRecyclage = $adminCentreRecyclage->centreRecyclage;
        $demandesDechets = $centreRecyclage->demandesDechets;

        $deplacements = Deplacement::whereIn('demande_dechet_id', $demandesDechets->pluck('id'))->get();

        return view('frontOffice.adminCentreRecyclage.listTrips', compact('deplacements', 'centreRecyclage'));
    }

    public function indexForChauffeur()
    {
        $chauffeur = Chauffeur::findOrFail(Auth::user()->id);

        $deplacements = $chauffeur->deplacements;

        return view('frontOffice.chauffeur.listTrips', compact('deplacements'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deliveredDeplacement(Request $request, $id)
    {
        $deplacement = Deplacement::findOrFail($id);

        $deplacement->update([
            'etat' => 'Delivered',
        ]);

        return redirect()->route('frontOffice.chauffeur.listTrips')->with('success', 'Trip delivered successfully.');
    }

}
