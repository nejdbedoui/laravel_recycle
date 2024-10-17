<?php

namespace App\Http\Controllers;

use App\Models\AdminCentreCollecte;
use App\Models\TypeDechet;
use App\Models\ZoneCollecte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeDechetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typesDechets = TypeDechet::all();
        return view('backOffice.listTypeDechet', compact('typesDechets'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdminCentreCollecte()
    {
        $adminCentreCollecte = AdminCentreCollecte::findOrFail(Auth::user()->id);
        $centreCollecte = $adminCentreCollecte->centreCollecte;

        $typesDechets = TypeDechet::all();
        $zoneCollectes = ZoneCollecte::whereDoesntHave('centreCollecte')->get();

        return view('frontOffice.adminCentreCollecte.listTypeDechet', compact('typesDechets', 'centreCollecte', 'zoneCollectes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.listTypeDechet');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'recyclable' => 'required|string',
            'dangereux' => 'required|string',
        ]);

        TypeDechet::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'recyclable' => $request->recyclable,
            'dangereux' => $request->dangereux,
        ]);

        return redirect()->route('backOffice.listTypeDechet')->with('success', 'Waste type added successfully.');
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
        $typeDechet = TypeDechet::findOrFail($id);
        return view('backOffice.listTypeDechet', compact('typeDechet'));
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
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'recyclable' => 'required|string',
            'dangereux' => 'required|string',
        ]);

        $typeDechet = TypeDechet::findOrFail($id);
        $typeDechet->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'recyclable' => $request->recyclable,
            'dangereux' => $request->dangereux,
        ]);

        return redirect()->route('backOffice.listTypeDechet')->with('success', 'Waste type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $typeDechet = TypeDechet::findOrFail($id);
        $typeDechet->delete();

        return redirect()->route('backOffice.listTypeDechet')->with('success', 'Waste type successfully deleted.');
    }
}
