<?php

namespace App\Http\Controllers;

use App\Models\AdminCentreCollecte;
use App\Models\AdminCentreRecyclage;
use App\Models\CentreCollecte;
use App\Models\TypeDechet;
use App\Models\ZoneCollecte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CentreCollecteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontOffice.adminCentreCollecteDashboard');
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
            'capacite' => 'required|integer|min:1',
            'zone_collecte_id' => 'required|exists:zone_collectes,id',
        ]);

        $adminCentreCollecte = AdminCentreCollecte::findOrFail(Auth::user()->id);

        CentreCollecte::create([
            'nom' => $validated['nom'],
            'adresse' => $validated['adresse'],
            'capacite' => $validated['capacite'],
            'admin_centre_collecte_id' => $adminCentreCollecte->id,
            'zone_collecte_id' => $validated['zone_collecte_id'],
        ]);

        return redirect()->route('frontOffice.adminCentreCollecte.detailCentreCollecte')->with('success', 'Collection Center created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $adminCentreCollecte = AdminCentreCollecte::findOrFail(Auth::user()->id);
        $centreCollecte = $adminCentreCollecte->centreCollecte;
        $dechets = $centreCollecte->dechets;

        $zoneCollecte = $centreCollecte ? $centreCollecte->zoneCollecte : null;

        // Récupérer les zones non associées
        $zoneCollectes = ZoneCollecte::whereDoesntHave('centreCollecte')->get();

        // Si $zoneCollecte existe, l'ajouter à la collection $zoneCollectes
        if ($zoneCollecte) {
            $zoneCollectes->push($zoneCollecte);
        }

        $typesDechets = TypeDechet::all();

        return view('frontOffice.adminCentreCollecte.detailCentreCollecte', compact('centreCollecte', 'dechets', 'typesDechets', 'zoneCollectes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $centreCollecte = CentreCollecte::findOrFail($id);
        return view('frontOffice.adminCentreCollecte.detailCentreCollecte', compact('centreCollecte'));
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
            'capacite' => 'required|integer|min:1',
        ]);

        $adminCentreCollecte = AdminCentreCollecte::findOrFail(Auth::user()->id);

        $centreCollecte = CentreCollecte::findOrFail($id);

        $centreCollecte->update([
            'nom' => $validated['nom'],
            'adresse' => $validated['adresse'],
            'capacite' => $validated['capacite'],
            'admin_centre_collecte_id' => $adminCentreCollecte->id,
        ]);

        return redirect()->route('frontOffice.adminCentreCollecte.detailCentreCollecte')->with('success', 'Collection Center updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $centreCollecte = CentreCollecte::findOrFail($id);
        $centreCollecte->delete();

        return redirect()->route('frontOffice.adminCentreCollecteDashboard')->with('success', 'Collection Center successfully deleted.');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexForAdminCentreRecyclage()
    {
        $adminCentreRecyclage = AdminCentreRecyclage::findOrFail(Auth::user()->id);
        $centreRecyclage = $adminCentreRecyclage->centreRecyclage;

        $centreCollectes = CentreCollecte::all();
        return view('frontOffice.adminCentreRecyclage.listCentreCollecte', compact('centreCollectes', 'centreRecyclage'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idt
     * @return \Illuminate\Http\Response
     */
    public function showForAdminCentreRecyclage($idt)
    {
        $adminCentreRecyclage = AdminCentreRecyclage::findOrFail(Auth::user()->id);
        $centreRecyclage = $adminCentreRecyclage->centreRecyclage;

        $centreCollecte = CentreCollecte::findOrFail($idt);

        $adminCentreCollecte = $centreCollecte->adminCentreCollecte;
        $dechets = $centreCollecte->dechets;
        $zoneCollecte = $centreCollecte->zoneCollecte;

        return view('frontOffice.adminCentreRecyclage.detailCentreCollecte', compact('centreCollecte', 'centreRecyclage', 'dechets', 'adminCentreCollecte', 'zoneCollecte'));
    }
}
