@extends('index')

@section('content')
<div class="container mt-4">
    
    <h1 class="mb-4">Liste des Types de Recyclage</h1>
    
    <a href="{{ route('backOffice.createtypesrecyclage') }}" class="btn btn-primary mb-3">Créer un nouveau type</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
                <h5 class="mb-0">Liste des Types de Recyclage</h5>
         
        </div>
        <div class="card-body">
            <div style="overflow-x: auto;">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Centre de Recyclage</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($typesRecyclage as $type)
                            <tr>
                                <td>{{ $type->nom }}</td>
                                <td>{{ $type->description }}</td>
                                <td>{{ $type->centreRecyclage->nom ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('backOffice.edittypesrecyclage', $type) }}" class="btn btn-warning btn-sm">Éditer</a>
                                    <a href="{{ route('backOffice.showtypesrecyclage', $type) }}" class="btn btn-info btn-sm">Voir</a>
                                    <form action="{{ route('backOffice.destroytpesrecyclage', $type) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
