@extends('backOffice.adminDashboard')

@section('title', 'EcoCycle - Waste List')

@section('dashboard-content')

    <div class="page-content-wrapper p-xxl-4">

        <!-- Title -->
        <div class="row">
            <div class="col-12 mb-4 mb-sm-5">
                <div class="d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-3 mb-sm-0">liste de dechets</h1>
                    <div class="d-grid">
                        <a data-bs-toggle="modal" data-bs-target="#addWasteModal" class="btn btn-primary-soft mb-0">
                            <i class="bi bi-plus-circle me-2"></i>Ajouter Dechet
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Waste list START -->
        <div class="row g-4">
            @foreach ($dechets as $dechet)
                <div class="col-md-6 col-lg-4">
                    <div class="card bg-transparent">
                        <!-- Image -->
                        <div class="position-relative">
                            <div class="card-img-overlay d-flex flex-column p-3">
                                <!-- Card overlay top -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <div></div>
                                    <!-- Buttons -->
                                    <div class="list-inline-item dropdown">
                                        <!-- Dropdown button -->
                                        <a href="#" class="btn btn-sm btn-round btn-light" role="button"
                                           id="dropdownAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <!-- Dropdown items -->
                                        <ul class="dropdown-menu dropdown-menu-end min-w-auto shadow rounded small"
                                            aria-labelledby="dropdownAction1">
                                            <li>
                                                <a data-bs-toggle="modal" data-bs-target="#editWasteModal-{{ $dechet->id }}" class="dropdown-item">
                                                    <i class="bi bi-pencil-square fa-fw me-2"></i>Edit
                                                </a>

                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('backOffice.deleteDechet', $dechet->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="bi bi-trash fa-fw me-2"></i>Remove
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card body -->
                        <div class="card-body p-3 pb-0">
                            <h6 class="fw-light mb-0">Nom: {{ $dechet->nom }}</h6>
                            <h6 class="fw-light mb-0">Quantité: {{ $dechet->quantite }}</h6>
                            <h6 class="fw-light mb-0">Status: {{ $dechet->etat ? 'Disponible' : 'Indisponible' }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Waste list END -->

        <!-- Modal for adding new waste -->
        <div class="modal fade" id="addWasteModal" tabindex="-1" aria-labelledby="addWasteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addWasteModalLabel">Ajouter Dechet</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-start" method="POST" action="{{ route('backOffice.storeDechet') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nom</label>
                                <x-text-input class="form-control" type="text" name="nom" required/>
                                <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quantité</label>
                                <x-text-input class="form-control" type="number" name="quantite" required/>
                                <x-input-error :messages="$errors->get('quantite')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Type de Déchet</label>
                                <select class="form-control" name="type_dechet_id" required>
                                    @foreach($typesDechets as $type)
                                        <option value="{{ $type->id }}">{{ $type->nom }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('type_dechet_id')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Centre de Collecte</label>
                                <select class="form-control" name="centre_collecte_id" required>
                                    @foreach($centreCollecte as $centre)
                                        <option value="{{ $centre->id }}">{{ $centre->nom }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('centre_collecte_id')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">État</label>
                                <select class="form-control" name="etat" required>
                                    <option value="1">Disponible</option>
                                    <option value="0">Indisponible</option>
                                </select>
                                <x-input-error :messages="$errors->get('etat')" class="mt-2"/>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary w-100 mb-0">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal for updating waste -->
        @foreach ($dechets as $dechet)
            <div class="modal fade" id="editWasteModal-{{ $dechet->id }}" tabindex="-1" aria-labelledby="editWasteModalLabel-{{ $dechet->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editWasteModalLabel-{{ $dechet->id }}">Modifier Dechet</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="text-start" method="POST" action="{{ route('backOffice.updateDechet', ['id' => $dechet->id]) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Nom</label>
                                    <x-text-input class="form-control" type="text" name="nom" value="{{ old('nom', $dechet->nom) }}" required/>
                                    <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Quantité</label>
                                    <x-text-input class="form-control" type="number" name="quantite" value="{{ old('quantite', $dechet->quantite) }}" required/>
                                    <x-input-error :messages="$errors->get('quantite')" class="mt-2"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Type de Déchet</label>
                                    <select class="form-control" name="type_dechet_id" required>
                                        @foreach($typesDechets as $type)
                                            <option value="{{ $type->id }}" {{ $dechet->type_dechet_id == $type->id ? 'selected' : '' }}>
                                                {{ $type->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('type_dechet_id')" class="mt-2"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Centre de Collecte</label>
                                    <select class="form-control" name="centre_collecte_id" required>
                                        @foreach($centreCollecte as $centre)
                                            <option value="{{ $centre->id }}" {{ $dechet->centre_collecte_id == $centre->id ? 'selected' : '' }}>
                                                {{ $centre->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('centre_collecte_id')" class="mt-2"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">État</label>
                                    <select class="form-control" name="etat" required>
                                        <option value="1" {{ $dechet->etat ? 'selected' : '' }}>Disponible</option>
                                        <option value="0" {{ !$dechet->etat ? 'selected' : '' }}>Indisponible</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('etat')" class="mt-2"/>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary w-100 mb-0">Sauvegarder les modifications</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach



    </div>

@endsection
