<?php

namespace App\Http\Controllers;

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

