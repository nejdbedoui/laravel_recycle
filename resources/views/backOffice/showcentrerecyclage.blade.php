@extends('index')

@section('content')
<div class="container mt-4"> <!-- Add margin-top to the container for spacing -->
    <h1 class="mb-4">Détails du Centre de Recyclage</h1> <!-- Add margin-bottom to the heading -->

    <div class="card shadow-sm"> <!-- Add shadow for depth -->
        <div class="card-header bg-success text-white"> <!-- Set background color and text color -->
            <h5 class="mb-0">{{ $centreRecyclage->nom }}</h5> <!-- Add margin-bottom to the header -->
        </div>
        <div class="card-body">
            <p><strong>Adresse: </strong> {{ $centreRecyclage->adresse }}</p>
            <p><strong>Capacité: </strong> {{ $centreRecyclage->capacite }} kg</p> <!-- Specify the unit -->
            <ul>
                @foreach($centreRecyclage->typesRecyclage as $type)
                    <li>{{ $type->nom }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="mt-4"> <!-- Add margin-top for the buttons -->
        <a href="{{ route('backOffice.editcentrerecyclage', $centreRecyclage->id) }}" class="btn btn-warning">Modifier</a>
        <form action="{{ route('backOffice.destroycentrerecyclage', $centreRecyclage->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger ml-2">Supprimer</button> <!-- Add margin-left for spacing -->
        </form>
        <a href="{{ route('backOffice.indexcentrerecyclage') }}" class="btn btn-secondary ml-2">Retour à la liste</a> <!-- Add margin-left for spacing -->
    </div>
</div>
@endsection
