@extends('index')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Détails du type de recyclage</h1>
    <div class="card" style="background-color: #f8f9fa; border: 1px solid #ced4da;">
        <div class="card-body">
            <h3 class="card-title text-dark"> <span class="text-success">{{ $typeRecyclage->nom }}</span></h3>
            <p class="card-text text-dark">Description: {{ $typeRecyclage->description }}</p>
            <p class="card-text text-dark">Centre de Recyclage: {{ $typeRecyclage->centreRecyclage->nom ?? 'N/A' }}</p>
            <a href="{{ route('backOffice.indextypesrecyclage') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
