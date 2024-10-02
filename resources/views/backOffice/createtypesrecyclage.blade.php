@extends('index')

@section('content')
<div class="container">
    <h1>Créer un type de recyclage</h1>
    <form action="{{ route('backOffice.storetypesrecyclage') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
</div>

<div class="mb-3">
    <label for="centre_recyclage_id" class="form-label">Centre de recyclage</label>
    <select class="form-control" id="centre_recyclage_id" name="centre_recyclage_id" required>
        <option value="">Sélectionnez un centre</option>
        @foreach ($centresRecyclage as $centre)
            <option value="{{ $centre->id }}">{{ $centre->nom }}</option>
        @endforeach
    </select>
</div>

        <button type="submit" class="btn btn-success">Créer</button>
        <a href="{{ route('backOffice.indextypesrecyclage') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
