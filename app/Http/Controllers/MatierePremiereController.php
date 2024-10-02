<?php

namespace App\Http\Controllers;

use App\Models\CentreRecyclage;
use App\Models\MatierePremiere;
use Illuminate\Http\Request;

class MatierePremiereController extends Controller
{
    // Display a listing of the resource.
    public function index(Request $request)
    {
        // Retrieve the search query from the request
        $search = $request->input('search');
    
        // Modify the query to filter based on the search input
        $matieresPremieres = MatierePremiere::when($search, function ($query) use ($search) {
            return $query->where('nom', 'like', '%' . $search . '%')
                         ->orWhere('quantite', 'like', '%' . $search . '%');
        })->paginate(5);
    
        $centres = CentreRecyclage::all();
        return view('matiere-premiere.index', compact('matieresPremieres', 'centres', 'search'));
    }
    

    // Show the form for creating a new resource.
    public function create()
    {
        $centres = CentreRecyclage::all();
        return view('matiere-premiere.create', compact('centres'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|integer|min:1',
            'centre_recyclage_id' => 'required|exists:centre_recyclages,id',
        ]);

        $matierePremiere = new MatierePremiere();
        $matierePremiere->nom = $request->input('nom');
        $matierePremiere->quantite = $request->input('quantite');
        $matierePremiere->centre_recyclage_id = $request->input('centre_recyclage_id'); // Ensure this is set
        $matierePremiere->save();

        return redirect()->route('matiere-premiere.index')->with('success', 'Matière Première créée avec succès.');
    }

    // Display the specified resource.
    public function show(MatierePremiere $matierePremiere)
    {
        return view('matiere-premiere.show', compact('matierePremiere'));
    }

    // Show the form for editing the specified resource.
    public function edit(MatierePremiere $matierePremiere)
    {
        $centres = CentreRecyclage::all();
        return view('matiere-premiere.edit', compact('matierePremiere', 'centres'));
    }
    // Update the specified resource in storage.
    public function update(Request $request, MatierePremiere $matierePremiere)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|integer',
            'centre_recyclage_id' => 'required|exists:centre_recyclages,id',
        ]);

        $matierePremiere->update($request->all());
        return redirect()->route('matiere-premiere.index')->with('success', 'Matière Première mise à jour avec succès.');
    }

    // Remove the specified resource from storage.
    public function destroy(MatierePremiere $matierePremiere)
    {
        $matierePremiere->delete();
        return redirect()->route('matiere-premiere.index')->with('success', 'Matière Première supprimée avec succès.');
    }
}
