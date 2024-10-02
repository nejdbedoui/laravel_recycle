@extends('index')

@section('content')
<div class="container">
    <h1>Liste des Centres de Recyclage</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('backOffice.createcentrerecyclage') }}" class="btn btn-primary mb-3">Ajouter un Centre</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Capacité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($centres as $centre)
                <tr>
                    <td>{{ $centre->nom }}</td>
                    <td>{{ $centre->adresse }}</td>
                    <td>{{ $centre->capacite }}</td>
                    <td>
                        <a href="{{ route('backOffice.showcentrerecyclage', $centre->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('backOffice.editcentrerecyclage', $centre->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('backOffice.destroycentrerecyclage', $centre->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
