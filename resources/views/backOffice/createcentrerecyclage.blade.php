<!-- resources/views/backOffice/createcentrerecyclage.blade.php -->

@extends('index')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Créer un nouveau Centre de Recyclage</h1>

    <!-- Display validation errors, if any -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form to create a new Centre de Recyclage -->
    <form action="{{ route('backOffice.storecentrerecyclage') }}" method="POST">
    @csrf <!-- CSRF token for security -->

        <div class="form-group">
            <label for="nom">Nom du Centre:</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
        </div>

        <div class="form-group">
            <label for="adresse">Adresse:</label>
            <input type="text" name="adresse" id="adresse" class="form-control" value="{{ old('adresse') }}" required>
        </div>

        <div class="form-group">
            <label for="capacite">Capacité:</label>
            <input type="number" name="capacite" id="capacite" class="form-control" value="{{ old('capacite') }}" required>
        </div>

    
       <!-- Buttons with margin -->
       <div class="mt-3"> <!-- Add a margin-top to the button container -->
            <button type="submit" class="btn btn-primary">Créer le Centre</button>
            <a href="{{ route('backOffice.indexcentrerecyclage') }}" class="btn btn-secondary ml-3">Annuler</a> <!-- Add margin-left for spacing -->
        </div>
    </form>
</div>
@endsection
