<?php

namespace App\Http\Controllers;

use App\Models\AdminCentreCollecte;
use App\Models\AdminCentreRecyclage;
use App\Models\Chauffeur;
use App\Models\Dechet;
use App\Models\DemandeDechet;
use App\Models\Deplacement;
use App\Models\ZoneCollecte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DemandeDechetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demandeDechets = DemandeDechet::where('etat', 'Confirmed')->get();

        return view('backOffice.listDemandeDechet', compact('demandeDechets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontOffice.adminCentreRecyclage.detailCentreCollecte');
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
            'quantite' => 'required|integer|min:1',
            'dechet_id' => 'required|exists:dechets,id',
        ]);

        $adminCentreRecyclage = AdminCentreRecyclage::findOrFail(Auth::user()->id);
        $centreRecyclage= $adminCentreRecyclage->centreRecyclage;
        $dechet = Dechet::findOrFail($validated['dechet_id']);

        DB::transaction(function () use ($validated, $centreRecyclage, $dechet) {

            $quantiteDechet = $dechet->quantite;
            $quantiteDechetDemandee = $validated['quantite'];

            if ($quantiteDechetDemandee > $quantiteDechet) {
                return redirect()->back()->with('error', 'The requested quantity is greater than the available quantity.');
            }

            $dechet->decrement('quantite', $quantiteDechetDemandee);

            DemandeDechet::create([
                'quantite' => $quantiteDechetDemandee,
                'centre_recyclage_id' => $centreRecyclage->id,
                'dechet_id' => $validated['dechet_id'],
            ]);
        });

        return redirect()->route('frontOffice.adminCentreRecyclage.listDemandeDechet')->with('success', 'Waste request created successfully.');
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
        $demandeDechet = DemandeDechet::findOrFail($id);

        return view('frontOffice.adminCentreRecyclage.listDemandeDechet', compact('demandeDechet'));
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
        $demandeDechet = DemandeDechet::findOrFail($id);

        // Validation de la nouvelle quantité
        $validated = $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);

        $dechet = $demandeDechet->dechet;

        // Transaction pour assurer l'intégrité des données
        DB::transaction(function () use ($validated, $demandeDechet, $dechet) {

            $quantiteDechet = $dechet->quantite;
            $quantiteDemandePrecedente = $demandeDechet->quantite;
            $quantiteDechetDemandee = $validated['quantite'];

            // Calcul de la différence entre la nouvelle quantité et l'ancienne
            $difference = $quantiteDechetDemandee - $quantiteDemandePrecedente;

            // Vérification si la nouvelle quantité demandée ne dépasse pas le stock disponible
            if ($difference > 0 && $difference > $quantiteDechet) {
                return redirect()->back()->with('error', 'The requested quantity is greater than the available quantity.');
            }

            // Mise à jour de la quantité de dechet en fonction de la différence
            $dechet->quantite -= $difference;
            $dechet->save();

            // Mise à jour de la demande de matière première
            $demandeDechet->update([
                'quantite' => $quantiteDechetDemandee,
            ]);
        });

        return redirect()->route('frontOffice.adminCentreRecyclage.listDemandeDechet')->with('success', 'Waste request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $demandeDechet = DemandeDechet::findOrFail($id);

        $demandeDechet->dechet->increment('quantite', $demandeDechet->quantite);

        $demandeDechet->delete();

        return redirect()->route('frontOffice.adminCentreRecyclage.listDemandeDechet')->with('success', 'Waste request deleted successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexForAdminCentreCollecte()
    {
        $adminCentreCollecte = AdminCentreCollecte::findOrFail(Auth::user()->id);

        $centreCollecte = $adminCentreCollecte->centreCollecte;
        $zoneCollectes = ZoneCollecte::all();

        $demandeDechets = DemandeDechet::where('centre_recyclage_id', $adminCentreCollecte->centreCollecte->id)->get();

        return view('frontOffice.adminCentreCollecte.listDemandeDechet', compact('demandeDechets', 'centreCollecte', 'zoneCollectes'));
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

        $demandeDechets = DemandeDechet::where('centre_recyclage_id', $adminCentreRecyclage->centreRecyclage->id)->get();

        return view('frontOffice.adminCentreRecyclage.listDemandeDechet', compact('demandeDechets', 'centreRecyclage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDemandeDechet(Request $request, $id)
    {
        $demandeDechet = DemandeDechet::findOrFail($id);

        $demandeDechet->update([
            'etat' => 'Confirmed',
        ]);

        return redirect()->route('frontOffice.adminCentreCollecte.listDemandeDechet')->with('success', 'Waste request confirmed successfully.');
    }
}
