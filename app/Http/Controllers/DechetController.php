<?php

namespace App\Http\Controllers;

use App\Models\AdminCentreCollecte;
use App\Models\Dechet;
use App\Models\TypeDechet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DechetController extends Controller
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
        return view('frontOffice.adminCentreCollecte.detailCentreCollecte');
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
            'type_dechet_id' => 'required|exists:type_dechets,id',
        ]);

        $adminCentreCollecte = AdminCentreCollecte::findOrFail(Auth::user()->id);
        $centreCollecte = $adminCentreCollecte->centreCollecte;

        Dechet::create([
            'nom' => $validated['nom'],
            'quantite' => $validated['quantite'],
            'centre_collecte_id' => $centreCollecte->id,
            'type_dechet_id' => $validated['type_dechet_id'],
        ]);

        return redirect()->route('frontOffice.adminCentreCollecte.detailCentreCollecte')->with('success', 'Waste created successfully.');
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
        $dechet = Dechet::findOrFail($id);
        return view('frontOffice.adminCentreCollecte.detailCentreCollecte', compact('dechet'));
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
            'type_dechet_id' => 'required|exists:type_dechets,id',
        ]);

        $adminCentreCollecte = AdminCentreCollecte::findOrFail(Auth::user()->id);
        $centreCollecte = $adminCentreCollecte->centreCollecte;

        $dechet = Dechet::findOrFail($id);

        $dechet->update([
            'nom' => $validated['nom'],
            'quantite' => $validated['quantite'],
            'centre_collecte_id' => $centreCollecte->id,
            'type_dechet_id' => $validated['type_dechet_id'],
        ]);

        return redirect()->route('frontOffice.adminCentreCollecte.detailCentreCollecte')->with('success', 'Waste updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dechet = Dechet::findOrFail($id);
        $dechet->delete();

        return redirect()->route('frontOffice.adminCentreCollecte.detailCentreCollecte')->with('success', 'Waste successfully deleted.');
    }
}
