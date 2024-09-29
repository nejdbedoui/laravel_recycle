<?php

namespace App\Http\Controllers;

use App\Models\Dechet;
use Illuminate\Http\Request;

class DechetController extends Controller
{
    /**
     * Afficher la liste de tous les déchets.
     */
    public function index()
    {
        $dechets = Dechet::all(); // Récupère tous les enregistrements de déchets
        return view('backOffice.listDechets', compact('dechets')); // Retourne la vue avec la liste des déchets
    }

    /**
     * Afficher le formulaire pour créer un nouveau déchet.
     */
    public function create()
    {
        return view('backOffice.createDechet'); // Retourne la vue de création d'un déchet
    }

    /**
     * Stocker un nouveau déchet dans la base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|integer',
            'type_dechet_id' => 'required|exists:type_dechets,id',
            'etat' => 'required|boolean',
        ]);

        Dechet::create([
            'nom' => $request->nom,
            'quantite' => $request->quantite,
            'type_dechet_id' => $request->type_dechet_id,
            'etat' => $request->etat,
        ]);

        return redirect()->route('backOffice.listDechets')->with('success', 'Déchet ajouté avec succès.');
    }

    /**
     * Afficher un déchet spécifique.
     */
    public function show($id)
    {
        $dechet = Dechet::findOrFail($id);
        return view('backOffice.detailDechet', compact('dechet'));
    }

    /**
     * Afficher le formulaire d'édition d'un déchet.
     */
    public function edit($id)
    {
        $dechet = Dechet::findOrFail($id);
        return view('backOffice.editDechet', compact('dechet'));
    }

    /**
     * Mettre à jour un déchet existant dans la base de données.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|integer',
            'type_dechet_id' => 'required|exists:type_dechets,id',
            'etat' => 'required|boolean',
        ]);

        $dechet = Dechet::findOrFail($id);
        $dechet->update([
            'nom' => $request->nom,
            'quantite' => $request->quantite,
            'type_dechet_id' => $request->type_dechet_id,
            'etat' => $request->etat,
        ]);

        return redirect()->route('backOffice.listDechets')->with('success', 'Déchet mis à jour avec succès.');
    }

    /**
     * Supprimer un déchet de la base de données.
     */
    public function destroy($id)
    {
        $dechet = Dechet::findOrFail($id);
        $dechet->delete();

        return redirect()->route('backOffice.listDechets')->with('success', 'Déchet supprimé avec succès.');
    }
}
