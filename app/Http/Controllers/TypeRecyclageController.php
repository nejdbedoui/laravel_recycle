<?php

namespace App\Http\Controllers;

use App\Models\AdminCentreRecyclage;
use App\Models\CentreRecyclage;
use App\Models\TypeRecyclage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeRecyclageController extends Controller
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
