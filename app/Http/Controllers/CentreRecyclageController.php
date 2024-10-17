<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\AdminCentreRecyclage;
use App\Models\CentreRecyclage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CentreRecyclageController extends Controller
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
        return view('frontOffice.adminCentreRecyclageDashboard');
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
        ]);

        $adminCentreRecyclage = AdminCentreRecyclage::findOrFail(Auth::user()->id);

        CentreRecyclage::create([
            'nom' => $validated['nom'],
            'adresse' => $validated['adresse'],
            'capacite' => $validated['capacite'],
            'admin_centre_recyclage_id' => $adminCentreRecyclage->id,
        ]);

        return redirect()->route('frontOffice.adminCentreRecyclage.detailCentreRecyclage')->with('success', 'Recycling Center created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $adminCentreRecyclage = AdminCentreRecyclage::findOrFail(Auth::user()->id);
        $centreRecyclage = $adminCentreRecyclage->centreRecyclage;

        $matierePremieres = $centreRecyclage->matieresPremieres;
        $typeRecyclages = $centreRecyclage->typesRecyclage;

        return view('frontOffice.adminCentreRecyclage.detailCentreRecyclage', compact('centreRecyclage', 'matierePremieres', 'typeRecyclages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $centreRecyclage = CentreRecyclage::findOrFail($id);
        return view('frontOffice.adminCentreRecyclage.detailCentreRecyclage', compact('centreRecyclage'));
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

        $adminCentreRecyclage = AdminCentreRecyclage::findOrFail(Auth::user()->id);

        $centreRecyclage = CentreRecyclage::findOrFail($id);

        $centreRecyclage->update([
            'nom' => $validated['nom'],
            'adresse' => $validated['adresse'],
            'capacite' => $validated['capacite'],
            'admin_centre_recyclage_id' => $adminCentreRecyclage->id,
        ]);

        return redirect()->route('frontOffice.adminCentreRecyclage.detailCentreRecyclage')->with('success', 'Recycling Center updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $centreRecyclage = CentreRecyclage::findOrFail($id);
        $centreRecyclage->delete();

        return redirect()->route('frontOffice.adminCentreRecyclageDashboard')->with('success', 'Recycling Center successfully deleted.');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexForCompany()
    {
        $centreRecyclages = CentreRecyclage::all();
        return view('frontOffice.societe.listCentreRecyclage', compact('centreRecyclages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showForCompany($id)
    {
        $centreRecyclage = CentreRecyclage::findOrFail($id);

        $adminCentreRecyclage = $centreRecyclage->admin;
        $matierePremieres = $centreRecyclage->matieresPremieres;
        $typeRecyclages = $centreRecyclage->typesRecyclage;

        return view('frontOffice.societe.detailCentreRecyclage', compact('centreRecyclage', 'adminCentreRecyclage', 'matierePremieres', 'typeRecyclages'));
    }


}
=======
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
>>>>>>> main
