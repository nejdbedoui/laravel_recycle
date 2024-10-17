<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\AdminCentreRecyclage;
use App\Models\MatierePremiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatierePremiereController extends Controller
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
        return view('frontOffice.adminCentreRecyclage.detailCentreRecyclage');
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
            'quantite' => 'required|integer|min:1',
        ]);

        $adminCentreRecyclage = AdminCentreRecyclage::findOrFail(Auth::user()->id);
        $centreRecyclage = $adminCentreRecyclage->centreRecyclage;

        MatierePremiere::create([
            'nom' => $validated['nom'],
            'quantite' => $validated['quantite'],
            'centre_recyclage_id' => $centreRecyclage->id,
        ]);

        return redirect()->route('frontOffice.adminCentreRecyclage.detailCentreRecyclage')->with('success', 'Raw Material created successfully.');
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
        $matierePremiere = MatierePremiere::findOrFail($id);
        return view('frontOffice.adminCentreRecyclage.detailCentreRecyclage', compact('matierePremiere'));
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
            'quantite' => 'required|integer|min:1',
        ]);

        $adminCentreRecyclage = AdminCentreRecyclage::findOrFail(Auth::user()->id);
        $centreRecyclage = $adminCentreRecyclage->centreRecyclage;

        $matierePremiere = MatierePremiere::findOrFail($id);

        $matierePremiere->update([
            'nom' => $validated['nom'],
            'quantite' => $validated['quantite'],
            'centre_recyclage_id' => $centreRecyclage->id,
        ]);

        return redirect()->route('frontOffice.adminCentreRecyclage.detailCentreRecyclage')->with('success', 'Raw Material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $matierePremiere = MatierePremiere::findOrFail($id);
        $matierePremiere->delete();

        return redirect()->route('frontOffice.adminCentreRecyclage.detailCentreRecyclage')->with('success', 'Raw Material successfully deleted.');
=======
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
>>>>>>> main
    }
}
