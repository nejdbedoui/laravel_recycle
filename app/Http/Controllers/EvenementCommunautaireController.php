<?php

namespace App\Http\Controllers;

use App\Models\EvenementCommunautaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EvenementCommunautaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evenements = EvenementCommunautaire::all();
        return view('home.home', compact('evenements'));
    }

    public function indexAdmin()
    {
        $evenements = EvenementCommunautaire::all();
        return view('backOffice.listEvenementCommunautaire', compact('evenements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.listEvenementCommunautaire');
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
            'description' => 'required|string',
            'date' => 'required|date|after_or_equal:today',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('evenement_images', 'public');
        }

        EvenementCommunautaire::create([
            'nom' => $validated['nom'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'image' => $imagePath,
        ]);

        return redirect()->route('backOffice.listEvenementCommunautaire')->with('success', 'Event created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evenement = EvenementCommunautaire::findOrFail($id);
        $commentaires = $evenement->commentaires;

        return view('home.detailEvenementCommunautaire', compact('evenement', 'commentaires'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAdmin($id)
    {
        $evenement = EvenementCommunautaire::findOrFail($id);
        $commentaires = $evenement->commentaires;

        return view('backOffice.detailEvenementCommunautaire', compact('evenement', 'commentaires'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evenement = EvenementCommunautaire::findOrFail($id);
        return view('backOffice.listEvenementCommunautaire', compact('evenement'));
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
            'description' => 'required|string',
            'date' => 'required|date|after_or_equal:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $evenement = EvenementCommunautaire::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($evenement->image) {
                Storage::disk('public')->delete($evenement->image);
            }
            $imagePath = $request->file('image')->store('evenement_images', 'public');
        } else {
            $imagePath = $evenement->image;
        }

        $evenement->update([
            'nom' => $validated['nom'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'image' => $imagePath,
        ]);

        return redirect()->route('backOffice.listEvenementCommunautaire')->with('success', 'Event updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evenement = EvenementCommunautaire::findOrFail($id);
        $evenement -> delete();

        return redirect()->route('backOffice.listEvenementCommunautaire')->with('success', 'Event deleted successfully.');
    }
}
