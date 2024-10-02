<?php

namespace App\Http\Controllers;

use App\Models\CentreRecyclage;
use App\Models\TypeRecyclage;
use Illuminate\Http\Request;


class CentreRecyclageController extends Controller
{

   /**
     * Afficher la liste de tous les centres de recyclage.
     */
    public function index()
    {
        $centres = CentreRecyclage::with('typesRecyclage')->get(); // Récupère tous les centres avec leurs types de recyclage
        return view('backOffice.indexcentrerecyclage', compact('centres')); // Passe les centres à la vue
    }


     /**
     * Afficher le formulaire pour créer un nouveau centre de recyclage.
     */
    public function create()
    {
        $typesRecyclage = TypeRecyclage::all(); // Récupère tous les types de recyclage
        return view('backOffice.createcentrerecyclage', compact('typesRecyclage')); // Passe les types de recyclage à la vue
    }
     /**
     * Stocker un nouveau centre de recyclage dans la base de données.
     */
    
    public function store(Request $request)
{
    // Validate the incoming data
    $request->validate([
        'nom' => 'required|string|max:255',
        'adresse' => 'required|string|max:255',
        'capacite' => 'required|integer',
    ]);

    // Store the data in the database
    $centrerecyclage = new CentreRecyclage();
    $centrerecyclage->nom = $request->input('nom');
    $centrerecyclage->adresse = $request->input('adresse');
    $centrerecyclage->capacite = $request->input('capacite');
    $centrerecyclage->save();

    // Redirect to the index page with a success message
    return redirect()->route('backOffice.indexcentrerecyclage')->with('success', 'Centre de recyclage créé avec succès!');
}
    


    /**
     * Afficher un centre de recyclage spécifique.
     */
    public function show(CentreRecyclage $centreRecyclage)
    {
        return view('backOffice.showcentrerecyclage', compact('centreRecyclage')); // Passe le centre à la vue
    }

    /**
     * Afficher le formulaire d'édition d'un centre de recyclage.
     */
    public function edit(CentreRecyclage $centreRecyclage)
    {
        $typesRecyclage = TypeRecyclage::all(); // Récupère tous les types de recyclage
        return view('backOffice.editcentrerecyclage', compact('centreRecyclage', 'typesRecyclage')); // Passe le centre et les types à la vue
    }

    /**
     * Mettre à jour un centre de recyclage existant dans la base de données.
     */
    public function update(Request $request, CentreRecyclage $centreRecyclage)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'capacite' => 'required|integer',
        ]);

        $centreRecyclage->update($validated); // Met à jour le centre avec les données validées
        return redirect()->route('backOffice.indexcentrerecyclage')->with('success', 'Centre mis à jour avec succès'); // Redirige avec un message de succès
    }

    /**
     * Supprimer un centre de recyclage de la base de données.
     */
    public function destroy(CentreRecyclage $centreRecyclage)
    {
        $centreRecyclage->delete(); // Supprime le centre de recyclage
        return redirect()->route('backOffice.indexcentrerecyclage')->with('success', 'Centre supprimé avec succès'); // Redirige avec un message de succès
    }
}