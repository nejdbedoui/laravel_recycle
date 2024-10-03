<?php
namespace App\Http\Controllers;

use App\Models\TypeDechet;
use Illuminate\Http\Request;

class TypeDechetController extends Controller
{
/**
* Afficher la liste de tous les types de déchets.
*/
public function index()
{
$typesDechets = TypeDechet::all(); // Récupère tous les types de déchets
return view('backOffice.listTypeDechet', compact('typesDechets')); // Passe les types à la vue
}

/**
* Afficher le formulaire pour créer un nouveau type de déchet.
*/
public function create()
{
return view('backOffice.createTypeDechet'); // Affiche le formulaire de création
}

/**
* Stocker un nouveau type de déchet dans la base de données.
*/
public function store(Request $request)
{
$request->validate([
'nom' => 'required|string|max:255',
'description' => 'nullable|string|max:500',
'recyclable' => 'required|boolean',
'dangereux' => 'required|boolean',
]);

TypeDechet::create([
'nom' => $request->nom,
'description' => $request->description,
'recyclable' => $request->recyclable,
'dangereux' => $request->dangereux,
]);

return redirect()->route('backOffice.listTypeDechet')->with('success', 'Type de déchet ajouté avec succès.');
}

/**
* Afficher un type de déchet spécifique.
*/
public function show($id)
{
$typeDechet = TypeDechet::findOrFail($id);
return view('backOffice.detailTypeDechet', compact('typeDechet')); // Affiche les détails
}

/**
* Afficher le formulaire d'édition d'un type de déchet.
*/
public function edit($id)
{
$typeDechet = TypeDechet::findOrFail($id); // Récupère le type à modifier
return view('backOffice.editTypeDechet', compact('typeDechet')); // Passe le type à la vue
}

/**
* Mettre à jour un type de déchet existant dans la base de données.
*/
public function update(Request $request, $id)
{
$request->validate([
'nom' => 'required|string|max:255',
'description' => 'nullable|string|max:500',
'recyclable' => 'required|boolean',
'dangereux' => 'required|boolean',
]);

$typeDechet = TypeDechet::findOrFail($id);
$typeDechet->update([
'nom' => $request->nom,
'description' => $request->description,
'recyclable' => $request->recyclable,
'dangereux' => $request->dangereux,
]);

return redirect()->route('backOffice.listTypeDechet')->with('success', 'Type de déchet mis à jour avec succès.');
}

/**
* Supprimer un type de déchet de la base de données.
*/
public function destroy($id)
{
$typeDechet = TypeDechet::findOrFail($id);
$typeDechet->delete();

return redirect()->route('backOffice.listTypeDechet')->with('success', 'Type de déchet supprimé avec succès.');
}
}
