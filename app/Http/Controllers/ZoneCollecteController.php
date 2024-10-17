<?php

namespace App\Http\Controllers;

use App\Models\Chauffeur;
use App\Models\ZoneCollecte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZoneCollecteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zoneCollectes = ZoneCollecte::all();
        return view('backOffice.listZoneCollecte', compact('zoneCollectes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.listZoneCollecte');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string',
        ]);

        ZoneCollecte::create([
            'nom' => $validated['nom'],
            'adresse' => $validated['adresse'],
        ]);

        return redirect()->route('backOffice.listZoneCollecte')->with('success', 'Collection Areas created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $zoneCollecte = ZoneCollecte::findOrFail($id);

        $chauffeursZoneCollecte = $zoneCollecte->chauffeurs;
        $centreCollecte = $zoneCollecte->centreCollecte;

        $chauffeurs = Chauffeur::whereNotIn('id', $chauffeursZoneCollecte->pluck('id'))->get();

        return view('backOffice.detailZoneCollecte', compact('zoneCollecte', 'chauffeursZoneCollecte', 'centreCollecte', 'chauffeurs'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zoneCollecte = ZoneCollecte::findOrFail($id);
        return view('backOffice.listZoneCollecte', compact('zoneCollecte'));
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
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string',
        ]);

        $zoneCollecte = ZoneCollecte::findOrFail($id);

        $zoneCollecte->update([
            'nom' => $validated['nom'],
            'adresse' => $validated['adresse'],
        ]);

        return redirect()->route('backOffice.listZoneCollecte')->with('success', 'Collection Areas updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zoneCollecte = ZoneCollecte::findOrFail($id);
        $zoneCollecte -> delete();

        return redirect()->route('backOffice.listZoneCollecte')->with('success', 'Collection Areas deleted successfully.');
    }


    public function assignChauffeursToZone(Request $request, $id)
    {
        // Récupérer la zone de collecte par ID
        $zoneCollecte = ZoneCollecte::findOrFail($id);

        // Valider la requête pour s'assurer que des chauffeurs sont sélectionnés
        $validated = $request->validate([
            'chauffeurs' => 'required|array', // Tableau d'ID des chauffeurs
            'chauffeurs.*' => 'exists:users,id', // Vérifie que chaque chauffeur existe
        ]);

        // Assigner les chauffeurs à la zone de collecte
        $zoneCollecte->chauffeurs()->attach($validated['chauffeurs']);

        return redirect()->back()->with('success', 'Drivers successfully assigned to collection area.');
    }

    public function unassignChauffeursFromZone(Request $request, $id)
    {
        // Récupérer la zone de collecte par ID
        $zoneCollecte = ZoneCollecte::findOrFail($id);

        // Valider la requête pour s'assurer que des chauffeurs sont sélectionnés
        $validated = $request->validate([
            'chauffeurs' => 'required|array', // Tableau d'ID des chauffeurs
            'chauffeurs.*' => 'exists:users,id', // Vérifie que chaque chauffeur existe
        ]);

        // Détacher les chauffeurs de la zone de collecte
        $zoneCollecte->chauffeurs()->detach($validated['chauffeurs']);

        return redirect()->back()->with('success', 'Drivers successfully decommissioned from the collection area.');
    }

    public function listForChauffeur()
    {
        $chauffeur = Chauffeur::findOrFail(Auth::user()->id);
        $zonesCollectes = $chauffeur->zonesCollecte;

        return view('frontOffice.chauffeur.listZoneCollecte', compact( 'zonesCollectes'));
    }

}
