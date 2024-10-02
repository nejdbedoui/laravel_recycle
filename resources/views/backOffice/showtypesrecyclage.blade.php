@extends('index')

@section('content')
<div class="container">
    <h1>Détails du type de recyclage</h1>
    <h3>Nom: {{ $typeRecyclage->nom }}</h3>
    <p>Description: {{ $typeRecyclage->description }}</p>
    <p>Centre de Recyclage: {{ $typeRecyclage->centreRecyclage->nom ?? 'N/A' }}</p>
    <a href="{{ route('backOffice.indextypesrecyclage') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
