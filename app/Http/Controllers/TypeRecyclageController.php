<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\AdminCentreRecyclage;
use App\Models\CentreRecyclage;
use App\Models\TypeRecyclage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
=======
use App\Models\CentreRecyclage;
use App\Models\TypeRecyclage;
use Illuminate\Http\Request;
>>>>>>> main

class TypeRecyclageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
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
=======
    /**
     * Afficher la liste de tous les types de recyclage.
     */
    public function index()
    {
        $typesRecyclage = TypeRecyclage::with('centreRecyclage')->get();
                return view('backOffice.indextypesrecyclage', compact('typesRecyclage')); // Passe les types à la vue
    }

    /**
     * Afficher le formulaire pour créer un nouveau type de recyclage.
     */
    public function create()
    {
        $centresRecyclage = CentreRecyclage::all(); // Récupérer tous les centres de recyclage
        return view('backOffice.createtypesrecyclage', compact('centresRecyclage')); // Passer les centres à la vue
    }
    

    /**
     * Stocker un nouveau type de recyclage dans la base de données.
>>>>>>> main
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
<<<<<<< HEAD
            'description' => 'nullable|string',
        ]);

        $adminCentreRecyclage = AdminCentreRecyclage::findOrFail(Auth::user()->id);
        $centreRecyclage = $adminCentreRecyclage->centreRecyclage;

        TypeRecyclage::create([
            'nom' => $validated['nom'],
            'description' => $validated['description'],
            'centre_recyclage_id' => $centreRecyclage->id,
        ]);

        return redirect()->route('frontOffice.adminCentreRecyclage.detailCentreRecyclage')->with('success', 'Recycling Type created successfully.');
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
        $typeRecyclage = TypeRecyclage::findOrFail($id);
        return view('frontOffice.adminCentreRecyclage.detailCentreRecyclage', compact('typeRecyclage'));
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
            'description' => 'nullable|string',
        ]);

        $adminCentreRecyclage = AdminCentreRecyclage::findOrFail(Auth::user()->id);
        $centreRecyclage = $adminCentreRecyclage->centreRecyclage;

        $typeRecyclage = TypeRecyclage::findOrFail($id);

        $typeRecyclage->update([
            'nom' => $validated['nom'],
            'description' => $validated['description'],
            'centre_recyclage_id' => $centreRecyclage->id,
        ]);

        return redirect()->route('frontOffice.adminCentreRecyclage.detailCentreRecyclage')->with('success', 'Recycling Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $typeRecyclage = TypeRecyclage::findOrFail($id);
        $typeRecyclage->delete();

        return redirect()->route('frontOffice.adminCentreRecyclage.detailCentreRecyclage')->with('success', 'Recycling Type successfully deleted.');
    }
}
=======
            'description' => 'required|string|max:500',
            'centre_recyclage_id' => 'required|exists:centre_recyclages,id',
        ]);
    
        // Vérifiez les données validées
       // dd($validated); // Vous devriez voir 'centre_recyclage_id' ici
    
        // Créez le nouveau type de recyclage
        TypeRecyclage::create($validated);
    
        return redirect()->route('backOffice.indextypesrecyclage')->with('success', 'Type de recyclage créé avec succès');
    }
    
    

    /**
     * Afficher un type de recyclage spécifique.
     */
    public function show(TypeRecyclage $typeRecyclage)
    {
        return view('backOffice.showtypesrecyclage', compact('typeRecyclage'));
    }


    /**
     * Afficher le formulaire d'édition d'un type de recyclage.
     */
    public function edit(TypeRecyclage $typeRecyclage)
    {
        $centresRecyclage = CentreRecyclage::all();
        return view('backOffice.edittypesrecyclage', compact('typeRecyclage', 'centresRecyclage'));
    }

    /**
     * Mettre à jour un type de recyclage existant dans la base de données.
     */
    public function update(Request $request, TypeRecyclage $typeRecyclage)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'centre_recyclage_id' => 'required|exists:centre_recyclages,id',
        ]);

        $typeRecyclage->update($validated);
        return redirect()->route('backOffice.indextypesrecyclage')->with('success', 'Type de recyclage mis à jour avec succès');
    }

    /**
     * Supprimer un type de recyclage de la base de données.
     */
    public function destroy(TypeRecyclage $typeRecyclage)
    {
        $typeRecyclage->delete();
        return redirect()->route('backOffice.indextypesrecyclage')->with('success', 'Type de recyclage supprimé avec succès');
    }
}
>>>>>>> main
