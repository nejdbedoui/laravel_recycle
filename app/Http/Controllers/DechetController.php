<?php

namespace App\Http\Controllers;

use App\Models\CentreCollecte;
use App\Models\Dechet;
use App\Models\TypeDechet;
use Illuminate\Http\Request;

class DechetController extends Controller
{
    /**
     * Afficher la liste de tous les déchets.
     */
    public function index()
    {
        $dechets = Dechet::all(); // Récupère tous les enregistrements de déchets
        $typesDechets = TypeDechet::all(); // Récupère tous les types de déchets
        $centreCollecte = CentreCollecte::all(); // Récupère tous les centres de collecte
        return view('backOffice.listDechets', compact('dechets', 'typesDechets', 'centreCollecte')); // Passe toutes les variables à la vue
    }

    /**
     * Afficher le formulaire pour créer un nouveau déchet.
     */
    public function create()
    {
        $typesDechets = TypeDechet::all(); // Récupère tous les types de déchets
        $centreCollecte = CentreCollecte::all(); // Récupère tous les centres de collecte
        return view('backOffice.createDechet', compact('typesDechets', 'centreCollecte')); // Passe les types et centres à la vue
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
            'centre_collecte_id' => 'required|exists:centre_collectes,id', // Validation pour le centre de collecte
            'etat' => 'required|boolean',
        ]);

        Dechet::create([
            'nom' => $request->nom,
            'quantite' => $request->quantite,
            'type_dechet_id' => $request->type_dechet_id,
            'centre_collecte_id' => $request->centre_collecte_id, // Enregistrement du centre de collecte
            'etat' => $request->etat,
        ]);

        return redirect()->route('backOffice.listDechet')->with('success', 'Déchet ajouté avec succès.');
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
        $dechet = Dechet::findOrFail($id); // Récupère le déchet à modifier
        $typesDechets = TypeDechet::all(); // Récupère tous les types de déchets
        $centreCollecte = CentreCollecte::all(); // Récupère tous les centres de collecte
        return view('backOffice.editDechet', compact('dechet', 'typesDechets', 'centreCollecte')); // Passe les données à la vue
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
            'centre_collecte_id' => 'required|exists:centre_collectes,id', // Validation pour le centre de collecte
            'etat' => 'required|boolean',
        ]);

        $dechet = Dechet::findOrFail($id);
        $dechet->update([
            'nom' => $request->nom,
            'quantite' => $request->quantite,
            'type_dechet_id' => $request->type_dechet_id,
            'centre_collecte_id' => $request->centre_collecte_id, // Mise à jour du centre de collecte
            'etat' => $request->etat,
        ]);

        return redirect()->route('backOffice.listDechet')->with('success', 'Déchet mis à jour avec succès.');
    }

    /**
     * Supprimer un déchet de la base de données.
     */
    public function destroy($id)
    {
        $dechet = Dechet::findOrFail($id);
        $dechet->delete();

        return redirect()->route('backOffice.listDechet')->with('success', 'Déchet supprimé avec succès.');
    }
}
