<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\EvenementCommunautaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
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
        return view('home.detailEvenementCommunautaire');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int evenementId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $evenementId)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'email' => 'required|string|email|max:255',
        ]);

        $evenement = EvenementCommunautaire::findOrFail($evenementId);

        $evenement->commentaires()->create([
            'description' => $validated['description'],
            'email' => $validated['email'],
        ]);

        // Rediriger vers la page de détails de l'événement avec un message de succès
        return redirect()->route('home.detailEvenementCommunautaire', ['id' => $evenementId])->with('success', 'Comment created successfully.');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $evenement_id = $commentaire->evenement_communautaire_id;
        $commentaire -> delete();

        return redirect()->route('backOffice.detailEvenementCommunautaire', ['id' => $evenement_id])->with('success', 'Comment deleted successfully.');

    }
}
