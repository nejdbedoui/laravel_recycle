@extends('index')

@section('content')
    <h1>Modifier le Centre de Recyclage</h1>

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

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
@endsection
