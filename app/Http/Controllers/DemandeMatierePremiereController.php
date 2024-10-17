<?php

namespace App\Http\Controllers;

use App\Models\AdminCentreRecyclage;
use App\Models\DemandeMatierePremiere;
use App\Models\MatierePremiere;
use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DemandeMatierePremiereController extends Controller
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
        return view('frontOffice.societe.detailCentreRecyclage');
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
            'matiere_premiere_id' => 'required|exists:matiere_premieres,id',
        ]);

        $societe = Societe::findOrFail(Auth::user()->id);
        $matierePremiere = MatierePremiere::findOrFail($validated['matiere_premiere_id']);

        // Transaction pour assurer l'intégrité des données
        DB::transaction(function () use ($validated, $societe, $matierePremiere) {

            $quantiteMatierePremiere = $matierePremiere->quantite;
            $quantiteMatierePremiereDemandee = $validated['quantite'];

            if ($quantiteMatierePremiereDemandee > $quantiteMatierePremiere) {
                return redirect()->back()->with('error', 'The requested quantity is greater than the available quantity.');
            }

            // Mise à jour de la quantité de la matière première
            $matierePremiere->decrement('quantite', $quantiteMatierePremiereDemandee);

            // Création de la demande de matière première
            DemandeMatierePremiere::create([
                'quantite' => $quantiteMatierePremiereDemandee,
                'societe_id' => $societe->id,
                'matiere_premiere_id' => $validated['matiere_premiere_id'],
            ]);
        });

        return redirect()->route('frontOffice.societe.listDemandeMatierePremiere')->with('success', 'Raw material request created successfully.');
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
        $demandeMatierePremiere = DemandeMatierePremiere::findOrFail($id);

        return view('frontOffice.societe.listDemandeMatierePremiere', compact('demandeMatierePremiere'));
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
        $demandeMatierePremiere = DemandeMatierePremiere::findOrFail($id);

        // Validation de la nouvelle quantité
        $validated = $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);

        $matierePremiere = $demandeMatierePremiere->matierePremiere;

        // Transaction pour assurer l'intégrité des données
        DB::transaction(function () use ($validated, $demandeMatierePremiere, $matierePremiere) {

            $quantiteMatierePremiere = $matierePremiere->quantite;
            $quantiteDemandePrecedente = $demandeMatierePremiere->quantite;
            $quantiteMatierePremiereDemandee = $validated['quantite'];

            // Calcul de la différence entre la nouvelle quantité et l'ancienne
            $difference = $quantiteMatierePremiereDemandee - $quantiteDemandePrecedente;

            // Vérification si la nouvelle quantité demandée ne dépasse pas le stock disponible
            if ($difference > 0 && $difference > $quantiteMatierePremiere) {
                return redirect()->back()->with('error', 'The requested quantity is greater than the available quantity.');
            }

            // Mise à jour de la quantité de la matière première en fonction de la différence
            $matierePremiere->quantite -= $difference;
            $matierePremiere->save();

            // Mise à jour de la demande de matière première
            $demandeMatierePremiere->update([
                'quantite' => $quantiteMatierePremiereDemandee,
            ]);
        });

        return redirect()->route('frontOffice.societe.listDemandeMatierePremiere')->with('success', 'Raw material request updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $demandeMatierePremiere = DemandeMatierePremiere::findOrFail($id);

        $demandeMatierePremiere->matierePremiere->increment('quantite', $demandeMatierePremiere->quantite);

        $demandeMatierePremiere->delete();

        return redirect()->route('frontOffice.societe.listDemandeMatierePremiere')->with('success', 'Raw material request deleted successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexForCompany()
    {
        $societe = Societe::findOrFail(Auth::user()->id);

        $demandesMatierePremieres = $societe->demandesMatierePremiere;

        return view('frontOffice.societe.listDemandeMatierePremiere', compact('demandesMatierePremieres'));
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
        $idCentreRecyclage = $centreRecyclage->id;

        $demandesMatierePremieres = DemandeMatierePremiere::whereHas('matierePremiere', function ($query) use ($idCentreRecyclage) {
            $query->where('centre_recyclage_id', $idCentreRecyclage);
        })->get();

        return view('frontOffice.adminCentreRecyclage.listDemandeMatierePremiere', compact('demandesMatierePremieres', 'centreRecyclage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDemandeMatierePremiere(Request $request, $id)
    {
        $demandeMatierePremiere = DemandeMatierePremiere::findOrFail($id);

        $demandeMatierePremiere->update([
            'etat' => 'Confirmed',
        ]);

        return redirect()->route('frontOffice.adminCentreRecyclage.listDemandeMatierePremiere')->with('success', 'Raw material request confirmed successfully.');
    }

}
