@extends('index')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Éditer le type de recyclage</h1>
    <form action="{{ route('backOffice.updatetypesrecyclage', $typeRecyclage) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $typeRecyclage->nom) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $typeRecyclage->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="centre_recyclage_id" class="form-label">Centre de Recyclage</label>
            <select class="form-select" id="centre_recyclage_id" name="centre_recyclage_id" required>
                <option value="">Sélectionnez un centre</option>
                @foreach ($centresRecyclage as $centre)
                    <option value="{{ $centre->id }}" {{ $centre->id == $typeRecyclage->centre_recyclage_id ? 'selected' : '' }}>
                        {{ $centre->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('backOffice.indextypesrecyclage') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
