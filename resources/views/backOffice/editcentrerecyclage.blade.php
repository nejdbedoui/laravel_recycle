@extends('index')

@section('content')
<div class="container mt-4"> <!-- Add margin-top to the container for spacing -->
    <h1 class="mb-4">Modifier le Centre de Recyclage</h1> <!-- Add margin-bottom to the heading -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('backOffice.updatecentrerecyclage', $centreRecyclage->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ $centreRecyclage->nom }}" required>
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ $centreRecyclage->adresse }}" required>
        </div>

        <div class="form-group">
            <label for="capacite">Capacité</label>
            <input type="number" class="form-control" id="capacite" name="capacite" value="{{ $centreRecyclage->capacite }}" required>
        </div>

        <div class="mt-4"> <!-- Add margin-top for button spacing -->
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('backOffice.indexcentrerecyclage') }}" class="btn btn-secondary ml-2">Annuler</a> <!-- Button to cancel with margin -->
        </div>
    </form>
</div>
@endsection
