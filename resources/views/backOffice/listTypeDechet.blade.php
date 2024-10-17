@extends('backOffice.adminDashboard')

@section('dashboard-content')

    <div class="page-content-wrapper p-xxl-4">

        <!-- Title -->
        <div class="row">
            <div class="col-12 mb-4 mb-sm-5">
                <div class="d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-3 mb-sm-0">Waste Types List </h1>
                    <div class="d-grid">
                        <a data-bs-toggle="modal" data-bs-target="#addTypeDechetModal" class="btn btn-primary-soft mb-0">
                            <i class="bi bi-plus-circle me-2"></i>Add Waste Types
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Type de déchets list START -->
        <div class="row g-4">
            <div class="card shadow mt-5">

                <!-- Card body START -->
                <div class="card-body">
                    <!-- Table head -->
                    <div class="bg-light rounded p-3 d-none d-sm-block">
                        <div class="row row-cols-7 g-4">
                            <div class="col"><h6 class="mb-0">Name</h6></div>
                            <div class="col"><h6 class="mb-0">Description</h6></div>
                            <div class="col"><h6 class="mb-0">Recyclable</h6></div>
                            <div class="col"><h6 class="mb-0">Dangerous</h6></div>
                            <div class="col"><h6 class="mb-0">Action</h6></div>
                        </div>
                    </div>

                    <!-- Table data -->
                    @foreach ($typesDechets as $typeDechet)
                    <div class="row row-cols-xl-7 g-4 align-items-sm-center border-bottom px-2 py-4">
                        <!-- Data item -->
                        <div class="col">
                            <small class="d-block d-sm-none">Name:</small>
                            <h6 class="fw-light mb-0">{{ $typeDechet->nom }}</h6>
                        </div>

                        <!-- Data item -->
                        <div class="col">
                            <small class="d-block d-sm-none">Description:</small>
                            <h6 class="mb-0 fw-normal">{{ $typeDechet->description }}</h6>
                        </div>

                        <!-- Data item -->
                        <div class="col">
                            <small class="d-block d-sm-none">Recyclable:</small>
                            <h6 class="mb-0 fw-normal">{{ $typeDechet->recyclable }}</h6>
                        </div>

                        <!-- Data item -->
                        <div class="col">
                            <small class="d-block d-sm-none">Dangerous:</small>
                            <h6 class="mb-0 fw-normal">{{ $typeDechet->dangereux }}</h6>
                        </div>

                        <!-- Data item -->
                        <div class="col">
                            <div class="d-flex gap-2 mt-2 mt-sm-0">
                                <a data-bs-toggle="modal" data-bs-target="#editTypeDechetModal-{{ $typeDechet->id }}" class="btn btn-sm btn-primary-soft px-2 mb-0"><i class="bi bi-pencil-square fa-fw"></i></a>

                                <form method="POST" action="{{ route('backOffice.deleteTypeDechet', $typeDechet->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger-soft px-2 mb-0">
                                        <i class="bi bi-trash fa-fw"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Card body END -->
            </div>
        </div>
        <!-- Type de déchets list END -->

        <!-- Modal for adding new type de déchet -->
        <div class="modal fade" id="addTypeDechetModal" tabindex="-1" aria-labelledby="addTypeDechetModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addTypeDechetModalLabel">Add Waste Type</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-start" method="POST" action="{{ route('backOffice.storeTypeDechet') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <x-text-input class="form-control" type="text" name="nom" required/>
                                <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="3" spellcheck="false" name="description"
                                          required></textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Recyclable ?</label>
                                <select class="form-select" name="recyclable" required>
                                    <option value="" disabled selected>Select an option</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <x-input-error :messages="$errors->get('recyclable')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Dangerous ?</label>
                                <select class="form-select" name="dangereux" required>
                                    <option value="" disabled selected>Select an option</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <x-input-error :messages="$errors->get('dangereux')" class="mt-2"/>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary w-100 mb-0">Save</button>
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
                            <h1 class="modal-title fs-5" id="editTypeDechetModalLabel-{{ $typeDechet->id }}">Edit Waste Type</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="text-start" method="POST" action="{{ route('backOffice.updateTypeDechet', ['id' => $typeDechet->id]) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <x-text-input class="form-control" type="text" name="nom" value="{{ old('nom', $typeDechet->nom) }}" required/>
                                    <x-input-error :messages="$errors->get('nom')" class="mt-2"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" rows="3" spellcheck="false" name="description"
                                              required>{{ old('description', $typeDechet->description) }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Recyclable ?</label>
                                    <select class="form-select" name="recyclable" required>
                                        <option value="" disabled selected>Select an option</option>
                                        <option value="Yes" {{ old('recyclable', $typeDechet->recyclable) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="No" {{ old('recyclable', $typeDechet->recyclable) == 'No' ? 'selected' : '' }}>No</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('recyclable')" class="mt-2"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Dangerous ?</label>
                                    <select class="form-select" name="dangereux" required>
                                        <option value="" disabled selected>Select an option</option>
                                        <option value="Yes" {{ old('dangereux', $typeDechet->dangereux) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="No" {{ old('dangereux', $typeDechet->dangereux) == 'No' ? 'selected' : '' }}>No</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('dangereux')" class="mt-2"/>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary w-100 mb-0">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection
