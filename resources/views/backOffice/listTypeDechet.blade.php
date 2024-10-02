@extends('backOffice.adminDashboard')

@section('title', 'EcoCycle - Liste des Types de Déchets')

@section('dashboard-content')

    <div class="page-content-wrapper p-xxl-4">

        <!-- Title -->
        <div class="row">
            <div class="col-12 mb-4 mb-sm-5">
                <div class="d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-3 mb-sm-0">Liste des Types de Déchets</h1>
                    <div class="d-grid">
                        <a data-bs-toggle="modal" data-bs-target="#addTypeDechetModal" class="btn btn-primary-soft mb-0">
                            <i class="bi bi-plus-circle me-2"></i>Ajouter Type de Déchet
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Type de déchets list START -->
        <div class="row g-4">
            @foreach ($typesDechets as $typeDechet)
                <div class="col-md-6 col-lg-4">
                    <div class="card bg-transparent">
                        <!-- Card body -->
                        <div class="card-body p-3 pb-0">
                            <h6 class="fw-light mb-0">Nom: {{ $typeDechet->nom }}</h6>
                            <p class="mb-1">Description: {{ $typeDechet->description }}</p>
                            <p class="mb-1">Recyclable: {{ $typeDechet->recyclable ? 'Oui' : 'Non' }}</p>
                            <p class="mb-1">Dangereux: {{ $typeDechet->dangereux ? 'Oui' : 'Non' }}</p>
                        </div>
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
                                                <a data-bs-toggle="modal" data-bs-target="#editTypeDechetModal-{{ $typeDechet->id }}" class="dropdown-item">
                                                    <i class="bi bi-pencil-square fa-fw me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('backOffice.deleteTypeDechet', $typeDechet->id) }}">
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
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Type de déchets list END -->

        <!-- Modal for adding new type de déchet -->
        <div class="modal fade" id="addTypeDechetModal" tabindex="-1" aria-labelledby="addTypeDechetModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addTypeDechetModalLabel">Ajouter Type de Déchet</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-start" method="POST" action="{{ route('backOffice.storeTypeDechet') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nom</label>
                                <x-text-input class="form-control" type="text" name="nom" required/>
                                <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <x-text-input class="form-control" type="text" name="description" required/>
                                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Recyclable</label>
                                <select class="form-control" name="recyclable" required>
                                    <option value="1">Oui</option>
                                    <option value="0">Non</option>
                                </select>
                                <x-input-error :messages="$errors->get('recyclable')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Dangereux</label>
                                <select class="form-control" name="dangereux" required>
                                    <option value="1">Oui</option>
                                    <option value="0">Non</option>
                                </select>
                                <x-input-error :messages="$errors->get('dangereux')" class="mt-2"/>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary w-100 mb-0">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for updating type de déchet -->
        @foreach ($typesDechets as $typeDechet)
            <div class="modal fade" id="editTypeDechetModal-{{ $typeDechet->id }}" tabindex="-1" aria-labelledby="editTypeDechetModalLabel-{{ $typeDechet->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editTypeDechetModalLabel-{{ $typeDechet->id }}">Modifier Type de Déchet</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="text-start" method="POST" action="{{ route('backOffice.updateTypeDechet', ['id' => $typeDechet->id]) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Nom</label>
                                    <x-text-input class="form-control" type="text" name="nom" value="{{ old('nom', $typeDechet->nom) }}" required/>
                                    <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <x-text-input class="form-control" type="text" name="description" value="{{ old('description', $typeDechet->description) }}" required/>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Recyclable</label>
                                    <select class="form-control" name="recyclable" required>
                                        <option value="1" {{ $typeDechet->recyclable ? 'selected' : '' }}>Oui</option>
                                        <option value="0" {{ !$typeDechet->recyclable ? 'selected' : '' }}>Non</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('recyclable')" class="mt-2"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Dangereux</label>
                                    <select class="form-control" name="dangereux" required>
                                        <option value="1" {{ $typeDechet->dangereux ? 'selected' : '' }}>Oui</option>
                                        <option value="0" {{ !$typeDechet->dangereux ? 'selected' : '' }}>Non</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('dangereux')" class="mt-2"/>
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
