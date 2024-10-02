@extends('index')

@section('content')
    <h1>Détails du Centre de Recyclage</h1>

    <div class="card">
        <div class="card-header">
            {{ $centreRecyclage->nom }}
        </div>
        <div class="card-body">
            <p><strong>Adresse: </strong> {{ $centreRecyclage->adresse }}</p>
            <p><strong>Capacité: </strong> {{ $centreRecyclage->capacite }}</p>
            <p><strong>Types de Recyclage: </strong></p>
            <ul>
                @foreach($centreRecyclage->typesRecyclage as $type)
                    <li>{{ $type->nom }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <a href="{{ route('backOffice.editcentrerecyclage', $centreRecyclage->id) }}" class="btn btn-warning">Modifier</a>
    <form action="{{ route('backOffice.destroycentrerecyclage', $centreRecyclage->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>

    <a href="{{ route('backOffice.indexcentrerecyclage') }}" class="btn btn-secondary">Retour à la liste</a>
@endsection
