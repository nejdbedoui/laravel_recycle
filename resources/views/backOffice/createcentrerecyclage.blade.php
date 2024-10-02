<!-- resources/views/backOffice/createcentrerecyclage.blade.php -->

@extends('index')

@section('content')
<div class="container">
    <h1>Créer un nouveau Centre de Recyclage</h1>

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

        <!-- Dropdown to select Type de Recyclage -->
        <div class="form-group">
            <label for="type_recyclage">Types de Recyclage:</label>
            <select name="type_recyclage[]" id="type_recyclage" class="form-control" multiple>
                @foreach($typesRecyclage as $type)
                    <option value="{{ $type->id }}">{{ $type->nom }}</option>
                @endforeach
            </select>
            <small class="form-text text-muted">Maintenez Ctrl (Cmd sur Mac) pour sélectionner plusieurs types</small>
        </div>

        <button type="submit" class="btn btn-primary">Créer le Centre</button>
    </form>
</div>
@endsection
